<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'body', 'image_path'];
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }


}
