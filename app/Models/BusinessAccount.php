<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model
{
    use HasFactory;
protected $connection = 'mysql';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'username',
        'description',
        'phone_number',
        'specialization',
        'category_id',
        'sub_category_id',
        'country_id',
        'business_image',
        'businessName',
        'websiteUrl',
        'verification_option',
        'is_approved',
        'is_verified',
        'individual_or_business',
    ];


    public function updateStats()
    {
        $reviews = $this->reviews()->get();

        $totalReviews = $reviews->count();
        $totalRating = $reviews->sum('rating');
        $avgRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
        $positiveReviewsCount = $reviews->filter(function ($review) {
            return $review->rating >= 3; // Assuming ratings of 3 or higher are positive
        })->count();
        $negativeReviewsCount = $totalReviews - $positiveReviewsCount;

        $stats = BusinessStat::firstOrCreate([
            'business_account_id' => $this->id,
        ]);

        $stats->update([
            'reviews_count' => $totalReviews,
            'avg_rating' => $avgRating,
            'positive_reviews_count' => $positiveReviewsCount,
            'negative_reviews_count' => $negativeReviewsCount,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', );
    }

    public function verificationMethod()
    {
        return $this->belongsTo(VerificationMethod::class, 'verification_option', );
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function reviews()
    {
        return $this->hasMany(BusinessReview::class);
    }

    public function businessStat()
    {
        return $this->hasOne(BusinessStat::class);
    }

    public function businessClaimRequest()
    {
        return $this->hasOne(BusinessClaimRequest::class);
    }

    public function generateStarRating()
    {
        $rating = $this->businessStat?->avg_rating ?? 0;
        $fullStars = floor($rating);
        $remainder = $rating - $fullStars;

        $orangeStar = '<span class="text-sm">🔥</span>';
        $whiteStar = '<span class="text-sm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M323.6 51.2c-20.8 19.3-39.6 39.6-56.2 60C240.1 73.6 206.3 35.5 168 0 69.7 91.2 0 210 0 281.6 0 408.9 100.3 512 224 512s224-103.2 224-230.4c0-53.3-52-163.1-124.4-230.4zm-19.5 340.7C282.4 407 255.7 416 226.9 416 154.7 416 96 368.3 96 290.8c0-38.6 24.3-72.6 72.8-130.8 6.9 8 98.8 125.3 98.8 125.3l58.6-66.9c4.1 6.9 7.9 13.6 11.3 20 27.4 52.2 15.8 119-33.4 153.4z" fill="white"/></svg></span>';
        $halfStar = '<span class="text-sm">🔥</span>';
        

//         $whiteStar = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
//         viewBox="0 0 14 14" fill="none">
//         <path
//             d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
//             fill="white"></path>
//     </svg>';
//         $orangeStar = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
//         viewBox="0 0 14 14" fill="none">
//         <path
//             d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
//             fill="orange"></path>
//     </svg>';

//         $halfStar = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
//     <defs>
//         <linearGradient id="orangeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
//             <stop offset="50%" style="stop-color: orange; stop-opacity: 1" />
//             <stop offset="50%" style="stop-color: white; stop-opacity: 1" />
//         </linearGradient>
//     </defs>
//     <path d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z" fill="url(#orangeGradient)"></path>
// </svg>';

        $stars = str_repeat($orangeStar, $fullStars);
        if ($rating > 0) {
            if ($remainder > 0 && $remainder <= 0.2) {
                $stars .= $whiteStar;
            } elseif ($remainder > 0.2 && $remainder <= 0.8) {
                $stars .= $halfStar;
            } else if ($remainder >= 0.8) {
                $stars .= $orangeStar;
            }

            if ($fullStars < 5)
                $stars .= str_repeat($whiteStar, 5 - $fullStars - 1);
        } else {
            $stars = str_repeat($whiteStar, 5);
        }


        return $stars;
    }

    public function getSmileyAndMessage()
    {
        $rating = 4.3;//$this->businessStat->avg_rating;

          if ($rating >= 4.5) {
            $iconClass = 'fas fa-grin-stars text-green-500'; // Excellent
            $message = 'Excellent';
        } elseif ($rating >= 4 && $rating < 4.5) {
            $iconClass = 'fas fa-smile text-yellow-500'; // Good
            $message = 'Good';
        } elseif ($rating >= 3 && $rating < 4) {
            $iconClass = 'fas fa-meh text-orange-500'; // Average
            $message = 'Average';
        } else {
            $iconClass = 'fas fa-frown text-red-500'; // Bad
            $message = 'Bad';
        }

        return array('iconClass' => $iconClass, 'message' => $message);
    }
}
