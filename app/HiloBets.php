<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class HiloBets extends Model
{
    protected $table = 'hilo_bets';
    
    protected $fillable = ['game_id', 'user_id', 'bet_type', 'bet_x', 'sum', 'balance', 'win', 'win_sum', 'win_bonus'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
