<?php

namespace App\Livewire\Front;

use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\ReviewReply;
use App\Models\Setting;
use App\Models\SpamPharase;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Traits\CheckSpamTrait;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ViewBusiness extends Component
{
    use CheckSpamTrait, WithFileUploads;

    use WithPagination;

    #[Layout('layouts.web')]

    public $addReviewModel = false;

    public $replyReviewModel = false;

    public $review;
    public $rating = 0;

    public $businessAccountId;
    public $reviewId;
    public $alreadyReviewed = false;
    public $replyId;
    public $message;
    public $numReviewsToShow = 5;
    public $confirmingDeletionModal = false;
    public $disputeModal = false;
    public $description;
    public $attachments = [];
    public $disputeReviewId;

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

    public function showMoreReviews()
    {
        $this->numReviewsToShow += 5;
    }


    public function render()
    {
        $businessAccount = $this->getBusinessAccount();
        $overallRating = $businessAccount->businessStat->avg_rating ?? 0;
        $totalReviews = $businessAccount->businessStat->reviews_count ?? 0;
        $fullStars = floor($overallRating);
        $halfStar = ceil($overallRating - $fullStars);


        $reviews = $this->getBusinessReviews()->take($this->numReviewsToShow)->get();

        $edit_review_par_day_setting = Setting::where('key', 'edit_review_par_day')->first();
        $edit_review_par_day = $edit_review_par_day_setting ? $edit_review_par_day_setting->value : '';
        
        return view('livewire.front.view-business', [
            'businessAccount' => $businessAccount,
            'overallRating' => $overallRating,
            'totalReviews' => $totalReviews,
            'fullStars' => $fullStars,
            'halfStar' => $halfStar,
            'reviews' => $reviews,
            'edit_review_par_day' => $edit_review_par_day
        ]);
    }


    public function addReview()
    {
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->addReviewModel = true;
    }

    public function StoreOrUpdate()
    {
        $this->validate([
            'review' => 'required|min:5|max:1000',
            'rating' => 'required'
        ]);

        $spamPharasesModel = $this->getSpamModel();
        if ($spamPharasesModel) {
            $spamPharases = explode(',', $spamPharasesModel->spam_pharases);

            $spamWords = $this->checkSpam($this->review, $spamPharases);
            if (!empty($spamWords)) {
                $this->addError('spam_error', "Your text contains a forbidden phrase: {".$spamWords."} remove them to add your review");
                // $this->addError('spam_error', 'Remove the bad text from your review');
            }
        }

        if ($this->getErrorBag()->isEmpty()) {
            if ($this->reviewId) {
                $reviewUser = BusinessReview::findOrFail($this->reviewId);
                $reviewUser->update([
                    'user_id' => auth()->id(),
                    'review' => $this->review,
                    'rating' => $this->rating,
                    'is_approved' => 1,
                    'is_edited' => 1,
                    'business_account_id ' => $this->businessAccountId
                ]);
            } else {
                $this->getBusinessAccount()->reviews()->create([
                    'user_id' => auth()->id(),
                    'review' => $this->review,
                    'rating' => $this->rating,
                    'is_approved' => 1,
                    'business_account_id ' => $this->businessAccountId
                ]);
            }


            $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->businessAccountId]);
            $this->loadBusinessAccount();


            $reviews = $this->getBusinessAccount()->reviews;
            $reviewsCount = $reviews->count();
            $avgRating = $reviews->avg('rating');
            $positiveReviewsCount = $reviews->where('rating', '>=', 3)->count();
            $negativeReviewsCount = $reviewsCount - $positiveReviewsCount;

            // Save business stats
            $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->businessAccountId]);
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

    public function EditReview($id)
    {
        $this->reviewId = $id;

        $reviewUser = BusinessReview::findOrFail($id);

        $this->review = $reviewUser->review;
        $this->rating = $reviewUser->rating;

        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');

        $this->addReviewModel = true;
    }


    // reply review
    public function replyReview($id)
    {
        $this->reviewId = $id;
        $this->message = '';
        $this->dispatch('updateCkEditorBodyMessage');
        $this->dispatch('initReplyEditor');

        $this->replyReviewModel = true;
    }

    public function EditReviewReply($id)
    {
        $this->replyId = $id;
        $reviewReply = ReviewReply::findOrFail($id);
        $this->message = $reviewReply->message;
        $this->dispatch('updateCkEditorBodyMessage');
        $this->dispatch('initReplyEditor');

        $this->replyReviewModel = true;
    }

    // DeleteReviewReply
    public function DeleteReviewReply($id)
    {
        $this->replyId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
       
            $reviewReply = ReviewReply::findOrFail($this->replyId);
            $reviewReply->delete();
            $this->confirmingDeletionModal = false;

            return redirect()->back()->with('success', 'Action performed Successfully.');

    }

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

            $this->reset(['message', 'replyId']);
            $this->replyReviewModel = false;
            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }

    public function showDisputeModal($reviewId)
    {
        $this->dispatch('pondReset');
        $this->disputeReviewId = $reviewId;
        $this->disputeModal = true;
    }

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
                $fileName = time() . '_' .  $file->getClientOriginalName();
                $fileMime  = $file->getMimeType();

                $path = $file->storeAs('/tickets', $fileName, 'public');
                  
                $this->encryptFile($path);

                TicketAttachment::create([
                    'file_path' => $path,
                    'file_mime' => $fileMime,
                    'ticket_id' => $ticket->id
                ]);
            }
        }

        $this->reset('disputeReviewId', 'disputeModal');
    }


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

            dd($e->getMessage());
        }
    }


    protected function getBusinessAccount()
    {
        return BusinessAccount::where('is_approved', 1)->findOrFail($this->businessAccountId);
    }

    protected function getBusinessReviews()
    {
        return BusinessReview::where('is_approved', 1)
            ->with('replies', 'user')
            ->where('business_account_id', $this->businessAccountId)
            ->latest();
    }

    protected function getSpamModel()
    {
        return SpamPharase::find(1);
    }
}
