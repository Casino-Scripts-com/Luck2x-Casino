<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class TournamentPlayers extends Model
{
    protected $table = 'tournamentPlayers';
    
    protected $fillable = ['tour_id', 'user_id', 'bets'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
