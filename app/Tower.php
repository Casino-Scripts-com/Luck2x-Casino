<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    protected $fillable = [
    	'user_id', 'bet', 'bombs', 'currency', 'field', 'revealed', 'coeff', 'status'
    ];
}
