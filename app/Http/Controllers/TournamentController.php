<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Tournament;
use App\TournamentPlayers;
use App\Models\Settings;
use DB;

class TournamentController extends Controller
{
    protected $percents = [
        1 => 25,
        2 => 15,
        3 => 10,
        4 => 8,
        5 => 7,
        6 => 6,
        7 => 5,
        8 => 4,
        9 => 3,
        10 => 2
    ];
    public function __construct() {
        parent::__construct();
		DB::connection()->getPdo()->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
    public function index() {
        $members = [];
        $is_active = 0;
        $reward = 0;
        $winners = 0;
        $endIn = 0;
        $duration = 0;
        $tournament = Tournament::where('status', 1)->where('end', '>', time())->orderBy('id', 'desc')->first();
        if($tournament) {
            $i = 1;
            $players = TournamentPlayers::where('tour_id', $tournament->id)->orderBy('bets', 'desc')->limit($tournament->members)->get();
            $fixedReward = $tournament->reward / 100 * (100 - array_sum($this->percents)) / ($tournament->members - count($this->percents));
            foreach ($players as $p) {
                $info = User::where('id', $p->user_id)->first();
                $members[] = [
                    'style' => ($info->style > 0) ? \App\Styles::where('id', $info->style)->first()->css : 0,
                    'unique_id' => $info->unique_id,
                    'position' => $i,
                    'avatar' => $info->avatar,
                    'username' => $info->username,
                    'bets' => $p->bets,
                    'reward' => (isset($this->percents[$i])) ? round($this->percents[$i] / 100 * $tournament->reward, 2) : $fixedReward
                ];
                $i++;
            }
            $reward = number_format($tournament->reward, 0, '.', ' ');
            $winners = $tournament->members;
            $endIn = $this->secondsToTime($tournament->end - time());
            $duration = $this->secondsToTime($tournament->end - $tournament->start);
            $is_active = 1;
        }
    	return view('pages.tournament', compact('is_active', 'members', 'reward', 'winners', 'endIn', 'duration'));
    }
    public function sendTour($id) {
        if(!Tournament::where('id', $id)->first()) return redirect()->route('admin.tournaments')->with('error', 'Tournament not found');
        if(Tournament::where('id', $id)->first()->status == 2) return redirect()->route('admin.tournaments')->with('error', 'The prizes for this tournament have already been given');
        if(!Tournament::where('id', $id)->first()->end > time()) return redirect()->route('admin.tournaments')->with('error', 'The tournament cannot be completed now');

        $tournament = Tournament::where('id', $id)->orderBy('id', 'desc')->first();
        if($tournament) {
            $i = 1;
            $players = TournamentPlayers::where('tour_id', $tournament->id)->orderBy('bets', 'desc')->limit($tournament->members)->get();
            $fixedReward = $tournament->reward / 100 * (100 - array_sum($this->percents)) / ($tournament->members - count($this->percents));
            foreach ($players as $p) {
                $winner = User::where('id', $p->user_id)->first();
                $winner->balance+=(isset($this->percents[$i])) ? round($this->percents[$i] / 100 * $tournament->reward, 2) : $fixedReward;
                $winner->save();
                $i++;
            }
        }
        $tournament->status = 2;
        $tournament->save();
        return redirect()->route('admin.tournaments')->with('success', 'Prizes have been given');
    }
    function secondsToTime($seconds) {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a day %h h %i min');
    }
}
