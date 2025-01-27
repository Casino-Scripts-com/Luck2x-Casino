<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Jackpot;
use App\JackpotBets;
use App\Wheel;
use App\WheelBets;
use App\Crash;
use App\CrashBets;
use App\CoinFlip;
use App\Battle;
use App\BattleBets;
use App\Hilo;
use App\HiloBets;
use App\Sends;
use App\Dice;
use App\Bonus;
use App\BonusLog;
use App\Payments;
use App\Exchanges;
use App\Withdraw;
use App\Profit;
use App\Promocode;
use App\PromoLog;
use App\Giveaway;
use App\GiveawayUsers;
use App\Ranks;
use App\Styles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
		DB::connection()->getPdo()->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
    public function index($id) {
    	$user = User::where('unique_id', $id)->first();
    	if(!$user && $id != 'admin') return redirect()->route('index')->with('error', 'User not found');
    	if(!$user && $id == 'admin') return redirect()->route('index')->with('error', 'Administrator profile hidden');

    	return view('pages.profile', compact('user'));
    }
}