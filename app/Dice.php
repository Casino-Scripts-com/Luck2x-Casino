<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Dice extends Model
{
    protected $table = 'dice';
    
    protected $fillable = ['user_id', 'sum', 'perc', 'vip', 'num', 'range', 'win', 'win_sum', 'balType', 'fake', 'hash'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
