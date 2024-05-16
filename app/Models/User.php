<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $connection = 'common_database';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'has_business_account',
        'verify_code',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function businessAccount()
    {
        if($this->is_hot_bleep == 1){
            return $this->hasMany(BusinessAccount::class);
        }else{
            return $this->hasOne(BusinessAccount::class);
        }
    }

    public function businessAccountReviews()
    {
        return $this->hasMany(BusinessReview::class);
    }

    public function verificationRequest()
    {
        return $this->hasOne(VerificationRequest::class);
    }

    public function businessClaimRequest()
    {
        return $this->hasOne(BusinessClaimRequest::class);
    }

    public function businessReviews()
    {
        
        return $this->belongsToMany(BusinessReview::class, 'review_user_pivot', 'user_id', 'business_review_id');
    }
}
