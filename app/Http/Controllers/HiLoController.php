<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Hilo;
use App\HiloBets;
use App\Profit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HiLoController extends Controller
{
	public function __construct() {
		parent::__construct();
		$this->game = Hilo::orderBy('id', 'desc')->first();
		$this->previos = $this->lastCard();
		if(is_null($this->game)) {
			$card = $this->getRandom();
			$this->game = Hilo::create([
				'card_name' => $card['name'],
				'card_amount' => $card['amount'],
				'card_section' => $card['section'],
				'hash' => bin2hex(random_bytes(16)),
				'status' => 3
			]);
		}
		view()->share('hilo', $this->getHiLo($this->getPreviosCard()));
		view()->share('game', $this->game);
		view()->share('history', $this->getHistory());
		view()->share('bets', $this->getBets());
		view()->share('stat', $this->getStats());
		view()->share('betCount', $this->getBetCount());
		view()->share('lastCard', $this->previos);
    }
	
	public function index() {
        return view('pages.hilo');
	}
	
	public function newGame() {
		$this->game = Hilo::create([
			'hash' => bin2hex(random_bytes(16))
		]);

		$returnValue = [
			'game' => $this->game,
            'time' => $this->settings->hilo_timer
		];
		
        return response()->json($returnValue);
	}
	
	public function newBet(Request $r) {
		if(\Cache::has('action.user.' . $this->user->id)) return response()->json(['msg' => 'Wait before the previous action!', 'type' => 'error']);
        \Cache::put('action.user.' . $this->user->id, '', 2);
		if($this->user->ban) return;
		$type = $r->get('type');
		$sum = floatval($r->get('sum'));
		$balance = $r->get('balance');
		$factor = $this->getType($type);
		if($balance != 'balance' && $balance != 'bonus') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of your balance!']);
		if($this->game->status > 1) return response()->json(['msg' => 'Betting on this game is closed!', 'type' => 'error']);
		if($factor == 'error') return response()->json(['msg' => 'Unable to determine the type of bet', 'type' => 'error']);
		if(is_null($sum)) return response()->json(['msg' => 'You have entered an incorrect amount', 'type' => 'error']);
		if($sum < $this->settings->hilo_min_bet) return response()->json(['msg' => 'Minimum bet amount '.$this->settings->hilo_min_bet.'!', 'type' => 'error']);
		if($sum > $this->settings->hilo_max_bet) return response()->json(['msg' => 'Maximum bet amount '.$this->settings->hilo_max_bet.'!', 'type' => 'error']);
		if($balance == 'balance' && $this->user->balance < $sum) return response()->json(['type' => 'error', 'msg' => 'Not enough balance!']);
		if($balance == 'bonus' && $this->user->bonus < $sum) return response()->json(['type' => 'error', 'msg' => 'Not enough balance!']);
		if($factor[2] == 0) return response()->json(['msg' => 'You cannot bet on this multiplier!', 'type' => 'error']);
		
		$countbets = HiLoBets::where('game_id', $this->game->id)->where('user_id', $this->user->id)->count();
		if($countbets >= $this->settings->hilo_bets) return response()->json(['msg' => 'You have made the maximum number of bets!', 'type' => 'error']);
		
		$bets = HiLoBets::where([
            'user_id' => $this->user->id,
            'game_id' => $this->game->id
        ])->select('bet_type', 'balance')->groupBy('bet_type', 'balance')->get();
		
		foreach($bets as $b) {
			if($balance != $b->balance) return response()->json(['type' => 'error', 'msg' => 'You already placed a bet with '. (($balance == 'balance') ? 'bonus' : 'real') .' accounts!']);
			if($type != $b->color) return response()->json(['type' => 'error', 'msg' => 'You cannot bet on this multiplier!']);
		}
		
		DB::beginTransaction();
		try {
			$bet = new HiloBets();
			$bet->game_id = $this->game->id;
			$bet->user_id = $this->user->id;
			$bet->bet_type = $factor[0];
			$bet->bet_x = $factor[2];
			$bet->sum = $sum;
			$bet->balance = $balance;
			$bet->save();

			if($balance == 'balance') {
				$this->user->bsum+=$sum;
				$this->user->balance -= $sum;
				$this->user->save();
                $tournament = \App\Tournament::where('status', 1)->where('end', '>', time())->orderBy('id', 'desc')->first();
                if($tournament) {
                    $player = \App\TournamentPlayers::where('user_id', $this->user->id)->where('tour_id', $tournament->id)->first();
                    if($player) {
                        $player->bets+=$sum;
                        $player->save();
                    } else {
                        \App\TournamentPlayers::create([
                            'tour_id' => $tournament->id,
                            'user_id' => $this->user->id,
                            'bets' => $sum
                        ]);
                    }
                }
				$this->redis->publish('updateBalance', json_encode([
					'unique_id' => $this->user->unique_id,
					'balance' 	=> round($this->user->balance, 2)
				]));
			}

			if($balance == 'bonus') {
				$this->user->bonus -= $sum;
				$this->user->save();
				
				$this->redis->publish('updateBonus', json_encode([
					'unique_id' => $this->user->unique_id,
					'bonus' 	=> round($this->user->bonus, 2)
				]));
			}
			
			DB::commit();
		} catch(Exception $e) {
			DB::rollback();
			return response()->json(['type' => 'error', 'msg' => 'Unknown error!']);
		}
        
		$this->redis->publish('updateBalance', json_encode([
            'id'    => $this->user->id,
            'balance' => $this->user->balance
        ]));
		
		$this->redis->publish('hilo.newBet', json_encode([
			'bets' 		=> $this->getBets(),
			'betsCount' => $this->getBetCount()
		]));
		
		return response()->json(['msg' => 'Your bet is accepted!', 'type' => 'success']);
	}

    public function getFLip() {
        $win = $this->getRandom();
		$lastCard = $this->previos;
		$sign = null;
		if(!is_null($lastCard) && $win['section'] != 'joker') $sign = ($win['amount'] < $lastCard->card_amount) ? 'lo' : (($win['amount'] > $lastCard->card_amount) ? 'hi' : 'eq');
		
		$this->game->card_name 		= $win['name'];
		$this->game->card_amount 	= $win['amount'];
		$this->game->card_section 	= $win['section'];
		$this->game->card_sign 		= $sign;
		$this->game->profit 		= $this->sendMoney($this->game->id, $win['amount'], $win['section'], $sign);
        $this->game->save();
		
		$historyNew = null;
		if($this->game->id > 2) {
			Hilo::where('id', $this->game->id-1)->update([
				'status' => 4
			]);
			$historyNew = Hilo::where('status', 4)->orderBy('id', 'desc')->first();
		}

        $returnValue = [
			'stats' => $this->getStats(),
			'hilo' => $win,
			'history' => $historyNew
        ];

        return response()->json($returnValue);
    }
	
	private function sendMoney($game_id, $amount, $section, $sign) {
		$small = 0; $big = 0; $ka = 0; $a = 0; $red = 0; $black = 0; $hi = 0; $lo = 0; $joker = 0;
		if($amount >= 2 && $amount <= 9) $small = 1;
		if($amount >= 10 && $amount <= 13) $big = 1;
		if($amount >= 12 && $amount <= 13) $ka = 1;
		if($amount == 13) $a = 1;
		if($section == 'red') $red = 1;
		if($section == 'black') $black = 1;
		if($section == 'joker') $joker = 1;
		if($sign == 'hi') $hi = 1;
		if($sign == 'lo') $lo = 1;
		$bets = HiLoBets::where('game_id', $game_id)->get();
		$total = $bets->sum('sum');
		foreach($bets as $b) {
			$user = User::where(['id' => $b->user_id, 'fake' => 0])->first();
			if(!is_null($user)) {
				if($hi) {
					if($b->bet_type == 1) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($lo) {
					if($b->bet_type == 2) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($red) {
					if($b->bet_type == 3) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($black) {
					if($b->bet_type == 4) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($small) {
					if($b->bet_type == 5) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($big) {
					if($b->bet_type == 6) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($ka) {
					if($b->bet_type == 7) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($a) {
					if($b->bet_type == 8) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				if($joker) {
					if($b->bet_type == 9) {
						if($b->balance == 'balance') {
							$user->balance += round($b->sum*$b->bet_x, 2);
							$user->save();
							
							if($user->ref_id) {
								$ref = User::where('unique_id', $user->ref_id)->first();
								if($ref) {
									$ref_sum = round((($b->sum*$b->bet_x) - $b->sum)/100*$this->settings->ref_perc, 2);
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

							$total -= round($b->sum*$b->bet_x, 2);
						
							$b->win = 1;
							$b->win_sum = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
						if($b->balance == 'bonus') {
							$user->bonus += round($b->sum*$b->bet_x, 2);
							$user->save();

							$total -= round(($b->sum*$b->bet_x)/$this->settings->exchange_curs, 2);
						
							$b->win = 1;
							$b->win_bonus = round($b->sum*$b->bet_x, 2);
							$b->save();
						}
					}
				}
				

				if($b->balance == 'balance') {
					$this->redis->publish('updateBalance', json_encode([
						'unique_id' => $user->unique_id,
						'balance' 	=> round($user->balance, 2)
					]));
				}

				if($b->balance == 'bonus') {
					$this->redis->publish('updateBonus', json_encode([
						'unique_id' => $user->unique_id,
						'bonus' 	=> round($user->bonus, 2)
					]));
				}
			}
		}
		
		Profit::create([
			'game' => 'hilo',
			'sum' => $total
		]);
		
		return $total;
    }
	
	private function getBets() {
		$bets = HiloBets::where('game_id', $this->game->id)->orderBy('id', 'desc')->get();
		$list = [];
		foreach($bets as $bet) {
			$user = User::where('id', $bet->user_id)->first();
			$style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
			$factor = $this->getType($bet->bet_type);
			$list[] = [
				'unique_id' => $user->unique_id,
				'username' => "<span style='$style'>$user->username</span>",
				'avatar' => $user->avatar,
				'sum' => $bet->sum,
				'balance' => $bet->balance,
				'type' => $factor[1],
				'multipler' => round($bet->bet_x, 2),
				'win' => round($bet->sum*$bet->bet_x, 2)
			];
		}
        return $list;
    }
	
	private function getStats() {
		$chart = HiLo::orderBy('id', 'desc')->where('status', 4)->limit(20)->get();
		$returnValue = [
			'red_perc' => round($chart->where('card_section', 'red')->count()/($chart->where('card_section', '!=', 'joker')->count() ? $chart->where('card_section', '!=', 'joker')->count() : 1)*100),
			'black_perc' => round($chart->where('card_section', 'black')->count()/($chart->where('card_section', '!=', 'joker')->count() ? $chart->where('card_section', '!=', 'joker')->count() : 1)*100),
			'cards' => [
				'two' => [
					'count' => $chart->where('card_name', '2')->count(),
					'perc' => $chart->where('card_name', '2')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'three' => [
					'count' => $chart->where('card_name', '3')->count(),
					'perc' => $chart->where('card_name', '3')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'four' => [
					'count' => $chart->where('card_name', '4')->count(),
					'perc' => $chart->where('card_name', '4')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'five' => [
					'count' => $chart->where('card_name', '5')->count(),
					'perc' => $chart->where('card_name', '5')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'six' => [
					'count' => $chart->where('card_name', '6')->count(),
					'perc' => $chart->where('card_name', '6')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'seven' => [
					'count' => $chart->where('card_name', '7')->count(),
					'perc' => $chart->where('card_name', '7')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'eight' => [
					'count' => $chart->where('card_name', '8')->count(),
					'perc' => $chart->where('card_name', '8')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'nine' => [
					'count' => $chart->where('card_name', '9')->count(),
					'perc' => $chart->where('card_name', '9')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'J' => [
					'count' => $chart->where('card_name', 'J')->count(),
					'perc' => $chart->where('card_name', 'J')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'Q' => [
					'count' => $chart->where('card_name', 'Q')->count(),
					'perc' => $chart->where('card_name', 'Q')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'K' => [
					'count' => $chart->where('card_name', 'K')->count(),
					'perc' => $chart->where('card_name', 'K')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'A' => [
					'count' => $chart->where('card_name', 'A')->count(),
					'perc' => $chart->where('card_name', 'A')->count()/($chart->count() ? $chart->count() : 1)*100
				],
				'JOKER' => [
					'count' => $chart->where('card_section', 'joker')->count(),
					'perc' => $chart->where('card_section', 'joker')->count()/($chart->count() ? $chart->count() : 1)*100
				]
			]
        ];
		
		return $returnValue;
    }
	
	private function getBetCount() {
		$bets = HiLoBets::select('user_id', 'bet_type')->where('game_id', $this->game->id)->groupBy('user_id', 'bet_type')->get();
		$returnValue = [
			'hi' => $bets->where('bet_type', 1)->count(),
			'lo' => $bets->where('bet_type', 2)->count(),
			'red' => $bets->where('bet_type', 3)->count(),
			'black' => $bets->where('bet_type', 4)->count(),
			'small' => $bets->where('bet_type', 5)->count(),
			'big' => $bets->where('bet_type', 6)->count(),
			'ka' => $bets->where('bet_type', 7)->count(),
			'a' => $bets->where('bet_type', 8)->count(),
			'joker' => $bets->where('bet_type', 9)->count()
        ];
		
		return $returnValue;
    }
	
	private function getHistory() {
        $history = Hilo::where('status', 4)->orderBy('id', 'desc')->limit(20)->get();
        return $history;
    }
	
	public function lastCard() {
        $game = Hilo::where('status', 3)->orderBy('id', 'desc')->first();
		if(is_null($game)) return null;
        return $game;
    }
	
	private function getType($type) {
		$factor = $this->getHiLo($this->getPreviosCard());
		$list = [
			'1' => [1, 'HI',		$factor['hi']],
			'2' => [2, 'LO',		$factor['lo']],
            '3' => [3, 'Red',	2],
            '4' => [4, 'Black',	2],
            '5' => [5, '2-9',		1.5],
            '6' => [6, 'J Q K A',	3],
            '7' => [7, 'K A',		6],
            '8' => [8, 'A',			12],
            '9' => [9, 'JOKER',		24]
        ];
		if(!isset($list[$type])) return null;
		return $list[$type];
	}

    public function getStatus() {
        return [
            'id' => $this->game->id,
            'status' => $this->game->status,
            'time' => $this->settings->hilo_timer
        ];
    }
	
	public function setStatus(Request $r) {
        $this->game->status = $r->get('status');
        $this->game->save();
        return $this->game->status;
    }
	
	public function getCard() {
		$cards[] = [
			'name' => '🃏',
			'amount' => null,
			'section' => 'joker'
		];
		$sections = ['red', 'black'];
		for($x = 0; $x < 2; $x++) {
			for($i = 2; $i < 14; $i++) {
				$short = 'JOKER';
				if($i > 1 && $i < 10) $short = $i;
				if($i > 9) {
					$bt10 = ['J', 'Q', 'K', 'A'];
					$short = $bt10[($i-10)];
				}
				$cards[] = [
					'name' => $short,
					'amount' => $i,
					'section' => $sections[$x]
				];
			}
		}
		return $cards;
    }
	
	public function getRandom() {
		$cards = $this->getCard();
		shuffle($cards);
		$randIndex = array_rand($cards);
		if(is_null($this->previos)) $randIndex = array_rand($cards);
		$hilo = $this->getHiLo($cards[$randIndex]);
		return $hilo;
    }
	
	public function getHiLo($card) {
		$cards = $this->getCard();
		$amount = $card['amount'];
		if(!is_null($this->game) && $card['section'] == 'joker') $amount = $this->getPreviosAmuont();

		$low = 0;
		$big = 0;
		$lowers = [];
		$biggers = [];

		for($i = 0; $i < count($cards); $i++)  {
			if(!is_null($cards[$i]['amount']) && $cards[$i]['amount'] < $amount) $lowers[] = $cards[$i]['name'];
			if(!is_null($cards[$i]['amount']) && $cards[$i]['amount'] > $amount) $biggers[] = $cards[$i]['name'];
		}
		
		$low += floor((count($lowers)/count($cards))*100);
		$big += floor((count($biggers)/count($cards))*100);
		$res = [
			'name' => $card['name'],
			'amount' => $card['amount'],
			'section' => $card['section'],
			'lo' => $low ? round(96/$low, 2) : $low,
			'hi' => $big ? round(96/$big, 2) : $big,
			'lo_perc' => $low,
			'hi_perc' => $big
		];
		return $res;
    }
	
	public function getPreviosCard() {
		$prev = [];
		if(!is_null($this->previos)) {
			$prev = [
				'name' => $this->previos->card_name,
				'amount' => $this->previos->card_amount,
				'section' => $this->previos->card_section
			];
		}
		return $prev;
    }
	
	public function getPreviosAmuont() {
		$game = HiLo::where('card_amount', '!=', 'joker')->orderBy('id', 'desc')->first();
		if(is_null($game)) $game = null;
		else $game = $game->card_amount;
		return $game;
    }
}