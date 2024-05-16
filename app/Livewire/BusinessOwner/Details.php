<?php

namespace App\Livewire\BusinessOwner;

use App\Enums\VerificationStatus;
use App\Jobs\SendMailJob;
use App\Models\BusinessAccount;
use App\Models\Setting;
use App\Models\User;
use App\Models\VerificationResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Details extends Component
{
    use WithFileUploads;

    public $businessImage;
    public $previousImage;
    public $description;
    public $editBusinessDetailsModal = false;
    public $responseModal = false;
    public $responseMessage;
    public $isEditResponse = false;
    public $responseId;

    public function openEditDetailsModal()
    {
        $this->previousImage = Auth::user()->businessAccount->business_image;
        $this->description = Auth()->user()->businessAccount->description;
        $this->editBusinessDetailsModal = true;
    }

    public function updateDetails()
    {
        $this->validate([
            'businessImage' => 'file|image|mimes:png,jpg,jpeg,webp',
            'description' => 'required|min:5|max:900'
        ]);

        $id = Auth::user()->id;

        $user = User::find($id);

        $data = ['description' => $this->description];

        if ($user && $this->businessImage) {
            $data['business_image'] = $this->businessImage->storeAs('profile-photos', Carbon::now()->timestamp . '-' . $this->businessImage->getClientOriginalName(), 'public');

            Storage::delete(Auth::user()->businessAccount->business_image);

        }


        $user->businessAccount()->update($data);

        $this->reset('businessImage', 'description', 'editBusinessDetailsModal');

        session()->flash('success', 'Record updated successfully');
    }

    public function sendVerificationRequestToAdmin()
    {
        Auth::user()->verificationRequest()->create(['status' => VerificationStatus::Pending->value]);

        session()->flash('success', 'Request sent to admin successfully.');
    }

    public function showResponseModal($responseId = null)
    {
        $this->responseMessage = "";
        $this->resetErrorBag();

        if ($responseId) {
            $this->isEditResponse = true;
            $this->responseId = $responseId;
            $this->responseMessage = VerificationResponse::findOrFail($responseId)->response;
        } else {
            $this->reset('isEditResponse', 'responseId', 'responseMessage');
        }

        $this->dispatch('updateCkEditorBody');
        $this->responseModal = true;
    }

    public function sendResponse()
    {
        $this->validate([
            'responseMessage' => 'required|min:10|max:1000'
        ]);

        Auth::user()->verificationRequest->response()->updateOrCreate(['id' => $this->responseId, 'user_id' => auth()->user()->id], ['response' => $this->responseMessage]);

        $this->sendSubmittedVerificationRequirementsEmail();
        $this->reset('responseMessage', 'responseModal', 'isEditResponse', 'responseId');
        session()->flash('successVerification', '
        We have received your verification request. Sit tight – updates are on the way! No action required. If we need more info, we will reach out.');
    }

    public function sendSubmittedVerificationRequirementsEmail()
    {
        $id = Auth()->user()->id;
        $user = User::find($id);

        if ($user) {
            $heading = '<h1>Business Verification Requirements Submitted</h1>';
            $body = '';
            $body .= "<p>
        Dear Admin,<br><br>
        The user <b>{$user->name}</b> has submitted verification requirements for <a href='".route('front.business.show', ['business_name' => $user->businessAccount->businessName])."'>{$user->businessAccount->businessName}</a>.</p>
        <p style='padding-top: 10px;'> Please review and take necessary actions.</p>";

            $subject = "Business Verification Requirements Submitted";

            $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
            
            // Admin email
            $mailto = Setting::where('key', 'admin_email')->first()?->value;
            // send main to admin
            dispatch(new SendMailJob($data, $mailto));
        }
    }

    #[Layout('layouts.owner')]
    public function render()
    {
        $id = Auth()->user()->id;
        $user = User::findOrFail($id);
        return view('livewire.business-owner.details', ['user' => $user]);
    }
}
