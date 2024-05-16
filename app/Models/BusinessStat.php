<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessStat extends Model
{
    use HasFactory;

    protected $fillable = [

        'business_account_id',
        'reviews_count',
        'avg_rating',
        'positive_reviews_count',
        'negative_reviews_count',
            
    ];

    public function businessAccount()
    {
        return $this->belongsTo(BusinessAccount::class, 'business_account_id');
    }
}
