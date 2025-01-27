<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Settings;
use App\Profit;
use App\Roulette;
use App\RouletteBets;
use DB;
use Carbon\Carbon;

class DoubleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->game = Roulette::orderBy('id', 'desc')->first();
		if(is_null($this->game)) $this->game = Roulette::create([
			'hash' => bin2hex(random_bytes(16))
		]);
        view()->share('game', $this->game);
    }
    
    public function index()
    {
		/*if(!Auth::user() || !$this->user->is_admin) return redirect()->route('dice')->with('success', 'Тех. работы!'); */
        $rotate = $this->settings->roulette_rotate2;
        $time = $this->settings->roulette_rotate_start-time()+$this->settings->roulette_timer; // заменить 7 на время таймера в секунда INTEGER
        if($this->game->status == 2 && $time > 0)
        {
            $rotate += ($this->settings->roulette_rotate-$this->settings->roulette_rotate2)*(1-($time/7));
        }
        $rotate2 = $this->settings->roulette_rotate;
        $bets = $this->getBets();
        $prices = $this->getPrices();
        $history = $this->getHistory();
        return view('pages.double', compact('bets', 'rotate', 'rotate2', 'time', 'prices','history'));
    }

    public function history() 
    {
        $games = Roulette::select('id', 'price', 'updated_at', 'winner_color', 'winner_num', 'hash')->where('status', 3)->orderBy('id', 'desc')->limit(30)->get();
        return view('pages.doubleHistory', compact('games'));
    }

    private function getPrices()
    {
        $query = RouletteBets::where('round_id', $this->game->id)
                    ->select(DB::raw('SUM(price) as value'), 'type')
                    ->groupBy('type')
                    ->get();

        $list = [];
        foreach($query as $l) $list[$l->type] = $l->value;
        return $list;
    }

    private function getRealPrices()
    {
		$query = RouletteBets::where(['round_id' => $this->game->id, 'is_fake' => 0])
                    ->select(DB::raw('SUM(price) as value'), 'type')
                    ->groupBy('type')
                    ->get();

        $list = [];
        foreach($query as $l) $list[$l->type] = $l->value;
        return $list;
    }

    public function getHistory()
    {
        $query = Roulette::where('status', 3)->select('winner_num', 'winner_color', 'id', 'hash')->orderBy('id','desc')->limit(60)->get();
        return $query;
    }

    public function addBet(Request $r)
    {
        /*if($this->user->id != 1) return [
            'success' => false,
            'msg' => 'На сайте ведутся технические работы!'
        ];*/
		if (\Cache::has('bet.user.' . $this->user->id)) {
			$this->redis->publish('message', json_encode([
                'user'  => $this->user->id,
                'msg'   => 'You have been betting too often!',
                'icon'  => 'error'
            ]));
            return;
		}
        \Cache::put('bet.user.' . $this->user->id, '', 0.10);
        $value = floatval($r->get('bet'));
        // Проверка типа данных value
        if(gettype($value) != 'double') return [
            'success' => false,
            'msg' => 'Failed to determine the data type!'
        ];

        if($value < $this->settings->double_min_bet) return [
            'success' => false,
            'msg' => 'Minimum bet amount - '.$this->settings->double_min_bet
        ];

        if($this->settings->double_max_bet > 0 && $value > $this->settings->double_max_bet) return [
            'success' => false,
            'msg' => 'Maximum bet amount - '.$this->settings->double_max_bet
        ];

        if($this->game->status > 1) return [
            'success' => false,
            'msg' => 'Betting on this game is closed!'
        ];

        // проверка баланса
        if($this->user->balance < $value) return [
            'success' => false,
            'msg' => 'Not enough balance!'
        ];

        // получение ставок пользователя
        $bets = RouletteBets::where([
            'user_id' => $this->user->id,
            'round_id' => $this->game->id
        ])->select('type as color')->groupBy('color')->get();

        $ban = 'none';
        foreach($bets as $b) if($b->color != 'green') $ban = $b->color;
        if($ban != 'none') $ban = ($ban == 'red') ? 'black' : 'red';

        if($r->get('type') == $ban) return [
            'success' => false,
            'msg' => 'You cannot bet on that colour!',
            'bets' => $bets
        ];

        // Минусуем баланс
        $this->user->balance -= $value;
        $this->user->save();

        $this->game->price += $value;
        $this->game->save();

        $bet = RouletteBets::create([
            'user_id' => $this->user->id,
            'round_id' => $this->game->id,
            'price' => $value,
            'type' => $r->get('type')
        ]);

        $this->redis->publish('updateBalance', json_encode([
            'unique_id' => $this->user->unique_id,
            'balance' => $this->user->balance
        ]));
        
        $this->emit([
            'type' => 'admin',
            'prices' => $this->getRealPrices()
        ]);
        
        $this->emit([
            'type' => 'bets',
            'bets' => $this->getBets(),
            'prices' => $this->getPrices()
        ]);

        $this->startTimer();
		$this->newBank($this->game->price);
        return [
            'success' => true,
            'msg' => 'Your bet is in!'
        ];
    }
	
	public function addBetFake()
    {
		if($this->game->status > 1) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] Betting on this game is closed!'
        ];
		
        $user = $this->getUser();
		
		if(!$user) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] Failed to retrieve user!'
        ];
		$countBet = RouletteBets::where([
            'user_id' => $user->id,
            'round_id' => $this->game->id
        ])->count();
		
		if($countBet >= 2) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] This user is already engaged!'
        ];
		
		$col = ['red', 'black', 'green'];
		$col_rand = array_rand($col, 1);
		$o = [5, 10, 15];
		$ar_o = array_rand($o, 2);
		$sum = $this->roundToTheNearestAnything(mt_rand($this->settings->dice_fake_min, $this->settings->dice_fake_max), $o[$ar_o[0]]);
		if($col[$col_rand] == 'green') {
			$value = $this->roundToTheNearestAnything(floor(mt_rand($this->settings->double_fake_min, $this->settings->double_fake_max)/mt_rand(2, 4)), $o[$ar_o[0]]);
		} else {
			$value = $this->roundToTheNearestAnything(mt_rand($this->settings->double_fake_min, $this->settings->double_fake_max), $o[$ar_o[0]]);
		}
        // получение ставок пользователя
        $bets = RouletteBets::where([
            'user_id' => $user->id,
            'round_id' => $this->game->id
        ])->select('type as color')->groupBy('color')->get();

        $ban = 'none';
        foreach($bets as $b) if($b->color != 'green') $ban = $b->color;
        if($ban != 'none') $ban = ($ban == 'red') ? 'black' : 'red';

        if($col[$col_rand] == $ban) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] You cannot bet on this colour!',
            'bets' => $bets
        ];

		if($value < $this->settings->double_min_bet) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] Minimum bet amount - '.$this->settings->double_min_bet
        ];

        if($this->settings->double_max_bet > 0 && $value > $this->settings->double_max_bet) return [
            'success' => false,
            'fake' => $this->settings->fake,
            'msg' => '[Double] Maximum bet amount - '.$this->settings->double_max_bet
        ];
		
        $this->game->price += $value;
        $this->game->save();

        $bet = RouletteBets::create([
            'user_id' => $user->id,
            'round_id' => $this->game->id,
            'price' => $value,
            'type' => $col[$col_rand],
            'is_fake' => 1
        ]);
        
        $this->emit([
            'type' => 'bets',
            'bets' => $this->getBets(),
            'prices' => $this->getPrices()
        ]);

        $this->startTimer();
		$this->newBank($this->game->price);
        return [
            'success' => true,
            'fake' => $this->settings->fake,
            'msg' => '[Double] Fake bet has been made!'
        ];
    }
	
	public function roundToTheNearestAnything($value, $roundTo) {
		$mod = $value%$roundTo;
		return $value+($mod<($roundTo/2)?-$mod:$roundTo-$mod);
	}
	
	public function adminBet(Request $r) {
		if($this->game->status > 1) return [
            'success' => false,
			'type' => 'error',
            'msg' => 'Betting on this game is closed!'
        ];
		
        $user = User::where('user_id', $r->get('user'))->first();
        $value = preg_replace('/[^0-9.]/', '', floor($r->get('sum')));
        $color = $r->get('color');
		
		$countBet = RouletteBets::where([
            'user_id' => $user->id,
            'round_id' => $this->game->id
        ])->count();
		
		if($countBet >= 2) return [
            'success' => false,
			'type' => 'error',
            'msg' => 'This user is already engaged!'
        ];

        // получение ставок пользователя
        $bets = RouletteBets::where([
            'user_id' => $user->id,
            'round_id' => $this->game->id
        ])->select('type as color')->groupBy('color')->get();

        $ban = 'none';
        foreach($bets as $b) if($b->color != 'green') $ban = $b->color;
        if($ban != 'none') $ban = ($ban == 'red') ? 'black' : 'red';

        if($color == $ban) return [
            'success' => false,
			'type' => 'error',
            'msg' => 'You cannot bet on this colour!',
            'bets' => $bets
        ];

		if($value < $this->settings->double_min_bet) return [
            'success' => false,
			'type' => 'error',
            'msg' => 'Minimum bet amount - '.$this->settings->double_min_bet
        ];

        if($this->settings->double_max_bet > 0 && $value > $this->settings->double_max_bet) return [
            'success' => false,
			'type' => 'error',
            'msg' => 'Maximum bet amount - '.$this->settings->double_max_bet
        ];
		
        $this->game->price += $value;
        $this->game->save();

        $bet = RouletteBets::create([
            'user_id' => $user->id,
            'round_id' => $this->game->id,
            'price' => $value,
            'type' => $color,
            'is_fake' => 1
        ]);
        
        $this->emit([
            'type' => 'bets',
            'bets' => $this->getBets(),
            'prices' => $this->getPrices()
        ]);

        $this->startTimer();
		$this->newBank($this->game->price);
        return [
            'success' => true,
			'type' => 'success',
            'msg' => 'Your bet is in!'
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

    private function startTimer()
    {
        if($this->game->status > 0) return;

        $this->game->status = 1;
        $this->game->save();

        return $this->emit([
            'type' => 'back_timer',
            'timer' => $this->settings->roulette_timer // заменить на время таймера
        ]);
    }

    public function rotate($number)
    {
        $list = [
            [0,     'green',    0,     14],
            [337,   'red',    	1,     2],
            [288,   'red',      2,     2],
            [240,   'red',    	3,     2],
            [193,   'red',      4,     2],
            [145,   'red',    	5,     2],
            [97,    'red',      6,     2],
            [48,    'red',    	7,     2],
            [312,   'black',    8,     2],
            [264,   'black',    9,     2],
            [216,   'black',    10,    2],
            [169,   'black',    11,    2],
            [121,   'black',    12,    2],
            [72,    'black',    13,    2],
            [24,    'black',    14,    2]
        ];

		if($this->game->winner_num !== null) foreach($list as $l) if($l[2] == $this->game->winner_num) return $l;
		
        return $list[$number];
    }

    public function getSlider() {
		$profit = Profit::where('created_at', '>=', Carbon::today())->sum('sum');
		$ranked = 0;
        $winNumber = mt_rand(0, 14);
		
		$lastGreen = Roulette::where('status', 3)->where('winner_color', 'green')->first();
		$checkUser = RouletteBets::where(['is_fake' => 0, 'round_id' => $this->game->id])->orderBy('id', 'desc')->count();
		if($checkUser >= 1 && $this->game->ranked != 1) {
			if(mt_rand(1, 6) == 3) {
				$betsRed = RouletteBets::where(['round_id' => $this->game->id, 'type' => 'red', 'is_fake' => 0])->sum('price')*2;
				$betsGreen = RouletteBets::where(['round_id' => $this->game->id, 'type' => 'green', 'is_fake' => 0])->sum('price')*14;
				$betsBlack = RouletteBets::where(['round_id' => $this->game->id, 'type' => 'black', 'is_fake' => 0])->sum('price')*2;
				
				$min = min($betsRed, $betsGreen, $betsBlack);
				if($min == $betsRed) $winNumber = mt_rand(1, 7);
				elseif($min == $betsBlack) $winNumber = mt_rand(8, 14);
				elseif($min == $betsBlack && $min == $betsRed) $winNumber = mt_rand(1, 14);
				elseif($min == $betsGreen) {
					if(is_null($lastGreen) || !is_null($lastGreen) && ($this->game->id-$lastGreen->id) > mt_rand(5, 12)) {
						$winNumber = $winNumber;
					}
				} else $winNumber = mt_rand(0, 14);

				$ranked = 1;
			}
		}
		
        $box = $this->rotate($winNumber);
        $rotate = ((floor($this->settings->roulette_rotate/360)*360)+360)+(360*5)+$box[0];

        $this->game->winner_num = $box[2];
        $this->game->winner_color = $box[1];
        $this->game->ranked = $ranked;
        $this->game->save();

        $this->settings->roulette_rotate = $rotate;
        $this->settings->roulette_rotate_start = time();
        $this->settings->save();

        $this->emit([
            'type' => 'slider',
            'slider' => [
                'rotate' => $this->settings->roulette_rotate,
                'color' => $this->game->winner_color,
                'num' => $this->game->winner_num,
                'time' => 7000,
                'timeToNewGame' => 3000,
            ]
        ]);

        return [
            'number' => $this->game->winner_num,
            'color' => $this->game->winner_color,
            'time' => 10000
        ];

    }

    public function getBet(Request $r)
    {
        if($r->get('type') == 'all') return $this->user->balance;
        $bet = RouletteBets::where('user_id', $this->user->id)->orderBy('id', 'desc')->first();
	}

    public function newGame()
    {
        $this->settings->roulette_rotate = $this->settings->roulette_rotate-(floor($this->settings->roulette_rotate/360)*360);
        $this->settings->roulette_rotate2 = $this->settings->roulette_rotate;
        $this->settings->save();
		
        $bets = RouletteBets::select(DB::raw('SUM(price) as price'), 'user_id')->where('round_id', $this->game->id)->where('type', $this->game->winner_color)->groupBy('user_id')->get();
        $multiplier = ($this->game->winner_color == 'green') ? 14 : 2;
		$profit = $this->game->price;
        foreach($bets as $u) {
            $user = User::where(['id' => $u->user_id, 'fake' => 0])->first();
            if(!is_null($user)) {
                $user->balance += $u->price*$multiplier;
                $user->save();
				
				$profit -= $u->price*$multiplier;
				
				if($user->referred_by) {
					$ref = User::where('affiliate_id', $user->referred_by)->first();
					$ref_perc = $this->getRefer($ref->affiliate_id);
					$ref->ref_money += $u->price*$multiplier/100*$ref_perc;
					$ref->ref_money_history += $u->price*$multiplier/100*$ref_perc;
					$ref->save();
				}

                $this->redis->publish('updateBalance', json_encode([
                    'unique_id' => $user->unique_id,
                    'balance' => $user->balance
                ]));
            } else {
				$profit = 0;
			}
        }
		
		Profit::create([
			'game' => 'double',
			'sum' => $profit
		]);
		
		
		$betUsers = RouletteBets::where('round_id', $this->game->id)->where('type', $this->game->winner_color)->get();
		foreach($betUsers as $b) {
			$b->win = 1;
			$b->win_sum += $b->price*$multiplier;
			$b->save();
		}

		$hash = bin2hex(random_bytes(16));
		
        $this->emit([
            'type' => 'newGame',
            'id' => $this->game->id,
            'hash' => $hash,
            'slider' => [
                'rotate' => $this->settings->roulette_rotate,
                'time' => $this->settings->roulette_timer
            ],
            'history' => [
                'num' => $this->game->winner_num,
                'color' => $this->game->winner_color,
                'hash' => $this->game->hash
            ]
        ]);

        $this->game = Roulette::create([
			'hash' => $hash
		]);
		$this->newBank(0);
        return [
            'id' => $this->game->id
        ];

    }
	
	private function getRefer($id) {
        $ref_count = User::where('referred_by', $id)->count();
        if($ref_count < 10) {
            $ref_perc = 0.5;
        } elseif($ref_count >= 10 && $ref_count < 100) {
            $ref_perc = 0.7;
        } elseif($ref_count >= 100 && $ref_count < 500) {
            $ref_perc = 1;
        } else {
            $ref_perc = 1.5;
        }
        return $ref_perc;
    }

    public function updateStatus(Request $r)
    {
        $this->game->status = $r->get('status');
        $this->game->save();
        
        return [
            'success' => true
        ];
    }

    public function getGame()
    {
        return [
            'id' => $this->game->id,
            'status' => $this->game->status,
            'time' => $this->settings->roulette_timer // fix
        ];
    }

    private function getBets()
    {
        $bets = DB::table('roulettebets')
                    ->where('roulettebets.round_id', $this->game->id)
                    ->select('roulettebets.user_id', DB::raw('SUM(roulettebets.price) as value'), 'users.username', 'users.avatar', 'roulettebets.type')
                    ->join('users', 'users.id', '=', 'roulettebets.user_id')
                    ->groupBy('roulettebets.user_id', 'roulettebets.type')
                    ->orderBy('value', 'desc')
                    ->get();
        return $bets;
    }

    private function emit($array)
    {
        return $this->redis->publish('roulette', json_encode($array));
    }
	
	public function gotThis(Request $r) {
		$color = $r->get('color');
		$number = '';
		
		if($this->game->status > 1) return [
			'msg'       => 'The game is on, you cannot twist!',
			'type'      => 'error'
		];
        
		if(!$this->game->id) return [
			'msg'       => 'Failed to get the game number!',
			'type'      => 'error'
		];
		
		if(!$color) return [
			'msg'       => 'Failed to get a colour!',
			'type'      => 'error'
		];
		
		$list = [
            [0,     'green',    0,     14],
            [337,   'red',    	1,     2],
            [288,   'red',      2,     2],
            [240,   'red',    	3,     2],
            [193,   'red',      4,     2],
            [145,   'red',    	5,     2],
            [97,    'red',      6,     2],
            [48,    'red',    	7,     2],
            [312,   'black',    8,     2],
            [264,   'black',    9,     2],
            [216,   'black',    10,    2],
            [169,   'black',    11,    2],
            [121,   'black',    12,    2],
            [72,    'black',    13,    2],
            [24,    'black',    14,    2]
        ];
        
        shuffle($list);
		
		if($color == 'green') $number = 0;
		if($color == 'red') $number = mt_rand(1, 7);
		if($color == 'black') $number = mt_rand(8, 14);
		
		foreach ($list as $l)
		{
			if($l[2] == $number)
			{
				$data = $l;
			}
		}

		Roulette::where('id', $this->game->id)->update([
			'winner_color'      => $data[1],
			'winner_num'     => $data[2],
			'ranked'     => 1
		]);
		
		if($color == 'green') $color = 'green';
		if($color == 'red') $color = 'red';
		if($color == 'black') $color = 'black';
		
		return [
			'msg'       => 'You have tweaked the '.$color.' colour!',
			'type'      => 'success'
		];
	}
	
	public function newBank($sum) {
		$this->redis->publish('updateBank', json_encode([
            'game'    => 'double',
            'sum' => $sum
        ]));
	}
}