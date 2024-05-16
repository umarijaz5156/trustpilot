<?php

namespace App\Livewire\Admin\Settings;

use App\Models\User;
use Livewire\Component;

class FakeUser extends Component
{

    public $numFakeUsers;
    public function render()
    {
        $fakeUser = User::where('is_fake', 1)
        ->latest()
        ->paginate(10);
         return view('livewire.admin.settings.fake-user', ['fakeUser' => $fakeUser]);
    }

    public function makeFakeUser()
    {
        $this->validate([
            'numFakeUsers' => 'required|integer|min:1|max:300',
        ]);
    
        $numFakeUsers = $this->numFakeUsers;
    
        for ($i = 0; $i < $numFakeUsers; $i++) {
            $user = User::factory()->create([
                'is_fake' => 1,
                'is_hot_bleep' => 1,
                'has_business_account' => 0,
            ]);
        }
    
        return redirect()->route('admin.settings')->with('success', 'Fake users created successfully.');
    }
    
}
