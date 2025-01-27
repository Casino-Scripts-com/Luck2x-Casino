<?php namespace App\Http\Controllers;

use Socialite;
use App\User;
use App\Profit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
    }
	
    public function login(Request $r, $provider)
    {
        if($provider == 'google') return $this->google($r);
        return Socialite::driver($provider)->redirect();
    }

    public function google(Request $r) {
        $client_id = '1004954149418-hrb9gco9qbruqn1ja7u2i9hr16v2f9aa.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'https://sweetx.site';

        if (!is_null($r->code)) {
            $url = 'https://accounts.google.com/o/oauth2/token';
            $params = array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri . '/auth/google',
                'grant_type' => 'authorization_code',
                'code' => $r->code
            );

            $obj = json_decode($this->curl($url, $params));

            if (isset($obj->access_token)) {
                $params['access_token'] = $obj->access_token;
                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);

                if(isset($userInfo['id'])) {
                    $user = $this->createOrGetUser($userInfo, 'google');
                    Auth::login($user, true);
                    return redirect()->intended('/');
                }
                else return json_encode(['error' => 'user id is not granted']);
            } else return json_encode(['error' => dd($obj)]);
        } else return redirect('https://accounts.google.com/o/oauth2/auth?'.urldecode(http_build_query([
            'redirect_uri' => $redirect_uri . '/auth/google',
            'response_type' => 'code',
            'client_id' => $client_id,
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        ])));
    }


    public function callback($provider)
    {
		try { 
			$user = json_decode(json_encode(Socialite::driver($provider)->stateless()->user())); 
		} catch (\Exception $e) { 
			return redirect()->route('index')->with('error', 'Session data is out of date, try again!'); 
		}
        if(isset($user->returnUrl)) return redirect('/');
        $user = $user->user;
        $user = $this->createOrGetUser($user, $provider);
        Auth::login($user, true);
        return redirect()->intended('/');
    }

    public function createOrGetUser($user, $provider) {
		$ref_id = Cookie::get('ref');
		$ref = User::where('unique_id', $ref_id)->first();
		$plus = 0;
		$ban = 0;
		$ban_reason = null;
        if ($provider == 'vkontakte') {
			$ipCheck = User::where('ban', 0)->where('ip', request()->ip())->first();
			$banCheck = User::where('ban', 1)->where('user_id', $user->id)->count();
			if(!is_null($ipCheck) && $ipCheck->user_id != $user->id ||  $banCheck > 0) {
				$ban_reason = 'Violation of rule 7.4.1 - "It is forbidden to register more than one account through the site. Such actions will result in blocking of the account"';
			}
            $u = User::where('user_id', $user->id)->first();
            if ($u) {
                $username = $user->first_name.' '.$user->last_name;
                User::where('user_id', $user->id)->update([
                    'username' => $username,
                    'avatar' => $user->photo_max,
                    'ip' => request()->ip(),
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]); 
                $user = $u;
            } else {
				if(!is_null($ref) && !$ban) {
					$ref->link_reg += 1;
					$ref->save();
					$plus = $this->settings->ref_sum;
					if($plus > 0) Profit::create([
						'game' => 'ref',
						'sum' => -$plus
					]);
				} else $ref_id = null;
                $username = $user->first_name.' '.$user->last_name;
                $user = User::create([
                    'unique_id' => bin2hex(random_bytes(6)),
                    'user_id' => $user->id,
                    'username' => $username,
                    'avatar' => $user->photo_max,
                    'ip' => request()->ip(),
                    'balance' => $plus,
                    'ref_id' => $ref_id,
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]);
            }
        }

        if ($provider == 'yandex') {
			$ipCheck = User::where('ban', 0)->where('ip', request()->ip())->first();
			$banCheck = User::where('ban', 1)->where('user_id', $user->id)->count();
			if(!is_null($ipCheck) && $ipCheck->user_id != $user->id ||  $banCheck > 0) {
				$ban_reason = 'Violation of rule 7.4.1 - "It is forbidden to register more than one account through the site. Such actions will result in blocking of the account"';
			}
            $u = User::where('user_id', $user->id)->first();
            if ($u) {
                User::where('user_id', $user->id)->update([
                    'ip' => request()->ip(),
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]); 
                $user = $u;
            } else {
				if(!is_null($ref) && !$ban) {
					$ref->link_reg += 1;
					$ref->save();
					$plus = $this->settings->ref_sum;
					if($plus > 0) Profit::create([
						'game' => 'ref',
						'sum' => -$plus
					]);
				} else $ref_id = null;
                $user = User::create([
                    'unique_id' => bin2hex(random_bytes(6)),
                    'user_id' => $user->id,
                    'username' => $user->display_name,
                    'avatar' => $user->avatar ?? 'https://vk.com/images/camera_200.png',
                    'ip' => request()->ip(),
                    'balance' => $plus,
                    'ref_id' => $ref_id,
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]);
            }
        }

        if ($provider == 'google') {
			$ipCheck = User::where('ban', 0)->where('ip', request()->ip())->first();
			$banCheck = User::where('ban', 1)->where('user_id', $user['id'])->count();
			if(!is_null($ipCheck) && $ipCheck->user_id != $user['id'] ||  $banCheck > 0) {
				$ban_reason = 'Violation of rule 7.4.1 - "It is forbidden to register more than one account through the site. Such actions will result in blocking of the account"';
			}
            $u = User::where('user_id', $user['id'])->first();
            if ($u) {
                User::where('user_id', $user['id'])->update([
                    'username' => $user['name'],
                    'avatar' => $user['picture'] ?? 'https://vk.com/images/camera_200.png',
                    'ip' => request()->ip(),
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]); 
                $user = $u;
            } else {
				if(!is_null($ref) && !$ban) {
					$ref->link_reg += 1;
					$ref->save();
					$plus = $this->settings->ref_sum;
					if($plus > 0) Profit::create([
						'game' => 'ref',
						'sum' => -$plus
					]);
				} else $ref_id = null;
                
                $user = User::create([
                    'unique_id' => bin2hex(random_bytes(6)),
                    'user_id' => $user['id'],
                    'username' => $user['name'],
                    'avatar' => $user['picture'] ?? 'https://vk.com/images/camera_200.png',
                    'ip' => request()->ip(),
                    'balance' => $plus,
                    'ref_id' => $ref_id,
                    'ban' => $ban,
                    'ban_reason' => $ban_reason
                ]);
            }
        }
        return $user;
    }

    public function logout()
    {
		Cache::flush();
        Auth::logout();
		Session::flush();
        return redirect()->intended('/');
    }

    public function curl($url, $params = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if($params != null) curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function auth(Request $r) {
        $login = $r->login;
        $password = $r->password;
        $preferred_login = null;

        $user = User::where([['username', $login], ['password', hash('sha256', $password)]])->first();

        if(!$user) return response()->json(['error' => true, 'message' => 'Invalid user name or password.']);

        Auth::login($user, true);

        return response()->json(['success' => 'true']);
    }

	public function register(Request $r) {
        $username = $r->login;
        $password = $r->password;

        $ref_id = Cookie::get('ref');
		$ref = User::where('unique_id', $ref_id)->first();
		$plus = 0;

        if(preg_match('/^[a-zA-Z0-9]{5,}$/', $username) == 0 || (strlen($username) < 5 ||strlen($username) > 24)) return response()->json(['error' => true, 'message' => 'Login must be between 5 and 24 characters.']);

        if(User::where('username', $username)->exists()) return response()->json(['error' => true, 'message' => 'This login is already in use']);
		
		if(!is_null($ref) && !$ban) {
			$ref->link_reg += 1;
			$ref->save();
		    $plus = $this->settings->ref_sum;
			if($plus > 0) Profit::create([
				'game' => 'ref',
				'sum' => -$plus
			]);
		} else $ref_id = null;
                
        $user = User::create([
            'unique_id' => bin2hex(random_bytes(6)),
            'user_id' => null,
            'username' => $username,
            'password' => hash('sha256', $password),
            'avatar' => 'https://vk.com/images/camera_200.png',
            'ip' => request()->ip(),
            'balance' => $plus,
            'ref_id' => $ref_id,
            'ban' => 0,
            'ban_reason' => null
        ]);

        $user->update(['user_id' => $user->id]);

        Auth::login($user, true);

        return response()->json(['success' => true]);
    }
}