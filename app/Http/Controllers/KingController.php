<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\King;
use App\KingBets;
use App\Models\Settings;
use DB;

class KingController extends Controller
{
	protected $bet = 2;

    public function __construct() {
        parent::__construct();
		DB::connection()->getPdo()->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
	public function index() {
		$game = King::orderBy('id', 'desc')->where('status', 0)->first() ?? King::orderBy('id', 'desc')->where('status', 2)->first();
		if(!$game) {
			King::create(['status' => 0]);
		}
		$kingBets = KingBets::where('game_id', $game->id)->get();
		$bank = number_format($game->bank, 2, '.', '');
		$bets = [];
		$players = [];
		$playersGet = collect($kingBets)->sortByDesc('created_at')->unique('user_id')->values();
		$betsGet = collect($kingBets)->sortByDesc('created_at')->take(10)->values();
		if($kingBets->count() == 0) {
			$lastBet = [];
		} else {
			$user = User::where('id', collect($kingBets)->last()->user_id)->first();
			$lastBet = [
				'user_id' => $user->id,
				'avatar' => $user->avatar
			];
		}
		foreach ($playersGet as $p) {
			$user = User::where('id', $p->user_id)->first();
			$players[] = [
				'user_id' => $user->id,
				'avatar' => $user->avatar
			];
		}
		foreach ($betsGet as $b) {
			$user = User::where('id', $b->user_id)->first();
			$style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
			$bets[] = [
				'unique_id' => $user->unique_id,
				'user_id' => $user->id,
				'avatar' => $user->avatar,
				'username' => "<span style='$style'>$user->username</span>",
				'bet' => $b->bet
			];
		}
		return view('pages.king', compact('bank', 'bets', 'players', 'lastBet'));
	}
	public function bet(Request $r) {
		if(!Auth::User()) return response()->json(['error' => 'true', 'msg' => 'Authorise yourself']);
		if(Auth::User()->balance < $this->bet) return response()->json(['error' => 'true', 'msg' => 'Not enough coins']);

		$game = King::orderBy('id', 'desc')->where('status', 0)->first();
		if(!$game) return response()->json(['error' => 'true', 'msg' => 'Bets are closed']);
		$user = User::where('id', Auth::User()->id)->first();
		KingBets::create([
			'game_id' => $game->id,
			'user_id' => $user->id,
			'bet' => $this->bet
		]);
		King::where('status', 0)->update([
			'bank' => $game->bank+$this->bet
		]);
		$kingBets = KingBets::where('game_id', $game->id)->get();
		$playersGet = collect($kingBets)->sortByDesc('created_at')->unique('user_id')->values();
		$players = [];
		foreach($playersGet as $p) {
			$user = User::where('id', $p->user_id)->first();
			$players[] = [
				'user_id' => $user->id,
				'avatar' => $user->avatar
			];
		}
		$this->user->balance-=$this->bet;
		$this->user->bsum+=$this->bet;
		$this->user->save();
                $tournament = \App\Tournament::where('status', 1)->where('end', '>', time())->orderBy('id', 'desc')->first();
                if($tournament) {
                    $player = \App\TournamentPlayers::where('user_id', $this->user->id)->where('tour_id', $tournament->id)->first();
                    if($player) {
                        $player->bets+=$this->bet;
                        $player->save();
                    } else {
                        \App\TournamentPlayers::create([
                            'tour_id' => $tournament->id,
                            'user_id' => $this->user->id,
                            'bets' => $this->bet
                        ]);
                    }
                }
		$style = ($this->user->style > 0) ? \App\Styles::where('id', $this->user->style)->first()->css : 0;		
		$this->redis->publish('updateBalance', json_encode([
			'unique_id' => $this->user->unique_id,
			'balance' 	=> round($this->user->balance, 2)
		]));
		$this->redis->publish('updateKing', json_encode([
			'bank' => $game->bank+$this->bet,
			'bet' => [
				'login' => $this->user->username,
				'style' => $style,
				'sum' => $this->bet,
				'unique_id' => $this->user->unique_id,
				'avatar' => $this->user->avatar 
			],
			'players' => $players
		]));

		return response()->json(['success' => 'true', 'msg' => 'The bet is accepted!']);
	}
	public function getSlider() {
		$game = King::orderBy('id', 'desc')->where('status', 0)->first();
		if(!$game or $game->user_id > 0) return false;
		$kingBets = KingBets::where('game_id', $game->id)->get();
		$user = User::where('id', collect($kingBets)->last()->user_id)->first();
		$newbalance = $user->balance + round(King::orderBy('id', 'desc')->where('status', 0)->first()->bank / 100 * 90, 2);
		User::where('id', $user->id)->update([
			'balance' => $newbalance
		]);
		$this->redis->publish('updateBalance', json_encode([
			'unique_id' => $user->unique_id,
			'balance' 	=> round($newbalance, 2)
		]));
		King::where('status', 0)->update([
			'status' => 2,
			'winner_id' => $user->id
		]);
	}
	public function newGame() {
		if(King::where('status', 0)->first()) return false;
		King::create([
			'status' => 0
		]);
	}
}
