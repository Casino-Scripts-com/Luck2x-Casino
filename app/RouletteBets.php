<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class RouletteBets extends Model
{
    protected $table = 'roulettebets';
    
    protected $fillable = ['user_id', 'round_id', 'price', 'type', 'win', 'win_sum', 'is_fake'];
    
    protected $hidden = ['created_at', 'updated_at'];
    
}