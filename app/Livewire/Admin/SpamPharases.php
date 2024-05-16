<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SpamPharases extends Component
{
    public $spam_pharases;

    public function mount()
    {
        $this->spam_pharases = \App\Models\SpamPharase::find(1)?->spam_pharases;
    }

    public function store()
    {
        $this->validate([
            'spam_pharases' => ['required', 'max:1000'],
        ]);
        
        $spamPharases = \App\Models\SpamPharase::updateOrCreate(['id' => 1], ['spam_pharases' => $this->spam_pharases]);
        $this->spam_pharases = $spamPharases->spam_pharases;

        session()->flash('success', 'Spam pharase saved successfully.');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.spam-pharases');
    }
}
