<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    use HasFactory;

    protected $connection =  'mysql';
    protected $fillable = [
        'user_id',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
    public function response()
    {
        return $this->hasMany(VerificationResponse::class)->with('user');
    }
}
