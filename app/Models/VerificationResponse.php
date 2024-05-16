<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_request_id',
        'user_id',
        'response',
    ];

    public function request()
    {
        return $this->belongsTo(VerificationRequest::class);
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
