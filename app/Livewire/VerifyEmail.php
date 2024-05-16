<?php

namespace App\Livewire;

use App\Jobs\SendMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class VerifyEmail extends Component
{

    #[Layout('layouts.web')]

    public $verification_code;
    #[Validate]
    public function render()
    {
        return view('livewire.verify-email');
    }

    public function rules()
    {
        return [
            'verification_code' => ['required', 'min:6', 'max:6'],
        ];
    }
    public function Store(){
        $this->validate();

        $user = Auth::user();

        $authVerificationCode = $user->verify_code;
        $providedVerificationCode = $this->verification_code;
    
        if ($authVerificationCode == $providedVerificationCode) {
            $authUser = User::findOrFail($user->id);
            $authUser->update(['email_verified_at' => now()]);
            return redirect()->route('home');
            
        } else {
            $this->addError('verification_code', 'The verification code is incorrect.');
        }

    }

    public function resendVerificationCode()
    {
        $user = Auth::user();

        $newVerificationCode = mt_rand(100000, 999999);
        $authUser = User::findOrFail($user->id);
        $authUser->update(['verify_code' => $newVerificationCode]);

        $subject = 'Your New Verification Code';
        $heading = 'New Verification Code';
        $body = "Your new verification code is: <strong>$newVerificationCode</strong>. Use this code to verify your email address.";
        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

        dispatch(new SendMailJob($data, $authUser->email));

        session()->flash('success', 'Verification code resent successfully.');
    }
}
