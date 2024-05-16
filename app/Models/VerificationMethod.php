<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'field_text',
        'default_response',
        'response_type',
    ];

}
