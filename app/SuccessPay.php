<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuccessPay extends Model
{
    protected $table = 'success_pay';
	
	protected $fillable = ['user', 'price', 'status'];
    
    protected $hidden = ['created_at', 'updated_at'];
    
}