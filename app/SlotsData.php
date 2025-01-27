<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlotsData extends Model
{
    protected $table = 'slots_data';

    protected $fillable = ['user_id', 'trx_id', 'game_id', 'amount', 'type', 'balanceBefore', 'balanceAfter'];
}
