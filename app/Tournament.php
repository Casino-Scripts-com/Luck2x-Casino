<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tournament extends Model
{
    protected $table = 'tournament';
    
    protected $fillable = ['title', 'reward', 'members', 'status', 'start', 'end'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
