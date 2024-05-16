<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'icon_path',
        'banner_path',
    ];

    
    public function childCategories()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }

    public function grandchildCategories()
    {
        return $this->hasManyThrough(
            Category::class,
            Category::class,
            'parent_id', // Foreign key on categories table
            'parent_id', // Foreign key on categories table
            'id',        // Local key on the current model (Category)
            'id'         // Local key on the intermediate model (Category)
        );
    }

    
}
