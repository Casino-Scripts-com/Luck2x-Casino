<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class King extends Model
{
    protected $table = 'king';
    
    protected $fillable = ['winner_id', 'bank', 'status'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
