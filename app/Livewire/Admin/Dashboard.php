<?php

namespace App\Livewire\Admin;

use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;


class Dashboard extends Component
{

    #[Layout('layouts.app')]

    public function render()
    {

        $subFolder = Auth::id();
        $directoryPath = storage_path('app/public/tmp');
    
        if (File::isDirectory($directoryPath)) {
            File::deleteDirectory($directoryPath);
        }

        $totalUsers = User::where('is_admin',0)->count();
        $totalBusinessAccount = User::where('is_admin',0)->where('has_business_account',1)->count();

        $businessAccounts = BusinessAccount::latest()->take(10)->get();
        $latestReviews = BusinessReview::latest()->with('user')->take(10)->get();
        
        return view('livewire.admin.dashboard',[
            'totalUsers' => $totalUsers,
            'totalBusinessAccount'=>$totalBusinessAccount,
            'businessAccounts'=>$businessAccounts,
            'latestReviews'=>$latestReviews
        ]);
    }
}
