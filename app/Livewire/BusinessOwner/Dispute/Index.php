<?php

namespace App\Livewire\BusinessOwner\Dispute;

use App\Models\Ticket;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public $ticketId;
    public $count;


    public function render()
    {
        if ($ticket = Ticket::find($this->ticketId)) {
            
            }
        if (auth()->user()->is_admin) {
            return view('livewire.business-owner.dispute.index')->layout('layouts.app');

        }else{
                return view('livewire.business-owner.dispute.index')->layout('layouts.owner');

            }
    }

    public function mount($id = null)
    {
        if (auth()->user()->is_admin) {

            $this->count = Ticket::count();
        } else {

            $this->count = Ticket::where('user_id', auth()->user()->id)->count();
        }
        $this->ticketId  = $id;
    }
}
