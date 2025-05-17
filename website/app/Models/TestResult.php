<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['fullname', 'group', 'answers', 'results'];
    protected $casts = [
        'answers' => 'array',
        'results' => 'array',
    ];
}
