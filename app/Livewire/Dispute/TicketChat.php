<?php

namespace App\Livewire\Dispute;

use App\Jobs\SendMailJob;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Ticket;
use App\Models\TicketChat as ModelsTicketChat;
use App\Models\User;

class TicketChat extends Component
{

    public $ticketId;
    public $userId;
    public $message;
    public $chat;
    public $reviewId;

    public $ticketStatus;

    public $details;



    protected $listeners = ['loadChat', 'emitRefresh' => '$refresh'];

    public function sendMessage()
    {

        $ticket = Ticket::where('id', $this->ticketId)->first();

        $userLastMessage = ModelsTicketChat::where('ticket_id', $ticket->id)
            ->where('sender_id', auth()->user()->id)
            ->latest()
            ->first();


        if ($userLastMessage) {
            $adminUser = User::where('is_admin', 1)->first();

            if ($adminUser) {
                $adminMessageAfterUser = ModelsTicketChat::where('ticket_id', $ticket->id)
                    ->where('id', '>', $userLastMessage->id)
                    ->where('sender_id', $adminUser->id)
                    ->exists();


                if ($adminMessageAfterUser) {

                } else {
                    return back()->with('message', 'Please wait for an admin response');

                }
            }
        }

        $this->validate([
            'message' => 'required'
        ]);

        $data = [
            'ticket_id' => $ticket->id,
            'message' => $this->message,
            'sender_id' => auth()->user()->id
        ];

        ModelsTicketChat::create($data);


        // send email to the user
        $user = User::findOrFail($ticket->user_id);
        $customerEmail = $user->email;
        $subject = "Regarding Your Dispute";
        $heading = "Dispute Resolution";

        $body = "Hello, <br><br>
                We wanted to inform you regarding the latest update on your dispute. Below is the new message you received:<br><br>
                <strong>Message:</strong><br>
                {$data['message']}<br><br>
                Please log in to your account to view the complete conversation and provide any further details or clarification if needed.<br><br>";
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

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendMailJob($emailData, $customerEmail));

        $admin = Setting::where('key', 'admin_email')->first();
        if ($admin) {
            $adminEmail = $admin->value;
            $subject = "New Dispute Message from User";
            $heading = "New Dispute Message";

            $body = "Hello, <br><br>
                A new message regarding a dispute has been received from a user. Below are the details:<br><br>
                <strong>User Email:</strong> " . auth()->user()->email . "<br>
                <strong>Message:</strong><br>
                {$data['message']}<br><br>
                Please take appropriate action.<br><br>";
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

            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];

            dispatch(new SendMailJob($emailData, $adminEmail));
        }

        $this->message = '';
        $this->loadChat($ticket);
    }

    public function render()
    {
        return view('livewire.dispute.ticket-chat');
    }

    public function mount()
    {
        if ($this->ticketId) {
            $ticket = Ticket::find($this->ticketId);
            if ($ticket) {
                $this->loadChat($ticket);
            }
        }
    }

    public function loadChat($ticket)
    {
        $this->reviewId = $ticket['business_review_id'];
        $this->ticketId = $ticket['id'];
        $this->userId = auth()->user()->id;
        $this->ticketStatus = $ticket['ticket_status'] ?? '';
        $this->chat = Ticket::with(['ticketChat'])
            ->where('id', $this->ticketId)
            ->first();

        $this->details = Ticket::with(['review', 'user', 'reviewer'])
            ->where('id', $this->ticketId)
            ->first();


        // $this->dispatch('scrollToBottom', ['id' => 'ChatArea']);
    }
}
