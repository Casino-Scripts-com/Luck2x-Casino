<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Hilo extends Model
{
    protected $table = 'hilo';
    
    protected $fillable = ['card_name', 'card_amount', 'card_section', 'card_sign', 'status', 'profit', 'hash'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
