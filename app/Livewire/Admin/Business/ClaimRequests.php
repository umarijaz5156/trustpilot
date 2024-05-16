<?php

namespace App\Livewire\Admin\Business;

use App\Models\BusinessClaimRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ClaimRequests extends Component
{
    public $claimAcceptRequestid;
    public $claimDenyRequestId;
    public $confirmRequestModal = false;
    public $denyRequestModal = false;

    public function confirmAcceptRequest($claimAcceptRequestId)
    {
        $this->claimAcceptRequestid = $claimAcceptRequestId;
        $this->confirmRequestModal = true;
    }

    public function confirmRequest()
    {
        try {
            DB::beginTransaction();
            $claimAcceptRequestId = $this->claimAcceptRequestid;
    
            if($claimAcceptRequestId) {
                $claimBusinessRequest = BusinessClaimRequest::findOrFail($claimAcceptRequestId);
                if($claimBusinessRequest) {
                    $claimBusinessRequest->user()->update(['has_business_account' => true]);

                    $businessId = $claimBusinessRequest->business_account_id;
                   
                    $userId = $claimBusinessRequest->user_id;
                    $businessName = $claimBusinessRequest->businessAccount->businessName;

                    $claimBusinessRequest->businessAccount->user()->update(['has_business_account' => false]);
    
                    $claimBusinessRequest->businessAccount()->update([
                        'user_id' =>$userId,
                        'is_verified' => false,
                        'is_approved' => true,
                    ]);


                    $claimBusinessRequest->update(['is_claimed' => 1]);
                    
                    DB::commit();
                    session()->flash('success', 'Users claim request accepted and business account has been assigned to him');
                    return redirect()->route('admin.view-business-account', ['business_name' => $businessName]);
                }
            }

            $this->reset('confirmRequestModal', 'claimAcceptRequestid');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function confirmDenyClaimRequest($claimId)
    {
        $this->claimDenyRequestId = $claimId;
        $this->denyRequestModal = true;
    }

    public function denyRequest()
    {
        try {
            DB::beginTransaction();

            $request = BusinessClaimRequest::findOrFail($this->claimDenyRequestId);
            $hotbleepUser = User::where('is_hot_bleep', 1)->first();
            $user = $request->user;
            $businessAccount = $request->businessAccount;
            
            if ($request->is_claimed == 1) {
                // delete verification request of the business user
                $user->verificationRequest()->delete();
    
                // remove has_business_account check of claimed user
                $businessAccount->user()->update(['has_business_account' => 0]);
    
                // ReAssign business account to hot-bleep user
                if($hotbleepUser) {
                    $businessAccount->user_id = $hotbleepUser->id;
                    $businessAccount->save();
                }
            }
            
            $request->delete();
            DB::commit();

            $this->reset('claimDenyRequestId', 'denyRequestModal');
            session()->flash('success', 'Request rejected successfully.');
            
        } catch(\Throwable $th) {

        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $claimRequests = BusinessClaimRequest::paginate(20);
        return view('livewire.admin.business.claim-requests', ['claimRequests' => $claimRequests]);
    }
}
