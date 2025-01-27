<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Profit;
use App\CoinFlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class CoinFlipController extends Controller {
	
    public function __construct() {
        parent::__construct();
		DB::connection()->getPdo()->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
	
	public function index() {
		$games = CoinFlip::where('status', 0)->get();
		$ended = CoinFlip::where('status', 1)->orderBy('id', 'desc')->limit(10)->get();
		
		$rooms = [];
		foreach($games as $game) {
			$user = User::where('id', $game->heads)->first();
			$style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
			$rooms[] = [
				'id' => $game->id,
				'hash' => $game->hash,
				'heads_from' => $game->heads_from,
				'heads_to' => $game->heads_to,
				'unique_id' => $user->unique_id,
				'username' => "<span style='$style'>$user->username</span>",
				'avatar' => $user->avatar,
				'bank' => $game->bank,
				'balType' => $game->balType
			];
		}
		
		return view('pages.coinflip', compact('rooms', 'ended'));
	}
	
	public function createRoom(Request $r) {
		if(\Cache::has('action.user.' . $this->user->id)) return response()->json(['msg' => 'Wait before the previous action!', 'type' => 'error']);
        \Cache::put('action.user.' . $this->user->id, '', 2);
		if($this->user->ban) return;
		$balType = $r->get('balance');
		
		if($balType != 'balance' && $balType != 'bonus') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of your balance!']);
		
		DB::beginTransaction();
		try {
			$count = CoinFlip::where('heads', $this->user->id)->where('status', 0)->count();
			if($balType == 'balance' && $r->get('sum') > $this->user->balance) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins in your balance to perform the action!']);
			}
			if($balType == 'bonus' && $r->get('sum') > $this->user->bonus) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins in your balance to perform the action!']);
			}
			if($count >= 3) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You have created the maximum number of rooms!']);
			}
			if(!$r->get('sum')) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You forgot to specify the amount of the bet!']);
			}
			if($r->get('sum') < $this->settings->flip_min_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Minimum bet '.$this->settings->flip_min_bet.' coins.!']);
			}
			if($r->get('sum') > $this->settings->flip_max_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Maximum bet '.$this->settings->flip_max_bet.' coins.!']);
			}
			if($balType == 'balance' && $this->user->balance <= 0) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins to place a bet!']);
			}
			if($balType == 'bonus' && $this->user->bonus <= 0) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins to place a bet!']);
			}

			$hash = bin2hex(random_bytes(16));

			$ticketFrom = 1;
			$room = new CoinFlip();
			$coins = round($r->get('sum'), 2);
			$room->heads_from = $ticketFrom;
			$room->heads_to = $ticketFrom + floor($coins*100);
			$room->heads = $this->user->id;
			$room->bank = $coins;
			$room->balType = $balType;
			$room->hash = $hash;
			$room->save();

			if($balType == 'balance') {
				$this->user->bsum+=$coins;
				$this->user->balance -= $coins;
				$this->user->requery += round($coins/100*$this->settings->requery_bet_perc, 3);
				$this->user->save();
                $tournament = \App\Tournament::where('status', 1)->where('end', '>', time())->orderBy('id', 'desc')->first();
                if($tournament) {
                    $player = \App\TournamentPlayers::where('user_id', $this->user->id)->where('tour_id', $tournament->id)->first();
                    if($player) {
                        $player->bets+=$coins;
                        $player->save();
                    } else {
                        \App\TournamentPlayers::create([
                            'tour_id' => $tournament->id,
                            'user_id' => $this->user->id,
                            'bets' => $coins
                        ]);
                    }
                }
				$this->redis->publish('updateBalance', json_encode([
					'unique_id' => $this->user->unique_id,
					'balance' 	=> round($this->user->balance, 2)
				]));
			}

			if($balType == 'bonus') {
				$this->user->bonus -= $coins;
				$this->user->save();

				$this->redis->publish('updateBonus', json_encode([
					'unique_id' => $this->user->unique_id,
					'bonus' 	=> round($this->user->bonus, 2)
				]));
			}
			$style = ($this->user->style > 0) ? \App\Styles::where('id', $this->user->style)->first()->css : 0;
			$this->redis->publish('new.flip', json_encode([
				'id' => $room->id,
				'hash' => $room->hash,
				'heads_from' => $room->heads_from,
				'heads_to' => $room->heads_to,
				'unique_id' => $this->user->unique_id,
				'username' => $this->user->username,
				'style' => $style,
				'avatar' => $this->user->avatar,
				'bank' => $room->bank,
				'balType' => $room->balType
			]));
				
			DB::commit();
				
			return response()->json(['type' => 'success', 'msg' => 'The game has been created!']);
        } catch(Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'msg' => 'Something went wrong...'
            ];
        }
    }
	
	public function joinGame(Request $r) {
		if(\Cache::has('action.user.' . $this->user->id)) return response()->json(['msg' => 'Wait before the previous action!', 'type' => 'error']);
        \Cache::put('action.user.' . $this->user->id, '', 2);
		if($this->user->ban) return;
		$balType = $r->get('balance');
		if($balType != 'balance' && $balType != 'bonus') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of your balance!']);
		
		DB::beginTransaction();
		try {
			$room = CoinFlip::where('id', $r->get('id'))->first();
			$coins = $room->bank;
			if($balType == 'balance' && $coins > $this->user->balance) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Not enough funds!']);
			}
			if($balType == 'bonus' && $coins > $this->user->bonus) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Not enough funds!']);
			}
			if($balType != $room->balType) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'The only people in this room '. (($balType == 'balance') ? 'bonus' : 'real') .' account!']);
			}
			if($room->status == 1) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Game #'.$room->id.' already started!']);
			}
			if(!$coins) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You forgot to specify the amount of the bet!']);
			}
			if($coins < $this->settings->flip_min_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Minimum bet '.$this->settings->flip_min_bet.' coins.!']);
			}
			if($coins > $this->settings->flip_max_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Maximum bet '.$this->settings->flip_max_bet.' coins.!']);
			}
			if($balType == 'balance' && $this->user->balance <= 0) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins to place a bet!']);
			}
			if($balType == 'bonus' && $this->user->bonus <= 0) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins to place a bet!']);
			}
			if($room->heads == $this->user->id) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You cannot participate in your own game!']);
			}

			if($balType == 'balance') {
				$this->user->bsum+=$coins;
				$this->user->balance -= $coins;
				$this->user->save();

				$this->redis->publish('updateBalance', json_encode([
					'unique_id' => $this->user->unique_id,
					'balance' 	=> round($this->user->balance, 2)
				]));
			}

			if($balType == 'bonus') {
				$this->user->bonus -= $coins;
				$this->user->save();

				$this->redis->publish('updateBonus', json_encode([
					'unique_id' => $this->user->unique_id,
					'bonus' 	=> round($this->user->bonus, 2)
				]));
			}
			
			$lastTicket = $room->heads_to;
			$room->tails_from = $lastTicket + 1;
			$room->tails_to = $lastTicket + floor($coins*100);
			$room->tails = $this->user->id;
			$room->bank += $coins;

			$win_sum = round($room->bank-($room->bank/100*$this->settings->flip_commission), 2);

			$winnerTicket = mt_rand(1, $room->tails_to);
			if(($room->heads_from <= $winnerTicket) && ($room->heads_to >= $winnerTicket)) $winner = User::where('id', $room->heads)->first();
			if(($room->tails_from <= $winnerTicket) && ($room->tails_to >= $winnerTicket)) $winner = User::where('id', $room->tails)->first();
			$room->winner_id = $winner->id;
			$room->winner_ticket = $winnerTicket;
			$room->winner_sum = $win_sum;
			$room->status = 1;
			$room->save();

			if($balType == 'balance') Profit::create([
				'game' => 'pvp',
				'sum' => $room->bank/100*$this->settings->flip_commission
			]);

			$user1 = User::where('id', $room->heads)->first();
			$user2 = User::where('id', $room->tails)->first();
			if($winner->id == $user1->id) {
				$loser = User::where('id', $user2->id)->first();
			} else {
				$loser = User::where('id', $user1->id)->first();
			}
			$user_win = User::where('id', $winner->id)->first();
			$style1 = ($user1->style > 0) ? \App\Styles::where('id', $user1->style)->first()->css : 0;
			$style2 = ($user2->style > 0) ? \App\Styles::where('id', $user2->style)->first()->css : 0;
			$returnValues = [
				'status' 	=> 'success',
				'user1'     => [
					'unique_id' => $user1->unique_id,
					'username' 	=> $user1->username,
					'style'		=> $style1,
					'avatar' 	=> $user1->avatar,
					'from' 		=> $room->heads_from,
					'to' 		=> $room->heads_to
				],
				'user2'     => [
					'unique_id' => $user2->unique_id,
					'username' 	=> $user2->username,
					'style'		=> $style2,
					'avatar' 	=> $user2->avatar,
					'from' 		=> $room->tails_from,
					'to' 		=> $room->tails_to
				],
				'winner'    => [
					'username' 	=> $user_win->username,
					'avatar' 	=> $user_win->avatar,
					'ticket' 	=> $room->winner_ticket
				],
				'loser'    => [
					'username' 	=> $loser->username,
					'avatar' 	=> $loser->avatar
				],
				'game'      => [
					'id'        => $room->id,
					'bank'      => $room->bank,
					'hash'      => $room->hash,
					'balType'      => $room->balType
				]
			];

			if($balType == 'balance') {
				$winner->balance += $win_sum;
				$winner->requery += round((($room->bank/2)/100*$this->settings->requery_bet_perc)+($win_sum - ($room->bank/2))/100*$this->settings->requery_perc, 3);
				$winner->save();

				if($winner->ref_id) {
					$ref = User::where('unique_id', $winner->ref_id)->first();
					if($ref) {
						$ref_sum = round(($win_sum - ($room->bank/2))/100*$this->settings->ref_perc, 2);
						if($ref_sum > 0) {
							$ref->ref_money += $ref_sum;
							$ref->ref_money_all += $ref_sum;
							$ref->save();

							Profit::create([
								'game' => 'ref',
								'sum' => -$ref_sum
							]);
						}
					}
				}

				$this->redis->publish('updateBalanceAfter', json_encode([
					'unique_id'	=> $winner->unique_id,
					'balance'	=> round($winner->balance, 2),
					'timer'		=> 8
				]));
			}

			if($balType == 'bonus') {
				$winner->bonus += $win_sum;
				$winner->save();

				$this->redis->publish('updateBonusAfter', json_encode([
					'unique_id'	=> $winner->unique_id,
					'bonus' 	=> round($winner->bonus, 2),
					'timer'		=> 8
				]));
			}

			$this->redis->publish('end.flip', json_encode($returnValues));
			
			DB::commit();
			return response()->json(['type' => 'success', 'msg' => 'You entered the game #'.$room->id.'!']);
        } catch(Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'msg' => 'Something went wrong...'
            ];
        }
	}
}