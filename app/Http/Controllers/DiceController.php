<?php namespace App\Http\Controllers;

use App\User;
use App\Dice;
use App\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class DiceController extends Controller {
	
    public function __construct() {
        parent::__construct();
		DB::connection()->getPdo()->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
	
	public function index() {
		$list = Dice::limit(20)->orderBy('id', 'desc')->get();
		$last = Dice::orderBy('id', 'desc')->first();
		$hash = bin2hex(random_bytes(16));
		if($this->user) $this->redis->set('dice.hash.' . $this->user->id, $hash);
		$sum = Dice::orderBy('id', 'desc')->sum('sum');
		$game = [];
		foreach($list as $l) {
			$user = User::where('id', $l->user_id)->first();
			$style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
			$game[] = [
				'unique_id' => $user->unique_id,
				'avatar' => $user->avatar,
				'username' => "<span style='$style'>$user->username</span>",
				'sum' => $l->sum,
				'num' => round($l->num),
				'range' => $l->range,
				'perc' => $l->perc,
				'win' => $l->win,
				'win_sum' => $l->win_sum,
				'balType' => $l->balType,
				'hash' => $l->hash
			];
		}
        return view('pages.dice', compact('game', 'hash'));
	}
	
	public function play(Request $r) {
		if($this->user->ban) return;
		$type = $r->type;
		$perc = preg_replace('/[^0-9.]/', '', $r->perc);
        $sum = preg_replace('/[^0-9.]/', '', round($r->sum, 2));
        $balType = $r->balance;
		
		if(is_null($type) || $type != 'min' && $type != 'max') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of bet']);
		if($balType != 'balance' && $balType != 'bonus') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of your balance!']);
		if($sum < $this->settings->dice_min_bet) return response()->json(['type' => 'error', 'msg' => 'Minimum bet amount '.$this->settings->dice_min_bet.' coins!']);
		if($sum > $this->settings->dice_max_bet) return response()->json(['type' => 'error', 'msg' => 'Maximum bet amount '.$this->settings->dice_max_bet.' coins!']);
		if($sum > $this->user[$balType]) return response()->json(['type' => 'error', 'msg' => 'You do not have enough coins to place a bet!']);
		if(!$perc) return response()->json(['type' => 'error', 'msg' => 'You did not enter a chance to win!']);
		if(!$sum) return response()->json(['type' => 'error', 'msg' => 'You have not entered the amount of the bet!']);
		if($perc < 1) return response()->json(['type' => 'error', 'msg' => 'You took the wrong chance!']);
		if($perc > 95) return response()->json(['type' => 'error', 'msg' => 'You took the wrong chance!']);
		
		DB::beginTransaction();

		try {
			$win = 0;
			$win_sum = 0;
			$profit = 0;
			$chance = round($perc, 2);
			$vip = 100/$chance;
			$rand = rand(0, 999999);

			if($sum == round($sum*$vip, 2)) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Your bet equals your winnings!']);
			}
			
			if($chance > 80) $prod = 10;
			elseif($chance > 60 && $chance <= 80) $prod = 20;
			elseif($chance > 40 && $chance <= 60) $prod = 35;
			elseif($chance > 20 && $chance <= 40) $prod = 50;
			elseif($chance > 10 && $chance <= 20) $prod = 70;
			elseif($chance > 5 && $chance <= 10) $prod = 80;
			elseif($chance <= 5) $prod = 99;
			
			if($type == 'min') {
				$generate = floor($chance/100*999999);
				if(mt_rand(1, 100) <= $prod) {
					while(in_array($rand, range(0, $generate))) {
						$rand = rand(0, 999999);
					}
				}
				if($this->user->is_youtuber && mt_rand(1, 100) > 60) $rand = rand(0, $generate);
				if(in_array($rand, range(0, $generate))) $win = 1;
			}
			if($type == 'max') {
				$generate = round(999999-$chance/100*999999);
				if(mt_rand(1, 100) <= $prod) {
					while(in_array($rand, range($generate, 999999))) {
						$rand = rand(0, 999999);
					}
				}
				if($this->user->is_youtuber && mt_rand(1, 100) > 60) $rand = rand($generate, 999999);
				if(in_array($rand, range($generate, 999999))) $win = 1;
			}

			if($win == 1) {
				$win_sum += round($sum*$vip, 2)-$sum;
				$profit -= round($sum*$vip, 2)-$sum;
				
				if($balType == 'balance') {
					$this->user->requery += round(($sum/100*$this->settings->requery_bet_perc)+($win_sum/100*$this->settings->requery_perc), 3);
					$this->user->save();
					
					if($this->user->ref_id) {
						$ref = User::where('unique_id', $this->user->ref_id)->first();
						if($ref) {
							$ref_sum = round($win_sum/100*$this->settings->ref_perc, 2);
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
				}
			} else {
				$win_sum -= round($sum, 2);
				$profit += round($sum, 2);
			}
			$this->user->bsum+=$sum;
			$this->user[$balType] += $win_sum;
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
			$hash = $this->redis->get('dice.hash.' . $this->user->id);

			Dice::create([
				'user_id' => $this->user->id,
				'sum' => $sum,
				'perc' => $chance,
				'num' => $rand,
				'range' => ($type == 'min' ? '0-'.$generate : $generate.'-999999'),
				'win' => $win,
				'win_sum' => $win_sum,
				'balType' => $balType,
				'hash' => $hash
			]);
			
			if($balType == 'balance') {
				Profit::create([
					'game' => 'dice',
					'sum' => $profit
				]);
			}
			
			DB::commit();
		} catch(Exception $e) {
			DB::rollback();
			return response()->json(['type' => 'error', 'msg' => 'Unknown error!']);
		}
		$style = ($this->user->style > 0) ? \App\Styles::where('id', $this->user->style)->first()->css : 0;
		$this->redis->publish('dice', json_encode([
            'unique_id' => $this->user->unique_id,
            'avatar' => $this->user->avatar,
            'username' => $this->user->username,
			'style' => $style,
			'sum' => $sum,
			'num' => $rand,
			'range' => ($type == 'min' ? '0-'.$generate : $generate.'-999999'),
			'vip' => $vip,
			'perc' => $chance,
			'win' => $win,
			'win_sum' => ($win_sum < 0) ? 0 : round($win_sum, 2),
			'balType' => $balType,
			'hash' => $hash
        ]));
		
		if($balType == 'balance') {
			$this->redis->publish('updateBalance', json_encode([
				'unique_id' => $this->user->unique_id,
				'balance'	=> round($this->user->balance, 2)
			]));
		}

		if($balType == 'bonus') {
			$this->redis->publish('updateBonus', json_encode([
				'unique_id' => $this->user->unique_id,
				'bonus'		=> round($this->user->bonus, 2)
			]));
		}
		
		$this->redis->del('dice.hash.' . $this->user->id);
		
		$newHash = bin2hex(random_bytes(16));
		$this->redis->set('dice.hash.' . $this->user->id, $newHash);
		
		return [
			'status' => 'success',
			'chislo' => $rand,
			'chance' => $chance,
			'win' => $win,
			'hash' => $newHash
		];
	}
	
	public function addBetFake() {
		$user = $this->getUser();
		
		if(!$user) return [
            'success' => false,
            'fake' => $this->settings->fakebets,
            'msg' => '[Dice] Failed to retrieve user!'
        ];
		
		$perc = round((1 + (95-1)) * mt_rand(0, 2147483647) / 2147483647, 2);
		
		$sum = $this->settings->dice_min_bet+mt_rand($this->settings->fake_min_bet * 2, $this->settings->fake_max_bet * 2) / 2;
		$bl = ['balance'];
		$bl_true = $bl[array_rand($bl)];
		
        $balType = $bl_true;
		
		if($balType != 'balance' && $balType != 'bonus') return [
            'success' => false,
            'fake' => $this->settings->fakebets,
            'msg' => '[Dice] Unable to determine the type of your balance!'
        ];
		
		DB::beginTransaction();

		try {
			if($sum < $this->settings->dice_min_bet) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] Minimum bet amount '.$this->settings->dice_min_bet.' coins!'
				];
			}
			if($sum > $this->settings->dice_max_bet) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] Maximum bet amount '.$this->settings->dice_max_bet.' coins!'
				];
			}
			if(!$perc) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] You did not enter a chance to win!'
				];
			}
			if(!$sum) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] You have not entered the amount of the bet!'
				];
			}
			if($perc < 1) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] You took the wrong chance!'
				];
			}
			if($perc > 95) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] You took the wrong chance!'
				];
			}
			$chance = round($perc, 2);
			$vip = round(96/$chance, 2);
			$rand = rand(0, 10000);
			$generate = $rand / 100;

			if($sum == round($sum*$vip, 2)) {
				DB::rollback();
				return [
					'success' => false,
					'fake' => $this->settings->fakebets,
					'msg' => '[Dice] Your bet equals your winnings!'
				];
			}
		
			$win = 0;
			$win_sum = 0;

			if($perc >= $generate) {
				$win = 1;
				$win_sum += round($sum*$vip, 2)-$sum;
			} else {
				$win = 0;
				$win_sum -= round($sum, 2);
			}

			$hash = bin2hex(random_bytes(16));

			Dice::create([
				'user_id' => $user->id,
				'sum' => $sum,
				'perc' => $chance,
				'vip' => $vip,
				'num' => $generate,
				'win' => $win,
				'win_sum' => $win_sum,
				'balType' => $balType,
				'hash' => $hash,
				'fake' => 1
			]);
			
			DB::commit();
		} catch(Exception $e) {
			DB::rollback();
			return [
				'success' => false,
				'fake' => $this->settings->fakebets,
				'msg' => '[Dice] Unknown error!'
			];
		}
		
		$this->redis->publish('dice', json_encode([
            'unique_id' => $user->unique_id,
            'avatar' => $user->avatar,
            'username' => $user->username,
			'sum' => $sum,
			'num' => $generate,
			'vip' => $vip,
			'perc' => $chance,
			'win' => $win,
			'win_sum' => ($win_sum < 0) ? 0 : round($win_sum, 2),
			'balType' => $balType,
			'hash' => $hash
        ]));
		
		return [
            'success' => true,
			'fake' => $this->settings->fakebets,
            'msg' => '[Dice] The bet is on!'
        ];
	}
	
	public function adminBet(Request $r) {
		$user = User::where('user_id', $r->get('user'))->first();
		
		$perc = preg_replace('/[^0-9.]/', '', $r->perc);
        $sum = preg_replace('/[^0-9.]/', '', round($r->sum, 2));
        $balType = $r->balance;
		
		if($balType != 'balance' && $balType != 'bonus') return response()->json(['type' => 'error', 'msg' => 'Unable to determine the type of your balance!']);
		
		DB::beginTransaction();

		try {
			if($sum < $this->settings->dice_min_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Minimum bet amount '.$this->settings->dice_min_bet.' coins!']); 
			}
			if($sum > $this->settings->dice_max_bet) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Maximum bet amount '.$this->settings->dice_max_bet.' coins!']);
			}
			if(!$perc) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You did not enter a chance to win!']);
			}
			if(!$sum) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You have not entered the amount of the bet!']);
			}
			if($perc < 1) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You took the wrong chance!']);
			}
			if($perc > 95) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'You took the wrong chance!']);
			}
			$chance = round($perc, 2);
			$vip = round(96/$chance, 2);
			$rand = rand(0, 10000);
			$generate = $rand / 100;

			if($sum == round($sum*$vip, 2)) {
				DB::rollback();
				return response()->json(['type' => 'error', 'msg' => 'Your bet equals your winnings!']);
			}
		
			$win = 0;
			$win_sum = 0;

			if($perc >= $generate) {
				$win = 1;
				$win_sum += round($sum*$vip, 2)-$sum;
			} else {
				$win = 0;
				$win_sum -= round($sum, 2);
			}

			$hash = bin2hex(random_bytes(16));

			Dice::create([
				'user_id' => $user->id,
				'sum' => $sum,
				'perc' => $chance,
				'vip' => $vip,
				'num' => $generate,
				'win' => $win,
				'win_sum' => $win_sum,
				'balType' => $balType,
				'hash' => $hash,
				'fake' => 1
			]);
			
			DB::commit();
		} catch(Exception $e) {
			DB::rollback();
			return response()->json(['type' => 'error', 'msg' => 'Unknown error!']);
		}
		
		$this->redis->publish('dice', json_encode([
            'unique_id' => $user->unique_id,
            'avatar' => $user->avatar,
            'username' => $user->username,
			'sum' => $sum,
			'num' => $generate,
			'vip' => $vip,
			'perc' => $chance,
			'win' => $win,
			'win_sum' => ($win_sum < 0) ? 0 : round($win_sum, 2),
			'balType' => $balType,
			'hash' => $hash
        ]));
		
		return [
            'success' => true,
			'type' => 'success',
            'msg' => '[Dice] The bet is on!'
        ];
	}
	
	private function getUser() {
        $user = User::where('fake', 1)->inRandomOrder()->first();
		if($user->time != 0) {
			$now = Carbon::now()->format('H');
			if($now < 06) $time = 4;
			if($now >= 06 && $now < 12) $time = 1;
			if($now >= 12 && $now < 18) $time = 2;
			if($now >= 18) $time = 3;
        	$user = User::where(['fake' => 1, 'time' => $time])->inRandomOrder()->first();
		}
        return $user;
    }
}