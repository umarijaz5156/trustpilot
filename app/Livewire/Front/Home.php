<?php

namespace App\Livewire\Front;

use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\Category;
use App\Models\Setting;
use App\Traits\StarRating;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

use Livewire\Component;

class Home extends Component
{
    public $businessAccounts = [];
    public $companies;
    public $search = '';
    public $searchCategories;

    public $categories;
    public $batchSize = 16;
    public $loadedCategoriesCount = 0;



    public function mount()
    {
        $this->checkSetupFile();
        $this->loadCategories();

        $this->businessAccounts = BusinessAccount::with(['user', 'country', 'category', 'subCategory', 'verificationMethod'])->where('is_verified', 1)->where('is_approved', 1)->get();
    }

    public function loadCategories()
    {
        $this->categories = Category::whereNull('parent_id')
            ->orderBy('title', 'asc')
            ->take($this->batchSize)
            ->get();
            
        $this->loadedCategoriesCount = Category::whereNull('parent_id')
        ->orderBy('title', 'asc')
        ->take($this->batchSize)
        ->count();
    }
    public function loadCategoriesMore()
    {
        $this->batchSize += 8; 
        $this->loadCategories();
    }
    

    public function checkSetupFile()
    {
        $installed = Storage::disk('public')->exists('installed');

        if ($installed === false) {
            return redirect()->route('setup.check');
        }
    }

    #[Layout('layouts.web')]
    public function render()
    {
        // $categories = Category::whereNull('parent_id')->latest()->get();
        $recentReviews = BusinessReview::whereHas('businessAccount', function($query) {
            $query->where('is_approved', true);
        })->latest()->inRandomOrder()->take(8)->get();

        $newestCompanies = BusinessAccount::where('is_approved', true)
        ->with('businessStat') 
        ->latest()
        ->take(10) 
        ->get();
    
        $setting = Setting::where('key', 'feature_business')->first();
        $businessIds = [];
        if ($setting && $setting->value) {
            $businessIds = json_decode($setting->value, true);
        }

        // $featureCompanies = BusinessAccount::whereIn('id', $businessIds)
        //     ->where('is_approved', true)
        //     ->get();

            $featureCompanies = BusinessAccount::whereIn('id', $businessIds)
    ->where('is_approved', true)
    ->with('businessStat') 
    ->get()
    ->sortByDesc(function ($company) {
        return $company->businessStat->avg_rating ?? -1;
    });


        $mostRatedBusiness = BusinessStat::orderBy('avg_rating', 'desc')
        ->whereHas('businessAccount', function ($query) {
            $query->where('is_approved', true);
        })
        ->with(['businessAccount' => function ($query) {
            $query->where('is_approved', true);
        }])
        ->take(15)
        
        ->get();
        if ($this->search) {
            $this->companies = BusinessAccount::where('businessName', 'like', '%' . $this->search . '%')->where('is_approved', true)->with('businessStat')->get();
            $this->searchCategories = Category::where('title', 'like', '%' . $this->search . '%')->get();
        }
        return view('livewire.front.home', ['featureCompanies' => $featureCompanies, 'mostRatedBusiness' => $mostRatedBusiness ,'recentReviews' => $recentReviews, 'newestCompanies' => $newestCompanies]);
    }
}
