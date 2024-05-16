<?php

namespace App\Livewire\BusinessOwner;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    

    #[Layout('layouts.owner')]
   
    public function render()
    { 
        return view('livewire.business-owner.dashboard');
    }

}
