<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'is_published', 'is_featured', 'thumb',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }
}
