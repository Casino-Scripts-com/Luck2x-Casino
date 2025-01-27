<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Roulette extends Model
{
    protected $table = 'roulette';
    
    protected $fillable = ['winner_num', 'winner_color', 'price', 'status', 'ranked', 'hash'];
    
    protected $hidden = ['created_at', 'updated_at'];
    
}
