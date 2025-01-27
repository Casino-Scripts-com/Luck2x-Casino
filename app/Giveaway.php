<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Giveaway extends Model {
	
    protected $table = 'giveaway';
    
    protected $fillable = ['sum', 'type', 'time_to', 'group_sub', 'min_dep', 'winner_id', 'status'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
