<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Styles extends Model
{
    protected $table = 'styles';
    
    protected $fillable = ['title', 'css'];
    
}
