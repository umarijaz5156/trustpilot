<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClaimRequest extends Model
{
    use HasFactory;
   protected $connection = 'mysql';
    protected $fillable = ['business_account_id', 'user_id', 'is_claimed','claimDetails'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessAccount()
    {
        return $this->belongsTo(BusinessAccount::class);
    }
}
