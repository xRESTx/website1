<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['visited_at', 'url', 'ip_address', 'host', 'user_agent'];
    public $timestamps = true;
}
