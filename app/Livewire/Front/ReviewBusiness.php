<?php

namespace App\Livewire\Front;

use App\Jobs\SendMailJob;
use App\Models\BusinessAccount;
use App\Models\BusinessClaimRequest;
use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\Category;
use App\Models\ReviewAttachment;
use App\Models\ReviewReply;
use App\Models\Setting;
use App\Models\SpamPharase;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Traits\CheckSpamTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ReviewBusiness extends Component
{
    use CheckSpamTrait, WithFileUploads;

    public $alreadyReviewed = false;
    public $reviewsLimit = 5;
    public $message;
    public $attachments = [];
    public $description;
    public $review;
    public $rating = 0;
    public $interactionDetail, $interactionDate;
    public $showMoreBtn = true;

    public $businessAccountId;
    public $reviewId;
    public $replyId;
    public $disputeReviewId;

    public $reviewImages = [];

    public $oldReviewImages;

    public $addReviewModel = false;
    public $replyReviewModel = false;
    public $disputeModal = false;
    public $claimBusinessModal = false;
    public $confirmingDeletionModal = false;

    public $showSuccessModal = false;
    public $showErrorModal = false;

    public $starsFilter = [];

    public $claimDetails;

    public function mount($business_name)
    {
        $business = BusinessAccount::where('businessName', $business_name)->firstOrFail();
        $this->businessAccountId = $business->id;
        $this->loadBusinessAccount();
    }

    public function loadBusinessAccount()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $this->alreadyReviewed = $this->getBusinessAccount()->reviews->contains('user_id', $userId);
        }
    }

    // show add review modal
    public function addReview()
    {
        $this->resetErrorBag();
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->addReviewModel = true;
    }

    // store review
    public function StoreOrUpdate()
    {
        $this->validate([
            'review' => 'required|min:50|max:1000',
            'rating' => 'required|numeric|min:0.5|max:5',
            'interactionDetail' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 10) {
                        $fail("The $attribute must not contain more than 10 words.");
                    }
                }
            ],
            'interactionDate' => 'required|date|before_or_equal:today',
            'reviewImages' => [
                function ($attribute, $value, $fail) {
                    if ($value) {
                        if (count($value) > 5) {
                            $fail("The $attribute must not contain more than 5 images.");
                        }

                        foreach ($value as $image) {
                            if (!$image->isValid()) {
                                $fail("One of the $attribute is not a valid image.");
                            }
                        }
                    }
                }
            ]
        ]);


        $spamPharasesModel = $this->getSpamModel();
        if ($spamPharasesModel) {
            $spamPharases = explode(',', $spamPharasesModel->spam_pharases);

            $spamWords = $this->checkSpam($this->review, $spamPharases);
            if (!empty($spamWords)) {
                $this->addError('spam_error', "Your text contains a forbidden phrase: {" . $spamWords . "} remove them to add your review");
                // $this->addError('spam_error', 'Remove the bad text from your review');
            }
        }

        if ($this->getErrorBag()->isEmpty()) {
            $data = [
                'user_id' => auth()->id(),
                'review' => $this->review,
                'rating' => $this->rating,
                'interaction_detail' => $this->interactionDetail,
                'interaction_date' => $this->interactionDate,
                'is_approved' => 1,
                'business_account_id ' => $this->businessAccountId
            ];

            if ($this->reviewId) {
                $data['is_edited'] = 1;
                $reviewUser = BusinessReview::findOrFail($this->reviewId);
                $reviewUser->update($data);

                // review images
                if ($this->reviewImages) {

                    $attachments = $reviewUser->attachments()->get();
                    foreach ($attachments as $attachment) {
                        Storage::disk('public')->delete($attachment->file_path);
                    }
                    $reviewUser->attachments()->delete();

                    foreach ($this->reviewImages as $image) {
                        $fileExtension = $image->getClientOriginalExtension() ?? '';
                        $fileName = Carbon::now()->timestamp . "-" . $image->getClientOriginalName();
                        $path = $image->storeAs('review-images', $fileName, 'public');
                        $reviewUser->attachments()->create([
                            'business_review_id' => $this->reviewId,
                            'file_path' => $path,
                            'file_type' => $fileExtension
                        ]);
                    }
                }



            } else {
                if ($this->getBusinessAccount()->reviews()->where('user_id', auth()->id())->count() == 0) {

                    $newReview = $this->getBusinessAccount()->reviews()->create($data);
                    $reviewId = $newReview->id;

                    // review images
                    if ($this->reviewImages) {
                        foreach ($this->reviewImages as $image) {
                            $fileExtension = $image->getClientOriginalExtension() ?? '';
                            $fileName = Carbon::now()->timestamp . "-" . $image->getClientOriginalName();
                            $path = $image->storeAs('review-images', $fileName, 'public');
                            ReviewAttachment::create([
                                'business_review_id' => $reviewId,
                                'file_path' => $path,
                                'file_type' => $fileExtension
                            ]);
                        }
                    }

                    $this->submitReviewEmail($data);
                } else {
                    return $this->addError('error', 'Review has already been submitted.');
                }
            }


            $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->businessAccountId]);
            $this->loadBusinessAccount();


            $reviews = $this->getBusinessAccount()->reviews;
            $reviewsCount = $reviews->where('is_approved', 1)->where('disputed', 0)->count();
            $avgRating = $reviews->where('is_approved', 1)->where('disputed', 0)->avg('rating');
            $positiveReviewsCount = $reviews->where('is_approved', 1)->where('disputed', 0)->where('rating', '>=', 3)->count();
            $negativeReviewsCount = $reviews->count() - $positiveReviewsCount;

            // Save business stats
            // $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->businessAccountId]);
            $businessStat->reviews_count = $reviewsCount;
            $businessStat->avg_rating = $avgRating;
            $businessStat->positive_reviews_count = $positiveReviewsCount;
            $businessStat->negative_reviews_count = $negativeReviewsCount;

            $businessStat->save();

            $this->reset(['review', 'rating']);
            $this->addReviewModel = false;

            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }

    public function submitReviewEmail($reviewData)
    {
        $heading = '<h1>New Review Notification</h1>';
        $body = '';
        $body .= "<p>
                Dear {$this->getBusinessAccount()->username},<br><br>
                You have received a new review for <a href='" . route('front.business.show', ['business_name' => $this->getBusinessAccount()->businessName]) . "'>{$this->getBusinessAccount()->businessName}</a>.</p>
                <p style='padding-top: 10px;'>The review is:<br>
                 {$reviewData['review']}.</p>
                <br>
                <p style='padding-top: 10px;'>review rating: {$reviewData['rating']}</p>
                <p style='padding-top: 10px;'> Please review and take necessary actions.
                </p>";

        $subject = "New Review Notification";

        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
        // send main to user
        dispatch(new SendMailJob($data, $this->getBusinessAccount()->user->email));
    }

    // Show edit review modal
    public function EditReview($id)
    {
        $this->reviewId = $id;

        $reviewUser = BusinessReview::findOrFail($id);

        $this->review = $reviewUser->review;
        $this->rating = $reviewUser->rating;
        $this->interactionDetail = $reviewUser->interaction_detail;
        $this->interactionDate = $reviewUser->interaction_date;
        $this->oldReviewImages = json_encode($reviewUser->attachments);
        $this->reviewImages = [];
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');

        $this->addReviewModel = true;
    }

    // Reply Review show modal
    public function replyReview($id)
    {
        if (auth()->check() && $this->getBusinessAccount()->user_id == auth()->id()) {
            $this->reviewId = $id;
            $this->message = '';
            $this->dispatch('updateCkEditorBodyMessage');
            $this->dispatch('initReplyEditor');

            $this->replyReviewModel = true;
        }
    }

    // Store reply
    public function StoreOrUpdateReply()
    {
        $this->validate([
            'message' => 'required|min:5|max:1000',
        ]);

        $spamPharasesModel = $this->getSpamModel();
        if ($spamPharasesModel) {
            $spamPharases = explode(',', $spamPharasesModel->spam_pharases);


            $spamWords = $this->checkSpam($this->message, $spamPharases);
            if (!empty($spamWords)) {
                $this->addError('spam_error', "Your text contains a forbidden phrase: {$spamWords} remove them to add your review");
            }
        }

        if ($this->getErrorBag()->isEmpty()) {


            $user = Auth::user();
            if ($this->getBusinessAccount()->user_id == $user->id) {
                $ReplyUser = 'Business Owner';
            } else if ($user->is_admin == 1) {
                $ReplyUser = 'Admin';
            } else {
                $ReplyUser = 'User';
            }

            $ReviewReply = ReviewReply::firstOrNew(['id' => $this->replyId]);
            $ReviewReply->user_id = $user->id;
            $ReviewReply->reply_from = $ReplyUser;
            $ReviewReply->message = $this->message;
            if ($this->replyId == null) {
                $ReviewReply->business_review_id = $this->reviewId;
            }

            $ReviewReply->save();


            $this->sendReviewRepliedEmail($ReviewReply);
            $this->reset(['message', 'replyId']);
            $this->replyReviewModel = false;
            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }

    public function EditReviewReply($id)
    {
        if (auth()->check() && $this->getBusinessAccount()->user_id == auth()->id()) {
            $this->replyId = $id;
            $reviewReply = ReviewReply::findOrFail($id);
            $this->message = $reviewReply->message;
            $this->dispatch('updateCkEditorBodyMessage');
            $this->dispatch('initReplyEditor');

            $this->replyReviewModel = true;
        }
    }

    // DeleteReviewReply
    public function DeleteReviewReply($id)
    {
        if (auth()->check() && $this->getBusinessAccount()->user_id == auth()->id()) {
            $this->replyId = $id;
            $this->confirmingDeletionModal = true;
        }
    }

    public function delete()
    {

        $reviewReply = ReviewReply::findOrFail($this->replyId);
        $reviewReply->delete();
        $this->confirmingDeletionModal = false;

        return redirect()->back()->with('success', 'Action performed Successfully.');

    }

    public function sendReviewRepliedEmail($reviewReply)
    {
        $heading = '<h1>Review Reply</h1>';
        foreach (['user', 'owner'] as $key => $value) {
            $name = $value == 'user' ? $reviewReply->user->name : $reviewReply->businessReview->businessAccount->username;
            $body = '';
            $body .= "<p>Dear {$name},</p>";

            if ($key == 0) {

                $body .= "
                    <p style='padding-top: 10px;'>Your review has been replied to. Here is the response:<br></p>
                    <br>
                    <p style='padding-top: 10px;'>review rating: {$reviewReply->message}</p>";
            } else {
                $body .= "<p style='padding-top: 10px;'>Your reply to {$reviewReply->user->name}'s review has been sent</p>";
                $body .= "<p style='padding-top: 10px;'>Review: {$reviewReply->businessReview->review}</p>";
                $body .= "<p style='padding-top: 10px;'>Your reply: {$reviewReply->message}</p>";
            }

            $subject = "Review Reply";

            $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

            if ($key == 0) {
                $mailtToUser = $reviewReply->user->email;
                // send mail to user
                dispatch(new SendMailJob($data, $mailtToUser));
            } else {
                $mailtToOwner = $reviewReply->businessReview->businessAccount->user->email;

                dispatch(new SendMailJob($data, $mailtToOwner));
            }

        }
    }

    // show dispute modal
    public function showDisputeModal($reviewId)
    {
        if (auth()->check() && $this->getBusinessAccount()->user_id == auth()->id()) {
            $this->dispatch('pondReset');
            $this->disputeReviewId = $reviewId;
            $this->disputeModal = true;
        }
    }

    // create dispute
    public function createDispute()
    {

        $this->validate([
            'description' => 'required|min:5|max:1000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:png,jpg,jpeg,pdf,docx,mp4'
        ]);

        $ticket = Ticket::create([
            'business_review_id' => $this->disputeReviewId,
            'user_id' => auth()->id(),
            'description' => $this->description,
            'reviewer_user_id' => BusinessReview::findOrFail($this->disputeReviewId)->user_id,
        ]);

        $review = BusinessReview::findOrFail($this->disputeReviewId);
        $review->disputed = 1;
        $review->save();


        $businessStat = BusinessStat::where('business_account_id', $this->businessAccountId)->first();
        $businessStat->avg_rating = BusinessReview::where('business_account_id', $this->businessAccountId)->where('is_approved', 1)->where('disputed', 0)->avg('rating') ?? 0;
        $businessStat->reviews_count = BusinessReview::where('business_account_id', $this->businessAccountId)->where('is_approved', 1)->where('disputed', 0)->count() ?? 0;
        $positiveReviewsCount = BusinessReview::where('business_account_id', $this->businessAccountId)->where('is_approved', 1)->where('disputed', 0)->where('rating', '>=', 3)->count() ?? 0;
        $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;

        $businessStat->positive_reviews_count = $positiveReviewsCount;
        $businessStat->negative_reviews_count = $negativeReviewsCount;
        $businessStat->save();


        if (!is_null($this->attachments)) {
            foreach ($this->attachments as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $fileMime = $file->getMimeType();

                $path = $file->storeAs('/tickets', $fileName, 'public');

                $this->encryptFile($path);

                TicketAttachment::create([
                    'file_path' => $path,
                    'file_mime' => $fileMime,
                    'ticket_id' => $ticket->id
                ]);
            }
        }
        $this->sendReviewDisputedEmail($ticket);
        $this->reset('disputeReviewId', 'disputeModal');
    }

    public function sendReviewDisputedEmail(Ticket $ticket)
    {
        $heading = '<h1>Review Dispute Notification</h1>';
        $subject = "Review Dispute Notification";


        foreach (['user', 'owner', 'admin'] as $value) {
            $name = $value == 'user' ? $ticket->review->user->name : ($value == 'owner' ? $ticket->review->businessAccount->username : 'Admin');
            $mailtTo = $value == 'user' ? $ticket->review->user->email : ($value == 'owner' ? $ticket->review->businessAccount->user->email : Setting::where('key', 'admin_email')->first()?->value);

            $body = '';
            $body .= "<p>Dear {$name},</p>";

            if ($value == 'user') {
                $body .= "<p style='padding-top: 10px;'>We hope this message finds you well. We wanted to inform you that the owner has initiated a dispute regarding your review.";
            } else if ($value == 'owner') {
                $body .= "<p style='padding-top: 10px;'>We hope this message finds you well. We wanted to confirm that your dispute against a {$ticket->review->user->name}'s review has been successfully initiated. We understand the importance of addressing concerns and maintaining a fair and transparent feedback system.</p>";
            } else if ($value == 'admin') {
                $body .= "<p style='padding-top: 10px;'>I hope this email finds you well. I am writing to inform you that a review dispute has been raised on our platform...</p>";
            }

            $body .= "
                    <p style='padding-top: 10px;'>Details of the dispute:</p>
                    <!-- Include relevant details here -->
                    <ul style='padding-left: 20px'>
                        <li><strong>Business  Name: </strong>
                            <a href='" . route('front.business.show', ['business_name' => $ticket->review->businessAccount->businessName]) . "'>" .
                ucwords($ticket->review->businessAccount->businessName) . "
                            </a>
                        </li>
                      <li><strong>Review: </strong>" . nl2br($ticket->review->review) . "</li>
                    </ul>

                    ";

            $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

            dispatch(new SendMailJob($data, $mailtTo));
        }
    }

    #[Layout('layouts.web')]
    public function render()
    {
        $businessAccount = $this->getBusinessAccount();
        $overallRating = $businessAccount->businessStat->avg_rating ?? 0;
        // $totalReviews = $businessAccount->businessStat->reviews_count ?? 0;
        $fullStars = floor($overallRating);
        $halfStar = ceil($overallRating - $fullStars);

        $reviewsQuery = $this->getBusinessReviews();


        if (count($this->starsFilter) > 0) {
            $reviewsQuery->where(function ($query) {
                foreach ($this->starsFilter as $index => $star) {
                    $query->orWhere(function ($query) use ($index, $star) {
                        if ($index === 0) {
                            $query->where('rating', '>', $star - 1)
                                ->where('rating', '<=', $star);
                        } else {
                            $query->orWhere(function ($query) use ($star) {
                                $query->where('rating', '>', $star - 1)
                                    ->where('rating', '<=', $star);
                            });
                        }
                    });
                }
            });
        }

        $totalReviewQuery = clone $reviewsQuery;
        $getAllReviewQuery = clone $reviewsQuery;

        $totalReviews = $totalReviewQuery->count();

        $reviews = $getAllReviewQuery->take($this->reviewsLimit)->get();


        $edit_review_par_day_setting = Setting::where('key', 'edit_review_par_day')->first();
        $edit_review_par_day = $edit_review_par_day_setting ? $edit_review_par_day_setting->value : '';
        $randomCategories = Category::whereNull('parent_id')->take(15)->get();

        $relatedBusiness = BusinessAccount::where('is_approved', 1)
            ->where('category_id', $businessAccount->category_id)
            ->orWhere('sub_category_id', $businessAccount->sub_category_id)
            ->take(15)
            ->get();

        return view('livewire.front.review-business', [
            'businessAccount' => $businessAccount,
            'overallRating' => $overallRating,
            'fullStars' => $fullStars,
            'halfStar' => $halfStar,
            'reviews' => $reviews,
            'edit_review_par_day' => $edit_review_par_day,
            'totalReviews' => $totalReviews,
            'randomCategories' => $randomCategories,
            'relatedBusiness' => $relatedBusiness
        ]);
    }

    // Calculate Percentage For Specific Star
    public function calculatePercentageForSpecificStar($star)
    {
        $totalReviews = $this->getBusinessReviews()->count();

        //  If you want to find all products with prices starting with 4.1, 4.2, 4.3, 4.4, and 4.5 or exactly equal to 4, you would use
        // $starCount = $this->getBusinessReviews()->where('rating', 'REGEXP', '^' . $star . '\.[0-9]$|^' . $star . '$')->count();
        $starCount = $this->getBusinessReviews()->where('rating', '>', $star - 1)->where('rating', '<=', $star)->count();

        // Calculate the percentage for the specified star or greater
        $percentage = $totalReviews > 0 ? ($starCount / $totalReviews) * 100 : 0;

        return (fmod($percentage, 1) !== 0) ? number_format($percentage, 1) : $percentage;
    }

    // encryptfile
    function encryptFile($filePath)
    {
        try {
            $fileContents = Storage::get($filePath);

            $originalFilename = pathinfo($filePath, PATHINFO_BASENAME);

            $destinationDirectory = 'tickets/original';

            // Copy the original file to the destination directory
            $copiedFilePath = $destinationDirectory . '/' . $originalFilename;
            Storage::copy($filePath, $copiedFilePath);


            // Generate a random IV for encryption
            $iv = random_bytes(16);
            // Encrypt the file contents using AES-256-CBC encryption
            $encryptedContents = openssl_encrypt(
                $fileContents,
                'aes-256-cbc',
                env('AES_Secret_Key_DB'),
                0,
                $iv
            );

            Storage::put($filePath, $iv . $encryptedContents);

            return "File encrypted successfully.";
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    protected function getBusinessAccount()
    {
        return BusinessAccount::where('is_approved', 1)->findOrFail($this->businessAccountId);
    }

    protected function getBusinessReviews()
    {
        return BusinessReview::where('is_approved', 1)
            ->with('replies', 'user', 'users', 'attachments')
            ->where('business_account_id', $this->businessAccountId)
            ->latest();
    }

    protected function getSpamModel()
    {
        return SpamPharase::find(1);
    }

    public function loadMoreReviews($total)
    {
        $this->reviewsLimit = $this->reviewsLimit + 5;
        if ($this->reviewsLimit >= $total)
            $this->showMoreBtn = false;
    }

    public function showLess()
    {
        $this->reviewsLimit = 5;
        $this->showMoreBtn = true;
    }

    public function showSendClaimModal()
    {
        $this->claimBusinessModal = true;
    }

    public function sendClaimRequest($businessId)
    {
        // Validate this claimDetails
        $this->validate([
            'claimDetails' => 'required|min:5|max:200',
        ]);
        $userId = Auth::id();

        if ($userId && $businessId) {
            BusinessClaimRequest::create([
                'business_account_id' => $businessId,
                'user_id' => $userId,
                'claimDetails' => $this->claimDetails,
            ]);
            session()->flash("success", "Your claim request has been sent successfully");
        }

        $this->reset('claimBusinessModal');
        $this->dispatch('hideCreateBusinessButton');
    }


    public function toggleHelpful($reviewId)
    {

        if (!auth()->check()) {
            // User is not authenticated, redirect to login page
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }
        $review = BusinessReview::findOrFail($reviewId);
        $user = auth()->user();
        // if($user){
        if ($review->users->contains($user->id)) {

            $review->users()->detach($user->id);
            $review->decrement('helpful_count');

        } else {
            $review->users()->attach($user->id);
            $review->increment('helpful_count');
        }

    }

    public function hideSuccessModal()
    {

        $this->showSuccessModal = false;

    }
}

// Todo  Read more reviews... and scroll behaviour