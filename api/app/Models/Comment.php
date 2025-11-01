<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'content', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


    public function answers()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
