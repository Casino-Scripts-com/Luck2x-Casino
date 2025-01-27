<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
	
	protected $fillable = ['domain', 'sitename', 'title', 'description', 'keywords', 'site_disable', 'vk_url', 'vk_support_link', 'vk_service_key', 'censore_replace', 'chat_dep', 'fakebets', 'fake_min_bet', 'fake_max_bet', 'fk_mrh_ID', 'fk_secret1', 'fk_secret2', 'fk_api', 'fk_wallet', 'payeer_mrh_ID', 'payeer_secret1', 'payeer_secret2', 'payeer_account_ID', 'payeer_api_ID', 'payeer_api_pass', 'profit_koef', 'profit_money', 'jackpot_commission', 'wheel_timer', 'wheel_min_bet', 'wheel_max_bet', 'wheel_rotate', 'wheel_rotate2', 'wheel_rotate_start', 'crash_min_bet', 'crash_max_bet', 'crash_timer', 'battle_timer', 'battle_min_bet', 'battle_max_bet', 'battle_commission', 'dice_min_bet', 'dice_max_bet', 'flip_commission', 'flip_min_bet', 'flip_max_bet', 'hilo_timer', 'hilo_min_bet', 'hilo_max_bet', 'hilo_bets', 'exchange_min', 'exchange_curs', 'ref_perc', 'ref_sum', 'min_ref_withdraw', 'min_dep', 'min_dep_withdraw', 'requery_perc', 'requery_bet_perc', 'dep_bonus_min', 'dep_bonus_perc', 'bonus_group_time', 'max_active_ref', 'payeer_com_percent', 'payeer_com_rub', 'payeer_min', 'qiwi_com_percent', 'qiwi_com_rub', 'qiwi_min', 'yandex_com_percent', 'yandex_com_rub', 'yandex_min', 'webmoney_com_percent', 'webmoney_com_rub', 'webmoney_min', 'visa_com_percent', 'visa_com_rub', 'visa_min'];
    
    public $timestamps = false;
    
}