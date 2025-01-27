<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mines extends Model
{
    protected $fillable = [
        'id_users',
        'login',
        'num_mines',
        'bet',
        'mines',
        'click',
        'onOff',
        'result',
        'step',
        'win',
        'can_open',
        'multiplayer',
        'total'
    ];
}
