<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Slots;
use App\SlotsData;
use Exception;

class SlotsController extends Controller
{
    protected $HALL_ID = 'luckystrike';
    protected $HALL_KEY = '121212121212212';

    public function init($game_id)
    {
        $slot = Slots::where('game_id', $game_id)->first();

        if(!$slot || !$this->user) {
            return redirect()->back();
        }
        
        $title = $slot->title;

        $user = User::where('id', Auth::id())->first();

        if($user->auth_token == null) {
            $user->auth_token = bin2hex(random_bytes(20));
            $user->save();
        }

        $user->current_id = $slot->game_id;
        $user->save();

        $link = "https://test.partners.casinomobule.com/games.start?partner.alias=luckystrike&partner.session={$user->auth_token}&game.provider={$slot->provider}&game.alias={$slot->alias}&lang=ru&lobby_url=https://lucky-strike.online/slots&currency=EUR&mobile=false";

        return view('pages.slot', compact('title', 'link'));
    }

    public function callback1($method, Request $r) {
        switch($method) {
            case 'trx.cancel':
                return $this->trxCancel($r);
            break;

            case 'trx.complete':
                return $this->trxComplete($r);
            break;

            case 'check.session':
                return $this->checkSession($r);
            break;

            case 'check.balance':
                return $this->checkBalance($r);
            break;

            case 'withdraw.bet':
                return $this->userBet($r);
            break;

            case 'deposit.win':
                return $this->userWin($r);
            break;

            default:
                throw new \Exception("Unknown method");
        }
    }

    private function trxCancel($data) {
        return response()->json(['status' => 200]);
    }

    private function trxComplete($data) {
        return response()->json(['status' => 200]);
    }

    private function checkSession($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown session']);
        $user = User::where('auth_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.session', 'response' => ['id_player' => $user->id, 'id_group' => 'default', 'balance' => round($user->balance * 100)]]);
    }

    private function checkBalance($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown session']);
        $user = User::where('auth_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.balance', 'response' => ['currency' => 'EUR', 'balance' => round($user->balance * 100)]]);
    }

    public function userBet($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown session']);
        $bet = SlotsData::where('trx_id', $data->trx_id)->first();
        if($bet) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Bet already exists']); 
        $user = User::where('auth_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown user']);

        $user->balance -= $data->amount / 100;
        $user->save();

        SlotsData::create([
            'user_id' => $user->id,
            'trx_id' => $data->trx_id,
            'game_id' => $user->current_id,
            'amount' => $data->amount / 100,
            'type' => 'bet',
            'balanceBefore' => $user->balance + ($data->amount / 100),
            'balanceAfter' => $user->balance
        ]);

        return response()->json(['status' => 200, 'method' => 'withdraw.bet', 'response' => ['currency' => 'EUR', 'balance' => round($user->balance * 100)]]);
    }

    public function userWin($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown session']);
        $user = User::where('auth_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown user']);

        $user->balance += $data->amount / 100;
        $user->save();

        if($data->amount > 0) {
            SlotsData::create([
                'user_id' => $user->id,
                'trx_id' => $data->trx_id,
                'game_id' => $user->current_id,
                'amount' => $data->amount / 100,
                'type' => 'win',
                'balanceBefore' => $user->balance - ($data->amount / 100),
                'balanceAfter' => $user->balance
            ]);
        }

        return response()->json(['status' => 200, 'method' => 'withdraw.bet', 'response' => ['currency' => 'EUR', 'balance' => round($user->balance * 100)]]);
    }

    public function callback(Request $request)
    {
        $cmd = $request->cmd;

        if($request->key != $this->HALL_KEY) return 'hacking attempt!';

        switch ($cmd) {
            case 'getBalance': 
                $data = $this->getBalance($request);
                return json_encode($data);
            break;

            case 'writeBet':
                $data = $this->writeBet($request);
                return json_encode($data);
            break;

            default: 
                die('Wrong cmd');
        }
    }

    public function list()
    {
        $data = json_decode(file_get_contents(public_path() . "/slots.json"), true);
        $slots = $data['content']['gameList'];

        Slots::where('id', '>', 0)->delete();

        foreach($slots as $slot) {
            Slots::create([
                'game_id'  => $slot['id'],
                'title'    => $slot['name'],
                'provider' => $slot['label'],
                'icon'     => $slot['img']
            ]);
        }

        return 'OK';
    }

    private function writeBet($request)
    {
        $user = $this->findBySession($request->sessionId);

        $bet = $request->bet;
        $win = $request->win;

        if(!$user) {
            return [
                'status' => 'fail',
                'error'  => 'user_not_found'
            ];
        }
        
        if($user->balance < $bet) {
            return [
                'status' => 'fail',
                'error'  => 'fail_balance'
            ];
        }

        $user->increment('balance', $win - $bet);

        return [
            "status"      => "success",
            "error"       => "",
            "login"       => $user->unique_id,
            "balance"     => number_format($user->balance, 2, '.', ''),
            "currency"    => "LAK",
            "operationId" => "3234234"
        ];
    }

    private function getBalance($request) // cmd getBalance
    {
        $user = $this->findByLogin($request->login);

        return [
            "status"   => "success",
            "error"    => "",
            "login"    => $user->unique_id,
            "balance"  => number_format($user->balance, 2, '.', ''),
            "currency" => "LAK"            
        ];
    }

    private function findByLogin($login)
    {
        $user = User::where('unique_id', $login)->first();
        return $user;
    }

    private function findBySession($sessionId)
    {
        $user = User::where('sessionId', $sessionId)->first();
        return $user;
    }
}