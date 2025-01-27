<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mines;
use App\Settings;
use App\User;

class MinesController extends Controller
{

    protected $coef = [
      2 => [1.09,1.19,1.3,1.43,1.58,1.75,1.96,2.21,2.5,2.86,3.3,3.85,4.55,5.45,6.67,8.33,10.71,14.29,20,30,50,100,300],
      3 => [1.14,1.3,1.49,1.73,2.02,2.37,2.82,3.38,4.11,5.05,6.32,8.04,10.45,13.94,19.17,27.38,41.07,65.71,115,230,575,2300],
      4 => [1.19,1.43,1.73,2.11,2.61,3.26,4.13,5.32,6.95,9.27,12.64,17.69,25.56,38.33,60.24,100.4,180.71,361.43,843.33,2530,12650],
      5 => [1.25,1.58,2.02,2.61,3.43,4.57,6.2,8.59,12.16,17.69,26.54,41.28,67.08,115,210.83,421.67,948.75,2530,8855,53130],
      6 => [1.32,1.75,2.37,3.26,4.57,6.53,9.54,14.31,22.12,35.38,58.97,103.21,191.67,383.33,843.33,2108.33],
      7 => [1.39,1.96,2.82,4.13,6.2,9.54,15.1,24.72,42.02,74.7,140.06,280.13,606.94,1456.67,4005.83,13352.78],
      8 => [1.47,2.21,3.38,5.32,8.59,14.31,24.72,44.49,84.04,168.08,360.16,840.38,2185,6555,24035,120175,1081575],
      9 => [1.56,2.5,4.11,6.95,12.16,22.12,42.02,84.04,178.58,408.19,1020.47,2857.31,9286.25,37145,204297.5,2042975],
      10 => [1.67,2.86,5.05,9.27,17.69,35.38,74.7,168.08,408.19,1088.5,3265.49,11429.23,49526.67,297160,3268760],
      11 => [1.79,3.3,6.32,12.64,26.54,58.97,140.06,360.16,1020.47,3265.49,12245.6,57146.15,371450,4457400],
      12 => [1.92,3.85,8.04,17.69,41.28,103.21,280.13,840.38,2857.31,11429.23,57146.15,400023.08,5200300],
      13 => [2.08,4.55,10.45,25.56,67.08,191.67,606.94,2185,9286.25,49526.67,371450,5200300],
      14 => [2.27,5.45,13.94,38.33,115,383.33,1456.67,6555,37145,297160,4457400],
      15 => [2.5,6.67,19.17,60.24,210.83,843.33,4005.83,24035,204297.5,3268760],
      16 => [2.78,8.33,27.38,100.4,421.67,2108.33,13352.78,120175,2042975],
      17 => [3.13,10.71,41.07,180.71,948.75,6325,60087.5,1081575],
      18 => [3.57,14.29,65.71,361.43,2530,25300,480700],
      19 => [4.17,20,115,843.33,8855,177100],
      20 => [5,30,230,2530,53130],
      21 => [6.25,50,575,12650],
      22 => [8.33,100,2300],
      23 => [12.5,300],
      24 => [25]
    ];
    protected $comission = 25;

    public function index() {
      $list = Mines::limit(20)->orderBy('id', 'desc')->where('onOff', 2)->get();
      $game = [];
      foreach($list as $l) {
        $user = User::where('id', $l->id_users)->first();
        $win = $l->result > 0 ? $l->bet * $this->coef[$l->num_mines][$l->step-1] * $l->multiplayer : 0;
        $style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
        $game[] = [
          'unique_id' => $user->unique_id,
          'avatar' => $user->avatar,
          'username' => "<span style='$style'>$user->username</span>",
          'sum' => $l->bet,
          'bombs' => $l->num_mines,
          'coef' => $l->result > 0 ? $this->coef[$l->num_mines][$l->step-1] * $l->multiplayer : 0,
          'win_sum' => $win > 0 ? '+'.$win : 0
        ];
      }
    	return view('pages.mines', compact('game'));
    }
    public function open(Request $r) {
      if(Auth::guest()) return response()->json(['error' => 'true', 'msg' => 'You need to authorise']);
      $game = Mines::where('id_users', Auth::User()->id)->where('onOff', 1)->first();
      if(!$game) return response()->json(['error' => 'true', 'msg' => 'You dont have any active games']);
      $user = User::where('id', Auth::User()->id)->first();

      $true_arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
      if(!in_array($r->open, $true_arr)) return response()->json(['error' => 'true', 'msg' => 'Error! Click on the normal box ;)']);
      if($game->can_open < 1) return response()->json(['error' => 'true', 'msg' => 'You have unlocked all the gems! Take the winnings', 'noend' => '1']);
      // antiminus baby
      $antiminus = Settings::orderBy('id', 'desc')->first();

      if($game->bet * $this->coef[$game->num_mines][$game->step] * $game->multiplayer - $game->bet > $antiminus->bank_mines && !in_array($r->open, unserialize($game->mines))) {
        $mines_select = unserialize($game->mines); // получаем массив с бомбами
        array_splice($mines_select, -1, 1, $r->open); // заменяем одно из значений на значение клика
        $game->mines = serialize($mines_select); // формируем
        $game->save(); // сохраняем
      }
      // antiminus end ))0

      if(in_array($r->open, unserialize($game->click))) return response()->json(['error' => 'true', 'msg' => 'Error! You have already opened this box', 'noend' => '1']);
      $bombs = unserialize($game->mines);
      if(in_array($r->open, $bombs)) {
        Mines::where('id_users', $user->id)->where('onOff', 1)->update([
          'onOff' => 2,
          'result' => 0
        ]);
        $antiminus->bank_mines+=round($game->bet / 100 * (100-$antiminus->comission), 2); // Откладываем % админу в копилку
        $antiminus->save();
        $style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
        $this->redis->publish('mines', json_encode([
          'unique_id' => $user->unique_id,
          'avatar' => $user->avatar,
          'username' => $user->username,
          'style' => $style,
          'sum' => $game->bet,
          'bombs' => $game->num_mines,
          'coef' => 0,
          'win_sum' => 0
        ]));
        return response()->json(['error' => 'true', 'msg' => 'Oops! You have been blown up by a bomb.', 'bombs' => $bombs]);
      }
      $clicks = unserialize($game->click);
      $clicks[] = $r->open;
      $clicks = serialize($clicks);
      $step = $game->step+1;
      $withoutMulti = round($game->bet * $this->coef[$game->num_mines][$step-1], 2);
      $nextX = $this->coef[$game->num_mines][$step] ?? $this->coef[$game->num_mines][$step-1];

      $multiplayer = 1;
      $multi = [];
      if(rand(0, 100) <= 1 && $game->multiplayer == 1) {
        for($i = 0; $i <= 15; $i++) {
          $multi[] = rand(2,7);
        }
        for($i = 0; $i <= 5; $i++) {
          $multi[] = 8;
        }
        for($i = 0; $i <= 3; $i++) {
          $multi[] = 9;
        }
        for($i = 0; $i <= 2; $i++) {
          $multi[] = 10;
        }
        shuffle($multi);
        $multiplayer = $multi[rand(0, count($multi)-1)];
        if($game->bet * $this->coef[$game->num_mines][$game->step+1] * $multiplayer >= $antiminus->bank_mines) {
          $multiplayer = 1;
          $multi = [];
        }
      }
      Mines::where('id_users', $user->id)->where('onOff', 1)->update([
        'step' => $game->step+1,
        'click' => $clicks,
        'can_open' => $game->can_open-1,
        'multiplayer' => ($multiplayer > 1) ? $multiplayer : $game->multiplayer
      ]);
      $minesMulti = ($game->multiplayer > 1) ? $game->multiplayer : $multiplayer;
      $profit = round($game->bet * $this->coef[$game->num_mines][$step-1] * $minesMulti, 2);
      return response()->json(['success' => 'true', 'msg' => '', 'multiplayer' => $multiplayer, 'multix' => $multi, 'coef' => $profit, 'withoutMulti' => $withoutMulti, 'next' => $nextX, 'step' => $game->step+1]);
    }
    public function create(Request $r) {
      if(Auth::guest()) return response()->json(['error' => 'true', 'msg' => 'You need to authorise']);
      if(!in_array($r->bomb, [3, 5, 10, 24])) return response()->json(['error' => 'true', 'msg' => 'Specify the number of bombs']);
      $bet = preg_replace('/[^0-9.]/', '', $r->bet);
      if($bet < 1 || !$bet) return response()->json(['error' => 'true', 'msg' => 'Betting amount from 1.00']);
      //if(strpos($bet, '.')) return response()->json(['error' => 'true', 'msg' => 'Ставка должна быть целым числом']);

      $user = User::where('id', Auth::User()->id)->first();
      $game = Mines::where('id_users', $user->id)->where('onOff', 1)->count();
      if(Auth::User()->balance < $bet) return response()->json(['error' => 'true', 'msg' => 'Insufficient funds']);
      if($game >= 1) return response()->json(['error' => 'true', 'msg' => 'You already have an active game']);
      // генерируем ячейки с бомбами и т.п
      $resultmines = range(1,25);
      shuffle($resultmines);
      $resultmines = array_slice($resultmines, 0, $r->bomb);
      $resultmines = serialize($resultmines);

      $click = [];
      $click = serialize($click);

      Mines::create([
        'id_users' => $user->id,
        'bet' => $bet,
        'onOff' => 1,
        'step' => 0,
        'result' => 1,
        'win' => 0,
        'mines' => $resultmines,
        'click' => $click,
        'num_mines' => $r->bomb,
        'login' => $user->username,
        'can_open' => 25-$r->bomb,
        'total' => 0
      ]);
      $user->balance -= $bet;
      $user->bsum += $bet;
      $user->save();
      $tournament = \App\Tournament::where('status', 1)->where('end', '>', time())->orderBy('id', 'desc')->first();
        if($tournament) {
          $player = \App\TournamentPlayers::where('user_id', $user->id)->where('tour_id', $tournament->id)->first();
          if($player) {
            $player->bets+=$bet;
            $player->save();
          } else {
            \App\TournamentPlayers::create([
               'tour_id' => $tournament->id,
               'user_id' => $user->id,
                'bets' => $bet
            ]);
          }
      }
      $this->redis->publish('updateBalance', json_encode([
        'unique_id' => $user->unique_id,
        'balance'   => round($user->balance, 2)
      ]));
      return response()->json(['success' => 'true', 'msg' => 'The game is set! Good luck!', 'balance' => $user->balance]);
    }
    public function get() {
      if(Auth::guest()) return response()->json(['status' => '0']);
      $user = User::where('id', Auth::User()->id)->first();
      $game = Mines::where('id_users', $user->id)->where('onOff', 1)->first();
      if(!$game) return response()->json(['status' => '0']);

      $click = unserialize($game->click);
      $step = $game->step;
      $bombs = $game->num_mines;
      if($step != 0) {
      $profit = round($game->bet * $this->coef[$bombs][$step-1], 2);
      } else $profit = "0.00";
      $nextX = $this->coef[$bombs][$step] ?? $this->coef[$bombs][$step-1];
      $coeff = ($profit * $game->multiplayer > 0) ? $profit * $game->multiplayer : $game->bet;
      return response()->json(['status' => 1, 'click' => $click, 'coef' => round($coeff, 2), 'next' => $nextX, 'step' => $game->step, 'bombs' => $game->num_mines, 'multiplayer' => $game->multiplayer]);
    }
    public function take() {
      if(Auth::guest()) return response()->json(['error' => 'true', 'msg' => 'You need to authorise']);
      $game = Mines::where('id_users', Auth::User()->id)->where('onOff', 1)->first();
      if(!$game) return response()->json(['error' => 'true', 'msg' => 'You dont have any active games']);
      if($game->step == 0) return response()->json(['error' => 'true', 'msg' => 'Open at least 1 box']);
      $user = User::where('id', Auth::User()->id)->first();

      $antiminus = Settings::orderBy('id', 'desc')->first();

      $win = round($game->bet * $this->coef[$game->num_mines][$game->step-1] * $game->multiplayer, 2);
      $user->balance += $win;
      $user->save();
      Mines::where('id_users', $user->id)->where('onOff', 1)->update([
        'onOff' => 2,
        'result' => $win,
        'total' => $game->result > 0 ? $this->coef[$game->num_mines][$game->step-1] * $game->multiplayer : 0
      ]);

      $antiminus->bank_mines -= $win-$game->bet;
      $antiminus->save();
      $style = ($user->style > 0) ? \App\Styles::where('id', $user->style)->first()->css : 0;
      $this->redis->publish('mines', json_encode([
        'unique_id' => $user->unique_id,
        'avatar' => $user->avatar,
        'username' => $user->username,
        'style' => $style,
        'sum' => $game->bet,
        'bombs' => $game->num_mines,
        'coef' => $game->result > 0 ? $this->coef[$game->num_mines][$game->step-1] * $game->multiplayer : 0,
        'win_sum' => $win > 0 ? '+'.$win : 0
      ]));
      $this->redis->publish('updateBalance', json_encode([
        'unique_id' => $user->unique_id,
        'balance'   => round($user->balance, 2)
      ]));
      $win = number_format($win, 2, '.', '');
      return response()->json(['success' => 'true', 'msg' => 'You took '.$win.' €.', 'balance' => $user->balance, 'win' => $win, 'coef' => $this->coef[$game->num_mines][$game->step-1] * $game->multiplayer, 'bombs' => unserialize($game->mines)]);
    }
}
