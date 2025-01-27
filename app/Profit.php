<?php namespace App;

use App\Payments;
use App\Settings;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profit extends Model {
	
    protected $table = 'profit';
	
	protected $fillable = ['game', 'sum'];
    
    protected $hidden = ['created_at', 'updated_at'];
}