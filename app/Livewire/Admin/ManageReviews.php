<?php

namespace App\Livewire\Admin;

use App\Models\BusinessReview;
use App\Models\BusinessStat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ManageReviews extends Component
{


    
    public $search;
    public $filterDate;
    public $sortField;
    public $sortAsc = true;

    public $statusChangeInfo = ['status' => 0, 'accountId' => 0, 'reviewId' => 0];
    public $changeStatusModal = false;
    public $confirmingDeletionModal = false;

    public $deleteId;

    #[Layout('layouts.app')]

    public function render()
    {
        $query = BusinessReview::with('businessAccount', 'user');
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
      
        // Order reviews by creation date in descending order
        $query->orderBy('created_at', 'desc');
    
        // Apply sorting if needed
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }
    
        $reviews = $query->paginate(15);
        return view('livewire.admin.manage-reviews', compact('reviews'));
    }
    
    

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function handleSearchChange(){

        $this->search;
    }

    public function confirmChangeStatusApproved($id, $status)
    {
        $businessReview = BusinessReview::find($id);
        $this->statusChangeInfo['status'] = !$status;
        $this->statusChangeInfo['reviewId'] = $id;
        $this->statusChangeInfo['accountId'] = $businessReview->business_account_id;

        $this->changeStatusModal = true;
    }

    public function updateStatus()
    {
        $businessReview = BusinessReview::findOrFail($this->statusChangeInfo['reviewId']);
        $businessReview->is_approved = $this->statusChangeInfo['status'];

        if($this->statusChangeInfo['status'] == 0){
            $businessReview->disputed = 0;
        }else{
            $businessReview->disputed = 1;
        }

        $businessReview->save();

        $businessStat = BusinessStat::where('business_account_id', $this->statusChangeInfo['accountId'])->first();
        $businessStat->avg_rating = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->avg('rating') ?? 0;
        $businessStat->reviews_count = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->count() ?? 0;
        $positiveReviewsCount = BusinessReview::where('business_account_id', $this->statusChangeInfo['accountId'])->where('is_approved', 1)->where('rating', '>=', 3)->count() ?? 0;
        $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;

        $businessStat->positive_reviews_count = $positiveReviewsCount;
        $businessStat->negative_reviews_count = $negativeReviewsCount;
        $businessStat->save();


        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Review status has been updated successfully!');
    }

    public function deleteAccount($id)
    {
        $this->deleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $review = BusinessReview::findOrFail($this->deleteId);
            if ($review) {
                $review->delete();

                 $businessId = $review->business_account_id;
                 $businessStat = BusinessStat::where('business_account_id', $businessId)->first();
                 $businessStat->avg_rating = BusinessReview::where('business_account_id', $businessId)->where('is_approved', 1)->avg('rating') ?? 0;
                 $businessStat->reviews_count = BusinessReview::where('business_account_id', $businessId)->where('is_approved', 1)->count() ?? 0;
                 $positiveReviewsCount = BusinessReview::where('business_account_id', $businessId)->where('is_approved', 1)->where('rating', '>=', 3)->count() ?? 0;
                 $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;
         
                 $businessStat->positive_reviews_count = $positiveReviewsCount;
                 $businessStat->negative_reviews_count = $negativeReviewsCount;
                 $businessStat->save();

                DB::commit();
                $this->reset('deleteId', 'confirmingDeletionModal');
                session()->flash('success', 'The Review has been deleted successfully!');
            } else {
                session()->flash('error', 'Something went wrong, please try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong, please try again.');
        }
    }
}
