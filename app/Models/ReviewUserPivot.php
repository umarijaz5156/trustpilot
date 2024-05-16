<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ReviewUserPivot extends Pivot
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table =  'review_user_pivot';
    
    protected $guarded = [];
}
