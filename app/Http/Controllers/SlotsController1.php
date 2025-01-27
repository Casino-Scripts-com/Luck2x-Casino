<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Slots;
use Exception;

class SlotsController extends Controller
{
    protected $HALL_ID = '3200468';
    protected $HALL_KEY = '123456352';

    public function init($game_id)
    {
        $slot = Slots::where('game_id', $game_id)->first();

        if(!$slot || !$this->user) {
            return redirect()->back();
        }

        $id = $slot->id;
        $title = $slot->title;

        $data = [
            "cmd" => "openGame",
            "hall" => 3200468,
            "key" => 123456352,
            "language" => "en",
            "continent" => "eur",
            "login" => $this->user->unique_id,
            "cdnUrl" => "https://cdn.lvslot.net/",
            "domain" => "https://sweetx.site/slots",
            "exitUrl" => "https://sweetx.site/",
            "demo" => "0",
            "gameId" => $game_id
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tbs2api.dark-a.com/API/openGame/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        $output = json_decode($output, true);
        $link = $output['content']['game']['url'];

        User::where('id', $this->user->id)->update([
            'sessionId' => $output['content']['gameRes']['sessionId']
        ]);

        return view('pages.slot', compact('id', 'title', 'link'));
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
            "currency"    => "EUR",
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
            "currency" => "EUR"            
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