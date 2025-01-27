<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class GiveawayUsers extends Model {
	
    protected $table = 'giveaway_users';
    
    protected $fillable = ['giveaway_id', 'user_id'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
