<?php

namespace App\Livewire\BusinessOwner;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Tickets extends Component
{
    #[Layout('layouts.owner')]
    public function render()
    {
        $tickets = Ticket::whereHas('review')->where('user_id', Auth::id())->latest()->get();
        return view('livewire.business-owner.tickets', ['tickets' => $tickets]);
    }
}
