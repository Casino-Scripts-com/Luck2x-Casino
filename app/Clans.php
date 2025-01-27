<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Clans extends Model
{
    protected $table = 'clans';
    
    protected $fillable = ['members', 'name', 'avatar', 'background', 'admin_id', 'need_points', 'points'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
