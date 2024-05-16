<?php

namespace App\Livewire\BusinessOwner\Dispute;

use App\Models\Seller\Seller;
use Livewire\Component;
use App\Models\Ticket;


class TicketsList extends Component
{

    public $tickets;
    public $ticketId;
    public $selectedTicket;


    protected $listeners = ['ticketSelected'];


    public function render()
    {
        if (auth()->user()->is_admin) {
            return view('livewire.business-owner.dispute.tickets-list')->layout('layouts.app');
        } else {
            return view('livewire.business-owner.dispute.tickets-list')->layout('layouts.owner');
        }
    }

    public function mount()
    {
        if (auth()->user()->is_admin) {

            $this->tickets = Ticket::latest()->get();
        } else {

            $this->tickets = Ticket::where('user_id', auth()->user()->id)->latest()->get();
        }
        if ($this->ticketId) {
            $this->getTicket();
        }
    }

    public function ticketSelected($ticket)
    {
        $this->selectedTicket = $ticket['id'];
        $this->dispatch('loadChat', ticket: $ticket);
    }



    public function getTicket()
    {
        $this->selectedTicket = $this->ticketId;
    }
}
