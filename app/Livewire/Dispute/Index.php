<?php

namespace App\Livewire\Dispute;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\Attributes\Layout;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    #[Layout('layouts.web')]

    public $ticketId;
    public $count;

    public function render()
    {

        return view('livewire.dispute.index');
    }

    public function mount($id = null)
    {
            $this->count = Ticket::where('reviewer_user_id', auth()->user()->id)->count();

        $this->ticketId = $id;
    }
}
