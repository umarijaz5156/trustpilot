<?php

namespace App\Livewire\BusinessOwner;

use Livewire\Component;
use Livewire\Attributes\Layout;

class WidgetComponent extends Component
{


    public $userId;
    public $businessName;
    public $reviewsCount;
    public $averageRating;
    public $latestReviews;

    public $embedCode;

    public $javascriptCode;

    public $encryptedId;

    public $fullUrl;

    #[Layout('layouts.owner')]

    public function mount()
    {
        $this->userId = Auth()->id();
        // Fetch data from backend
        $this->businessName = auth()->user()->businessAccount->businessName;
        $this->reviewsCount = auth()->user()->businessAccount->businessStat['reviews_count'] ?? 0; 
        $this->averageRating = auth()->user()->businessAccount->businessStat['avg_rating'] ?? 0;
        $this->latestReviews = auth()->user()->businessAccountReviews->sortByDesc('created_at')->take(5);
        $this->generateEmbedCode();

        $randomDigits = mt_rand(100000000, 999999999); // Generate a random 9-digit number
        $id = $randomDigits.$this->userId.$randomDigits;
        $this->encryptedId = $id;
        $route = route('business.widget-component');
        $this->fullUrl = "$route";
    
    }
    public function render()
    {
        return view('livewire.business-owner.widget-component');
    }
    public function generateEmbedCode()
    {
        $embedCode = '<div class="bg-gray-100 rounded-lg shadow-md p-6 mb-8">' .
            '<div id="businessName" class="text-xl font-semibold">' . $this->businessName . '</div>' .
            '<div class="mt-4">' .
            '<p>Total Reviews: <span id="reviewsCount">' . $this->reviewsCount . '</span></p>' .
            '<p>Average Rating: <span id="averageRating">' . $this->averageRating . '</span></p>' .
            '</div>' .
            '<div class="mt-6">' .
            '<h4 class="text-lg font-semibold">Latest Reviews:</h4>' .
            '<ul id="latestReviewsList" class="mt-2">';
    
        foreach ($this->latestReviews as $review) {
            $embedCode .= '<li class="border-b pb-2 mb-2">' .
                '<div class="text-gray-800">' . htmlspecialchars($review->review) . '</div>' .
                '<div class="text-sm text-gray-600">Rating: ' . $review->rating . '</div>' .
                '<div class="text-sm italic text-gray-600">By: ' . $review->user->name . '</div>' .
                '</li>';
        }
    
        $embedCode .= '</ul></div></div>';
    
        $this->embedCode = $embedCode;
    }
    

    public function getEmbedHtml()
    {
        return $this->embedCode;
    }

  
}
