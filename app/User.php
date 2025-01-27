<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';

    protected $fillable = [
        'unique_id', 'username', 'password', 'avatar', 'sessionId', 'user_id', 'balance', 'bonus', 'requery', 'ip', 'is_admin', 'superadmin', 'is_lowadmin', 'is_moder', 'is_youtuber', 'fake', 'time', 'banchat', 'banchat_reason', 'ban', 'ban_reason', 'link_trans', 'link_reg', 'ref_id', 'ref_money', 'ref_money_all', 'style', 'rank', 'bsum', 'tg_id', 'tg_bonus', 'clan_id', 'auth_token', 'current_id'
    ];

    protected $hidden = ['remember_token'];
	
	static function getUser($id) {
		$user = self::select('username', 'avatar', 'unique_id')->where('id', $id)->first();
		return $user;
	}
	static function getStyle($id) {
		$user = self::select('style')->where('id', $id)->first();
		$style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
		return $style;
	}
	static function findRef($id) {
		$user = self::select('id', 'username', 'avatar', 'unique_id')->where('unique_id', $id)->first();
		return $user;
	}
}
