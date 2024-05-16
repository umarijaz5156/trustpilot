<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reply_from',
        'business_review_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessReview()
    {
        return $this->belongsTo(BusinessReview::class);
    }
}
