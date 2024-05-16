<?php

namespace App\Livewire\Dispute;

use App\Models\Ticket;
use Livewire\Component;

class TicketsList extends Component
{

    public $tickets;
    public $selectedTicket;
    public $ticketId;
    

    protected $listeners = ['ticketSelected'];

    public function render()
    {
        return view('livewire.dispute.tickets-list');
    }

    public function mount()
    {

        
        $this->tickets = Ticket::where('reviewer_user_id', auth()->user()->id)->latest()->get();
        
        if($this->ticketId){
            $this->getTicket();
        }
    }

     public function ticketSelected($ticket)
    {
        $this->selectedTicket = $ticket['id'];
        // $this->dispatch('dispute.ticket-chat','loadChat',ticket: $ticket);
        $this->dispatch('loadChat', ticket: $ticket);

    }

    public function getTicket()
    {
        // $ticket = Ticket::find($this->ticketId);
        $this->selectedTicket = $this->ticketId;
    }
}
