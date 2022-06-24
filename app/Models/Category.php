<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'category_id'];


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
