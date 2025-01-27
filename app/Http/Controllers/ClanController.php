<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Clans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class ClanController extends Controller
{
    protected $price = 0;

    public function kick($id, $unique_id) {
        if(!Auth::User()) {
            return back()->with('error', 'Authorise!');
        }

        $user = User::where('unique_id', $unique_id)->first();
        $clan = Clans::where('id', $id)->first();
        if($user->clan_id == 0 || !in_array($user->unique_id, unserialize($clan->members))) {
            return back()->with('error', 'The player is not a member of a clan');
        }
        if(Auth::User()->clan_id != $id) {
            return back()->with('error', 'You are not a member of this clan');
        }
        if(Auth::User()->unique_id == $unique_id) {
            return back()->with('error', 'You cannot kick yourself.');
        }
        if(Auth::User()->unique_id != $clan->admin_id) {
            return back()->with('error', 'Not enough rights');
        }
        if(!$clan) {
            return back()->with('error', 'Clan not found');
        }

        $points = floor($user->bsum / 10);
        $members = unserialize($clan->members);
        $members = array_diff($members, [$user->unique_id]);
        $user->update([
            'clan_id' => 0
        ]);

        $clan->update([
            'points' => $clan->points - $points,
            'members' => serialize($members)
        ]);

        return back()->with('success', 'You kicked a player '.$user->username.' from the clan');
    }
    public function leave($id) {
        if(!Auth::User()) {
            return back()->with('error', 'Authorise!');
        }

        $user = User::where('unique_id', Auth::User()->unique_id)->first();
        $clan = Clans::where('id', $id)->first();
        if($user->clan_id == 0) {
            return back()->with('error', 'You are not a member of the clan');
        }
        if(!$clan) {
            return back()->with('error', 'Clan not found');
        }

        $points = floor($user->bsum / 10);
        $members = unserialize($clan->members);
        $members = array_diff($members, [$user->unique_id]);
        $user->update([
            'clan_id' => 0
        ]);

        $clan->update([
            'points' => $clan->points - $points,
            'members' => serialize($members)
        ]);

        return back()->with('success', 'You left the clan');
    }
    public function join($id) {
        if(!Auth::User()) {
            return back()->with('error', 'Authorise!');
        }

        $user = User::where('unique_id', Auth::User()->unique_id)->first();
        $clan = Clans::where('id', $id)->first();
        if($user->clan_id != 0) {
            return back()->with('error', 'You are already a member of a clan');
        }
        if($user->clan_id == $id || in_array($user->unique_id, unserialize($clan->members))) {
            return back()->with('error', 'You are already a member of this clan');
        }
        if(!$clan) {
            return back()->with('error', 'Clan not found');
        }
        $points = floor($user->bsum / 10);
        if($points < $clan->need_points) {
            return back()->with('error', 'You do not have enough points to join the clan');
        }

        $members = unserialize($clan->members);
        $members[] = $user->unique_id;

        if(count($members) >= 100) {
            return back()->with('error', 'The clan is overcrowded');
        }

        $user->update([
            'clan_id' => $clan->id
        ]);

        $clan->update([
            'points' => $clan->points + $points,
            'members' => serialize($members)
        ]);

        return back()->with('success', 'You joined the clan');
    }
    public function create(Request $r) {
        if(!Auth::User()) {
            return response()->json(['type' => 'error', 'msg' => 'Authorise!']);
        }
        if(!$r->name || !$r->avatar || !$r->points) {
            return response()->json(['type' => 'error', 'msg' => 'Fill in all fields!']);
        }
        if(strlen($r->name) > 20) {
            return response()->json(['type' => 'error', 'msg' => 'The title is too long']);
        }
        if($r->points > 999999999) {
            return response()->json(['type' => 'error', 'msg' => 'Enter the number of points correctly']);
        }
        if(Clans::where('name', $r->name)->first()) {
            return response()->json(['type' => 'error', 'msg' => 'A clan by that name already exists']);
        }

        $user = User::where('unique_id', Auth::User()->unique_id)->first();
        if($user->clan_id != 0) {
            return response()->json(['type' => 'error', 'msg' => 'You are already a member of a clan']);
        }
        if($user->balance < $this->price) {
            return response()->json(['type' => 'error', 'msg' => 'Insufficient funds']);
        }

        $members = [];
        $members[] = $user->unique_id;

        $newclan = Clans::create([
            'members' => serialize($members),
            'admin_id' => $user->unique_id,
            'name' => htmlspecialchars($r->name),
            'avatar' => $r->avatar,
            'need_points' => $r->points,
            'points' => floor($user->bsum / 10)
        ]);

        $user->update([
            'clan_id' => $newclan->id,
            'balance' => $user->balance - $this->price
        ]);
		$this->redis->publish('updateBalance', json_encode([
			'unique_id' => $user->unique_id,
			'balance' 	=> round($user->balance, 2)
		]));
        return response()->json(['type' => 'success', 'msg' => 'The clan has been successfully created!']);
    }
}