<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{
    protected $table = 'ranks';
    
    protected $fillable = ['title', 'style', 'points', 'bonus', 'icon', 'ids'];
    
}
