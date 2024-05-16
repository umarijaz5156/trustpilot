<?php

namespace App\Livewire\Admin;

use App\Enums\VerificationStatus;
use App\Jobs\SendMailJob;
use Livewire\Component;
use App\Models\BusinessAccount;
use App\Models\VerificationRequest;
use App\Models\VerificationResponse;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;



class ViewBusinessAccount extends Component
{

    use WithPagination;

    public $businessAccount;
    public $verificationRequest;

    public $description;

    public $viewResponseModel = false;
    public $changeStatusModal = false;

    public $changeVerifiedModal = false;

    public $replyResponseModal = false;

    public $statusChangeInfo = ['status' => 0, 'accountId' => 0];

    public $verifiedChangeInfo = ['status' => 0, 'accountId' => 0];


    public $accountId;
    public $responseId;
    public $verificationRequestId;

    public $need_more_info;

    public $status = 'need more info';

    public $verificationResponseById;
    #[Layout('layouts.app')]

    public function render()
    {
        if ($this->verificationRequest) {
            $this->verificationRequestId = $this->verificationRequest->id;
            $verificationResponse = VerificationResponse::where('verification_request_id', $this->verificationRequest->id)->with('user')->latest()->paginate(7);
        } else {
            $this->verificationRequestId = 0;
            $verificationResponse = [];
        }
        return view('livewire.admin.view-business-account', [
            'verificationResponse' => $verificationResponse,
        ]);
    }

    public function mount($business_name)
    {
        $this->businessAccount = BusinessAccount::where('businessName', $business_name)->with(['user', 'country', 'category', 'subCategory', 'verificationMethod'])->firstOrFail();
        $this->accountId = $this->businessAccount->id;
        $this->verificationRequest = VerificationRequest::where('user_id', $this->businessAccount->user_id)->with('response')->first();
    }

    public function verifyBusinessAccount()
    {

        $this->verificationRequest = VerificationRequest::where('user_id', $this->businessAccount->user_id)->with('response')->first();
        if ($this->verificationRequest) {
            $this->verificationRequest->update([
                'status' => 'pending',
            ]);
            session()->flash('success', 'Your Request already Submit successfully!');
        } else {
            $this->verificationRequest = VerificationRequest::create([
                'user_id' => $this->businessAccount->user_id,
                'status' => VerificationStatus::Pending->value,
            ]);

            $this->sendVerificationRequestEmail();
            session()->flash('success', 'Your Request Submit successfully!');
        }
        $this->verificationRequestId = $this->verificationRequest->id;
    }

    public function sendVerificationRequestEmail()
    {
        $heading = '<h1>Business Verification Request</h1>';
        $body = '';
        $body .= "<p style='padding-top: 20px;'>
                Dear {$this->businessAccount->username},<br></br>
                Admin has sent a verification request for your business, <a href='".route('front.business.show', ['business_name' => $this->businessAccount->businessName])."'>{$this->businessAccount->businessName}</a>.</p>
                <p style='padding-bottom: 20px;'> Please review and take necessary actions.</p>";

        $subject = "Business Verification Request";

        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
        // send main to user
        dispatch(new SendMailJob($data, $this->businessAccount->user->email));

    }


    public function confirmChangeStatus($id, $status)
    {
        $this->verifiedChangeInfo['status'] = !$status;
        $this->verifiedChangeInfo['accountId'] = $id;
        $this->changeVerifiedModal = true;
    }


    public function updateVerified()
    {
        $businessAccount = BusinessAccount::findOrFail($this->verifiedChangeInfo['accountId']);
        $businessAccount->is_verified = $this->verifiedChangeInfo['status'];
        $businessAccount->save();

      

        $this->verificationRequest = VerificationRequest::findOrFail($this->verificationRequestId);
        if ($this->verificationRequest) {
            $status = $this->verifiedChangeInfo['status'] == 1 ? VerificationStatus::Verified->value : VerificationStatus::Pending->value;
            $this->verificationRequest->update([
                'status' => $status,
            ]);
        }

        if ($this->verifiedChangeInfo['status'] == 1) {
            $businessAccount = BusinessAccount::findOrFail($this->verifiedChangeInfo['accountId']);
            $businessAccount->is_approved = 1;
            $businessAccount->save();
        }
        $this->businessAccount = BusinessAccount::with(['user', 'country', 'category', 'subCategory', 'verificationMethod'])->findOrFail($this->accountId);

        if($this->verifiedChangeInfo['status'] == 1){
             $this->sendVerifiedEmail();
        }

        $this->reset('verifiedChangeInfo', 'changeVerifiedModal');
        session()->flash('success', 'Account status has been updated successfully!');
    }

    public  function sendVerifiedEmail(){

        $user = $this->businessAccount->user;
        $heading = '<h1>Business Verified</h1>';
        $body = '';
        $body .= "<p style='text-align: left;'>
        Dear {$this->businessAccount->username},<br><br>
        Your business, <a href='".route('front.business.show',['business_name' => $this->businessAccount->businessName])."'>{$this->businessAccount->businessName}</a>, has been verified by the admin.
        </p>";

         $subject = "Business Verified";
        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
        dispatch(new SendMailJob($data, $user->email));
    }



    public function confirmChangeStatusApproved($id, $status)
    {
        $this->statusChangeInfo['status'] = !$status;
        $this->statusChangeInfo['accountId'] = $id;
        $this->changeStatusModal = true;
    }

    public function updateStatus()
    {
        $businessAccount = BusinessAccount::findOrFail($this->statusChangeInfo['accountId']);
        $businessAccount->is_approved = $this->statusChangeInfo['status'];
        $businessAccount->save();

        $this->businessAccount = BusinessAccount::with(['user', 'country', 'category', 'subCategory', 'verificationMethod'])->findOrFail($this->accountId);


        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Account status has been updated successfully!');
    }


    public function viewResponse($id)
    {
        $this->verificationResponseById = VerificationResponse::where('id', $id)->with('user')->first();
        $this->viewResponseModel = true;
    }

    public function replyResponse($id = null)
    {
        $this->responseId = $id;
        if ($id) {
            $this->verificationResponseById = VerificationResponse::where('id', $id)->with('user')->first();
            $this->description = $this->verificationResponseById->response;
        } else {
            $this->description = '';
        }
        $this->verificationRequest = VerificationRequest::with('user')->findOrFail($this->verificationRequestId);
        // $this->status = $this->verificationRequest->status;

        $this->replyResponseModal = true;
        $this->dispatch('initDescriptionEditor');
        $this->dispatch('updateCkEditorBodyRes');
    }

    public function StoreOrUpdate()
    {
        $this->validate([
            'description' => 'required',
        ]);

        if ($this->responseId) {
            $verificationResponse = VerificationResponse::with('user')->findOrFail($this->responseId);
            $verificationResponse->response = $this->description;
            $verificationResponse->save();
        } else {
            $verificationResponse = VerificationResponse::create([
                'verification_request_id' => $this->verificationRequestId,
                'user_id' => auth()->user()->id,
                'response' => $this->description,
            ]);
            $verificationResponse->load('user');
        }


        $this->verificationRequest = VerificationRequest::with('user')->findOrFail($this->verificationRequestId);
        $business = BusinessAccount::findOrFail($this->accountId);

        if ($this->verificationRequest) {
            if ($this->status == 'need more info') {
                $this->verificationRequest->update([
                    'status' => VerificationStatus::NeedMoreInfo->value,
                ]);
                $business->update([
                    'is_verified' => 0,
                ]);

                $this->sendMoreInfoEmail();

            } else if ($this->status == 'pending') {
                $this->verificationRequest->update([
                    'status' => VerificationStatus::Pending->value,
                ]);
                $business->update([
                    'is_verified' => 0,
                ]);
            } else {
                $this->verificationRequest->update([
                    'status' => VerificationStatus::Verified->value,
                ]);

                $business->update([
                    'is_verified' => 1,
                ]);
            }
        }

        $this->businessAccount = BusinessAccount::with(['user', 'country', 'category', 'subCategory', 'verificationMethod'])->findOrFail($this->accountId);

        // $this->verificationResponse = VerificationResponse::where('verification_request_id', $this->verificationRequestId)->with('user')->latest()->get();
        $this->replyResponseModal = false;
        $this->description = '';
        if ($this->responseId) {
            session()->flash('success', 'Response has been updated successfully!');
        } else {
            session()->flash('success', 'Response has been submitted successfully!');
        }
    }

    public function sendMoreInfoEmail(){
        $this->businessAccount = BusinessAccount::findOrFail($this->accountId);
        $user = $this->businessAccount->user;
        $heading = '<h1>More Information Required</h1>';
        $body = '';
        $body .= "<p style='text-align: left;'>
        Dear {$this->businessAccount->username},<br><br>
        We require additional information to verify your business account, <a href='".route('business-owner.details')."'>{$this->businessAccount->businessName}</a>.
        </p>";
    
        $subject = "More Information Required for Business Verification";
        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
        dispatch(new SendMailJob($data, $user->email));
    }
    
}
