<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class KingBets extends Model
{
    protected $table = 'king_bets';
    
    protected $fillable = ['user_id', 'game_id', 'bet'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
