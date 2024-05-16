<?php

namespace App\Livewire\Admin;

use App\Jobs\SendMailJob;
use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\Setting;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\File;


class ManageDispute extends Component
{

    public $viewDisputeModel = false;

    public $changeStatusModal = false;

    public $changeVerifiedModal = false;
    public $ticket;

    public $ticket_description = '';
    public $ticket_attachments = [];

    public $statusChangeInfo = ['status' => 0, 'accountId' => 0, 'reviewId' => 0, 'ticketId' => 0];
    public $statusChangeTicket = ['status' => 'pending', 'ticketId' => 0];

    public $ticket_status;

    public $fullStars;

    public $businessName;
    public $halfStar;

    public $user_review;
    public $username;

    public $businessAccountName;

    public $businessAccountId;

    public $winner_type;



    #[Layout('layouts.app')]

    public function render()
    {
        $tickets = Ticket::with('review', 'attachments')->latest()->paginate(20);
        return view('livewire.admin.manage-dispute', ['tickets' => $tickets]);
    }


    public function viewDispute($id)
    {
        $this->ticket = Ticket::with('review', 'attachments')->find($id);
        $this->ticket_description = $this->ticket->description;
        $this->ticket_attachments = $this->ticket->attachments()->get()->toArray();
        $this->ticket_status = $this->ticket->ticket_status;
        $this->fullStars = floor($this->ticket->review->rating);
        $this->halfStar = ceil($this->ticket->review->rating - $this->fullStars);

        $this->user_review = $this->ticket->review->review;
        $this->username = $this->ticket->review->user->name;
        $this->businessAccountName = $this->ticket->review->businessAccount->first_name . ' ' . $this->ticket->review->businessAccount->last_name;
        $this->businessAccountId = $this->ticket->review->businessAccount->id;
        $this->businessName = $this->ticket->review->businessAccount->businessName;

        $this->viewDisputeModel = true;
    }



    // review status change
    public function confirmChangeStatusApproved($id, $status, $ticketId)
    {
        $businessReview = BusinessReview::find($id);
        $this->statusChangeInfo['status'] = !$status;
        $this->statusChangeInfo['reviewId'] = $id;
        $this->statusChangeInfo['accountId'] = $businessReview->business_account_id;
        $this->statusChangeInfo['ticketId'] = $ticketId;

        $this->changeStatusModal = true;
    }

    public function updateStatus()
    {
        // dd($this->statusChangeInfo['status']);
        $businessReview = BusinessReview::findOrFail($this->statusChangeInfo['reviewId']);
        $businessReview->is_approved = $this->statusChangeInfo['status'];

        if ($this->statusChangeInfo['status'] == 0) {
            $businessReview->disputed = 0;
        } else {
            $businessReview->disputed = 1;
        }

        $businessReview->save();

        // need update total star rating
        $businessStat = BusinessStat::where('business_account_id', $this->statusChangeInfo['accountId'])->first();
        $businessStat->avg_rating = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->where('disputed', 0)->avg('rating') ?? 0;
        $businessStat->reviews_count = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->where('disputed', 0)->count() ?? 0;
        $positiveReviewsCount = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->where('disputed', 0)->where('rating', '>=', 3)->count() ?? 0;
        $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;

        $businessStat->positive_reviews_count = $positiveReviewsCount;
        $businessStat->negative_reviews_count = $negativeReviewsCount;
        $businessStat->save();

        if ($this->statusChangeInfo['status'] == 0) {
            $ticket = Ticket::find($this->statusChangeInfo['ticketId']);
            if($ticket) {
                $ticket->ticket_status = 'pending';
                $ticket->save();
            }
        }

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Review status has been updated successfully!');
    }


    // ticket status change
    public function changeTicketStatus($id, $status)
    {
        $this->statusChangeTicket['status'] = ($status == 'pending') ? 'closed' : 'pending';
        $this->statusChangeTicket['ticketId'] = $id;
        $this->changeVerifiedModal = true;
    }

    public function updateVerified()
    {

        if ($this->statusChangeTicket['status'] == 'closed') {
            $validatedData = $this->validate([
                'winner_type' => 'required|in:owner,reviewer',
            ]);
        }


        $ticket = Ticket::findOrFail($this->statusChangeTicket['ticketId']);

        $disputes = Ticket::where('business_review_id', $ticket->business_review_id)
            ->where('id', '!=', $this->statusChangeTicket['ticketId'])
            ->where('ticket_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();


        $review = BusinessReview::findOrFail($ticket->business_review_id);


        if ($disputes->isEmpty()) {
            $ticket->ticket_status = $this->statusChangeTicket['status'];
            $ticket->save();

            if ($this->statusChangeTicket['status'] == 'closed') {
                $review->disputed = 0;
                if ($this->winner_type == 'owner') {
                    $review->is_approved = 0;
                } else {
                    $review->is_approved = 1;
                }
            } else {
                $review->disputed = 1;
            }
            $review->save();

            $businessStat = BusinessStat::where('business_account_id', $review->business_account_id)->first();
            $businessStat->avg_rating = BusinessReview::where('business_account_id', $review->business_account_id)->where('is_approved', 1)->where('disputed', 0)->avg('rating') ?? 0;
            $businessStat->reviews_count = BusinessReview::where('business_account_id', $review->business_account_id)->where('is_approved', 1)->where('disputed', 0)->count() ?? 0;
            $positiveReviewsCount = BusinessReview::where('business_account_id', $review->business_account_id)->where('is_approved', 1)->where('disputed', 0)->where('rating', '>=', 3)->count() ?? 0;
            $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;

            $businessStat->positive_reviews_count = $positiveReviewsCount;
            $businessStat->negative_reviews_count = $negativeReviewsCount;
            $businessStat->save();


            $this->sendTicketResponseEmail($this->winner_type, $ticket);


            $this->reset('statusChangeTicket', 'changeVerifiedModal');
            session()->flash('success', 'Ticket status has been updated successfully!');
        } else {
            $this->reset('statusChangeTicket', 'changeVerifiedModal');

            session()->flash('error', 'One Ticket is already in pending you can not change the status right now.!');
        }
    }

    public function sendTicketResponseEmail($winnerType, Ticket $ticket)
    {
        $heading = '<h1>Ticket Closed Notification</h1>';
        $subject = "Ticket Closed Notification";

        $winnerName = $winnerType == 'owner' ? $ticket->review->businessAccount->username : $ticket->review->user->name;


        foreach (['user', 'owner', 'admin'] as $value) {
            $name = $value == 'user' ? $ticket->review->user->name : ($value == 'owner' ? $ticket->review->businessAccount->username : 'Admin');
            $mailtTo = $value == 'user' ? $ticket->review->user->email : ($value == 'owner' ? $ticket->review->businessAccount->user->email : Setting::where('key', 'admin_email')->first()?->value);

            $body = '';
            $body .= "<p>Dear {$name},</p>";

            $body .= "

                    <p>We're pleased to inform you that Ticket {$ticket->id} has been successfully closed.The winner for this ticket is {$winnerName}.</p>

                    
                    <ul style='padding-left: 20px'>
                      <li><strong>Winner: </strong>" . $winnerName . "</li>
                      <li><strong>Review: </strong>" . nl2br($ticket->review->review) . "</li>
                    </ul>

                    <p>If you have any questions or need additional information, please do not hesitate to reach out. Thank you for your cooperation in handling this matter.</p>";

            $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

            dispatch(new SendMailJob($data, $mailtTo));
        }
    }




    public function decryptAndOpenFile($filePath)
    {
        try {
            // Call your decryptFile function passing the file path
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            $decryptedFilePath = $this->decryptFile($filePath, $fileExtension);
            $this->dispatch('fileDecrypted', ['decryptedFilePath' => $decryptedFilePath]);

        } catch (\Exception $e) {
            // Handle decryption errors if necessary
            session()->flash('error', $e->getMessage());
        }
    }


    function decryptFile($filePath, $fileExtension = null, $directoryPath = null)
    {
        try {
            // Check if the file exists
            if (!Storage::exists($filePath)) {
                return "File does not exist.";
            }

            $fileContents = Storage::get($filePath);

            $iv = substr($fileContents, 0, 16);
            $encryptedContents = substr($fileContents, 16);

            // Decrypt the file contents using AES-256-CBC decryption
            $decryptedContents = openssl_decrypt(
                $encryptedContents,
                'aes-256-cbc',
                env('AES_Secret_Key_DB'),
                0,
                $iv
            );

            if ($decryptedContents === false) {
                $decryptedContents = $fileContents;
            }

            // Get the user's subfolder for storing decrypted files
            $subFolder = Auth::id();
            $directoryPath = $directoryPath ?: storage_path('app/public/tmp/' . $subFolder);

            if (!File::isDirectory($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }

            // Extract the original filename and extension
            $originalFileName = pathinfo($filePath, PATHINFO_FILENAME);
            $originalFileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            // Generate a unique filename within the specified directory
            $newTempFilePath = tempnam($directoryPath, $originalFileName . '_');

            // Add the original file extension to the new file path
            $newTempFilePathWithExtension = $newTempFilePath . '.' . $originalFileExtension;

            // Write the decrypted contents to the file
            file_put_contents($newTempFilePathWithExtension, $decryptedContents);

            $url = str_replace(storage_path('app/public'), 'storage', $newTempFilePathWithExtension);

            return $url;

        } catch (\Exception $e) {
            // Handle decryption errors if necessary
            return $e->getMessage();
        }
    }

}
