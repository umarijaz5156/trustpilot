<?php

namespace App\Livewire\Front\Categories;

use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\Category;
use App\Traits\StarRating;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Business extends Component
{
    use WithPagination;

    public $category;
    public $countryFilter, $sortBy = 1, $companyNameFilter, $ratingFilter;

    public function mount($category)
    {
        $category = str_replace('-', ' ', $category);
        $category = Category::where('title', $category)->first() ?? abort(403, 'Category Not Found');
        $this->category = $category;

    }

    public function updatingCountryFilter()
    {
        $this->resetPage();
        $this->dispatch('initSwiper');
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingCompanyNameFilter()
    {
        $this->resetPage();
    }

    public function updatingRatingFilter()
    {
        $this->resetPage();
    }

    #[Layout('layouts.web')]
    public function render()
    {
        // $companies = BusinessAccount::where('is_approved', true)->where('is_verified', true)->where(function ($query) {
        //     $query->where('category_id', $this->category->id)->orWhere('sub_category_id', $this->category->id);
        // })
        // ->when($this->countryFilter, function($query) {
        //     $query->where('country_id', $this->countryFilter);
        // })
        // ->when($this->companyNameFilter, function($query) {
        //     $query->where('businessName', 'like', "%$this->companyNameFilter%");
        // })
        // ->get();
        // dd($companies);
        $database =  config('database.connections.common_database.database');
           
        $companies = BusinessAccount::join($database.'.users as u', 'u.id', 'business_accounts.user_id')
            ->leftJoin('business_stats as bs', 'bs.business_account_id', 'business_accounts.id')
            ->join('categories as c', 'c.id', '=', 'business_accounts.category_id')
            ->leftJoin('business_reviews as br', function ($join) {
                $join->on('br.business_account_id', '=', 'business_accounts.id');
            })
            ->groupBy('business_accounts.id', 'u.email', 'bs.avg_rating', 'bs.reviews_count')
            ->when($this->sortBy == 3, function ($query) {
                $query->groupBy('br.created_at');
            })
            ->selectRaw('business_accounts.*, u.email as user_email, bs.avg_rating, bs.reviews_count')
            ->where(function ($query) {
                $query->where('business_accounts.category_id', $this->category->id)
                    ->orWhere('business_accounts.sub_category_id', $this->category->id);
            })
            ->when($this->countryFilter, function ($query) {
                $query->where('business_accounts.country_id', $this->countryFilter);
            })
            ->when($this->companyNameFilter, function ($query) {
                $query->where('business_accounts.businessName', 'like', "%$this->companyNameFilter%");
            })
            ->when($this->sortBy == 2, function ($query) {
                $query->orderBy('bs.reviews_count', 'desc');
            })
            ->when($this->sortBy == 3, function ($query) {
                $query->orderBy('br.created_at', 'desc');
            })
            ->when($this->ratingFilter, function ($query) {
                $query->where('bs.avg_rating', '>=', $this->ratingFilter);
            })
            ->where('business_accounts.is_approved', true)
            ->orderByDesc('bs.avg_rating')
            ->paginate(4);


        // $recentlyReviewedCompanies = BusinessReview::whereHas('businessAccount', function ($q) {
        //     $q->where('is_approved', true)->where(function ($q) {
        //         $q->where('category_id', $this->category->id)
        //             ->orWhere('sub_category_id', $this->category->id);
        //     });
        // })
        //     ->latest()->take(10)->distinct('business_account_id')->get();

        // $newestCompanies = BusinessAccount::where(function ($query) {
        //     $query->where('category_id', $this->category->id)->orWhere('sub_category_id', $this->category->id);
        // })
        //     ->where('is_approved', true)
        //     ->latest()->take(10)->get();
        $recentlyReviewedCompanies = BusinessReview::whereHas('businessAccount', function ($q) {
            $q->where('is_approved', true)->where(function ($q) {
                $q->where('category_id', $this->category->id)
                    ->orWhere('sub_category_id', $this->category->id);
            });
        })
        ->with('businessAccount.businessStat') // Eager load the businessStat relationship
        ->latest()
        ->take(10)
        ->distinct('business_account_id')
        ->get()
        ->sortByDesc(function ($review) {
            return $review->businessAccount->businessStat->avg_rating ?? -1; // Sort by avg_rating, or -1 if businessStat is null
        });

        $newestCompanies = BusinessAccount::where(function ($query) {
            $query->where('category_id', $this->category->id)->orWhere('sub_category_id', $this->category->id);
        })
        ->where('is_approved', true)
        ->with('businessStat') // Eager load the businessStat relationship
        ->latest()
        ->take(10)
        ->get()
        ->sortByDesc(function ($company) {
            return $company->businessStat->avg_rating ?? -1; // Sort by avg_rating, or -1 if businessStat is null
        });
    

        $randomCategories = Category::whereNull('parent_id')->get();

        return view('livewire.front.categories.business', ['companies' => $companies, 'recentlyReviewedCompanies' => $recentlyReviewedCompanies, 'newestCompanies' => $newestCompanies, 'randomCategories' => $randomCategories]);
    }
}
