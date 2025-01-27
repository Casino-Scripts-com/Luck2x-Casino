<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sends extends Model{

    protected $table = 'sends';

    protected $fillable = ['sender', 'receiver', 'sum'];

    protected $hidden = ['created_at', 'updated_at'];

}