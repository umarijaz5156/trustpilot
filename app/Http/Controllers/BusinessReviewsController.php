<?php

namespace App\Http\Controllers;

use App\Models\BusinessReview;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessReviewsController extends Controller
{
    
    public function getBusinessReviews(Request $request, $userId)
    {
        $userId = substr($userId, 9, -9);
        $user = User::findOrFail($userId);
        if($user){
            $businessName = $user->businessAccount->businessName;
            $reviewsCount = $user->businessAccount->businessStat['reviews_count'] ?? 0;
            $averageRating = $user->businessAccount->businessStat['avg_rating'] ?? 0;
            $latestReviews = $user->businessAccountReviews->sortByDesc('created_at')->take(5);
            $latestReviewsData = $latestReviews->map(function ($review) {
                return [
                    'review' => $review->review,
                    'rating' => $review->rating,
                    'user' => [
                        'name' => $review->user->name
                    ]
                ];
            });
        }else{
            $businessName = '';
            $reviewsCount = '';
            $averageRating = '';
            $latestReviews = [];
            
        }
        $logoUrl = asset('images/LOGO.png');

        return response()->json([
            'reviewsCount' => $reviewsCount,
            'averageRating' => $averageRating,
            'latestReviews' => $latestReviewsData,
            'businessName' => $businessName,
            'logoUrl' => $logoUrl,

        ]);
        
    }
}
