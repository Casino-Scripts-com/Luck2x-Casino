<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'slots'], function () {
	Route::get('/', 'PagesController@slots');
	Route::get('/game/{id}', 'SlotsController@init');
	Route::any('/callback/{method}', 'SlotsController@callback1');
	Route::get('/list', 'SlotsController@list');
});

Route::get('/result/qpay', 'PagesController@resultQpay');

Route::get('/sdjfhskfdhjs', 'Controller@sdjfhskfdhjs');

Route::get('/clan/{id}', ['as' => 'clan', 'uses' => 'PagesController@clan']);
Route::get('/clan/{id}/kick/{unique_id}', ['as' => 'clan', 'uses' => 'ClanController@kick']);
Route::get('/clan/{id}/join', ['as' => 'clan', 'uses' => 'ClanController@join']);
Route::get('/clan/{id}/leave', ['as' => 'clan', 'uses' => 'ClanController@leave']);
Route::get('/clans', ['as' => 'clans', 'uses' => 'PagesController@clans']);
Route::post('/clans/create', ['as' => 'clanCreate', 'uses' => 'ClanController@create']);

Route::get('/tournament', ['as' => 'tournament', 'uses' => 'TournamentController@index']);
Route::get('/', ['as' => 'index', 'uses' => 'PagesController@index']);
Route::get('/getMyUnique', ['as' => 'getMyUnique', 'uses' => 'PagesController@getMyUnique']);
Route::get('/king', 'KingController@index')->name('king');
Route::get('/jackpot', ['as' => 'jackpot', 'uses' => 'JackpotController@jackpot']);
Route::get('/jackpot/history', ['as' => 'jackpot.history', 'uses' => 'JackpotController@history']);
Route::post('/jackpot/init', 'JackpotController@initRoom');
Route::post('/jackpot/initHistory', 'JackpotController@initHistory');
Route::get('/slots/{type}', ['as' => 'slots_list', 'uses' => 'PagesController@slots_list']);
Route::get('/wheel', ['as' => 'wheel', 'uses' => 'WheelController@index']);
Route::get('/bets/{id}', 'JackpotController@parseJackpotGame');
Route::get('/tower', 'TowerController@index')->name('tower');
Route::get('/getFloat', ['as' => 'crash', 'uses' => 'CrashController@getFloat']);
Route::get('/pvp', ['as' => 'coinflip', 'uses' => 'CoinFlipController@index']);
Route::get('/battle', ['as' => 'battle', 'uses' => 'BattleController@index']);
Route::get('/dice', ['as' => 'dice', 'uses' => 'DiceController@index']);
Route::get('/crash', ['as' => 'crash', 'uses' => 'CrashController@index']);
Route::get('/HiLo', ['as' => 'HiLo', 'uses' => 'HiLoController@index']);
Route::get('/faq', ['as' => 'faq', 'uses' => 'PagesController@faq']);
Route::get('/Double', ['as' => 'faq', 'uses' => 'DoubleController@index']);
Route::get('/rank', ['as' => 'ranks', 'uses' => 'PagesController@ranks']);
Route::post('/getUser', 'PagesController@getUser');
Route::post('/fair/check', 'PagesController@fairCheck');
Route::any('/result/checkcheck1', 'PagesController@resultLP');
Route::any('/result/fkkassa1', 'PagesController@resultFK');
Route::any('/success', 'PagesController@success');
Route::any('/fail', 'PagesController@fail');

Route::group(['prefix' => '/auth'], function () {
    Route::get('/{provider}', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::get('/callback/{provider}', 'AuthController@callback');
});

Route::group(['middleware' => 'guest'], function() {
	Route::post('/auth', 'AuthController@auth');
	Route::post('/register', 'AuthController@register');
});

Route::group(['prefix' => 'roulette'], function() {
	Route::post('/addBet', 'DoubleController@addBet');
	Route::post('/getBet', 'DoubleController@getBet');
	Route::get('/history', 'DoubleController@history');
});

Route::group(['prefix' => '/mines'], function () {
	Route::get('/', ['as' => 'mines', 'uses' => 'MinesController@index']);
	Route::post('/create', 'MinesController@create');
	Route::post('/open', 'MinesController@open');
	Route::post('/claim', 'MinesController@take');
	Route::post('/get', 'MinesController@get');
});
Route::group(['middleware' => 'auth'], function () {
	Route::post('/king/bet', 'KingController@bet');
	Route::get('/rank/claim/{id}', ['as' => 'rankClaim', 'uses' => 'PagesController@rankClaim']);
	Route::get('/rank/select/{id}', ['as' => 'rankSelect', 'uses' => 'PagesController@rankSelect']);
	Route::get('/profile/history', ['as' => 'profile.history', 'uses' => 'PagesController@profileHistory']);
	Route::get('/affiliate', ['as' => 'affiliate', 'uses' => 'PagesController@affiliate']);
	Route::post('/affiliate/get', 'PagesController@affiliateGet');
	Route::get('/free', ['as' => 'free', 'uses' => 'PagesController@free']);
	Route::post('/free/getWheel', 'PagesController@freeGetWheel');
	Route::get('/pay/send', ['as' => 'paySend', 'uses' => 'PagesController@paySend']);
    Route::post('/payment/send/create', 'PagesController@sendCreate');
	Route::post('/free/spin', 'PagesController@freeSpin');
	Route::post('/promo/activate', 'PagesController@promoActivate');
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::post('/chat', 'ChatController@add_message');
	Route::post('/unbanMe', 'PagesController@unbanMe');
	Route::post('/exchange', 'PagesController@exchange');
	Route::post('/pay', 'PagesController@pay');
	Route::post('/withdraw', 'PagesController@userWithdraw');
	Route::post('/withdraw/cancel', 'PagesController@userWithdrawCancel');
	Route::post('/giveaway/join', 'PagesController@joinGiveaway');
	Route::group(['prefix' => 'crash'], function() {
		Route::post('/newBet', 'CrashController@newBet');
		Route::post('/cashout', 'CrashController@Cashout');
	});
	Route::group(['prefix' => 'tower'], function () {
		Route::post('/newGame', 'TowerController@newGame');
		Route::post('/init', 'TowerController@init');
		Route::post('/next', 'TowerController@next');
		Route::post('/claim', 'TowerController@claim');
	});
	Route::post('/jackpot/newBet', 'JackpotController@newBet');
	Route::post('/wheel/newBet', 'WheelController@newBet');
	Route::post('/battle/newBet', 'BattleController@newBet');
	Route::post('/dice/play', 'DiceController@play');
	Route::post('/hilo/newBet', 'HiLoController@newBet');
	Route::group(['prefix' => 'coinflip'], function() {
		Route::post('/newBet', 'CoinFlipController@createRoom');
		Route::post('/joinGame', 'CoinFlipController@joinGame');
	});

	Route::group(['prefix' => 'tower'], function () {
		Route::post('/newGame', 'TowerController@newGame');
		Route::post('/init', 'TowerController@init');
		Route::post('/next', 'TowerController@next');
		Route::post('/claim', 'TowerController@claim');
	});
	Route::group(['prefix' => 'Mines'], function () {
		Route::post('/newGame', 'MinesController@newGame');
		Route::post('/init', 'MinesController@init');
		Route::post('/next', 'MinesController@next');
		Route::post('/claim', 'MinesController@claim');
	});
});

Route::group(['prefix' => '/admin', 'middleware' => 'auth', 'middleware' => 'access:admin'], function () {
	Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
	Route::get('/users', ['as' => 'admin.users', 'uses' => 'AdminController@users']);
	Route::get('/user/{id}', ['as' => 'admin.user', 'uses' => 'AdminController@user']);
	Route::get('/settings', ['as' => 'admin.settings', 'uses' => 'AdminController@settings']);
	Route::get('/bots', ['as' => 'admin.bots', 'uses' => 'AdminController@bots']);
	Route::get('/bots/delete/{id}', 'AdminController@botsDelete');
	Route::get('/tournaments', ['as' => 'admin.tournaments', 'uses' => 'AdminController@tournaments']);
	Route::get('/tournaments/delete/{id}', ['as' => 'admin.tournamentsDelete', 'uses' => 'AdminController@deleteTour']);
	Route::get('/tournaments/send/{id}', ['as' => 'admin.tournamentsSend', 'uses' => 'TournamentController@sendTour']);
	Route::get('/ranks', ['as' => 'admin.ranks', 'uses' => 'AdminController@ranks']);
	Route::get('/styles', ['as' => 'admin.styles', 'uses' => 'AdminController@styles']);
	Route::get('/bonus', ['as' => 'admin.bonus', 'uses' => 'AdminController@bonus']);
	Route::get('/bonus/delete/{id}', 'AdminController@bonusDelete');
	Route::get('/promo', ['as' => 'admin.promo', 'uses' => 'AdminController@promo']);
	Route::get('/promo/delete/{id}', 'AdminController@promoDelete');
	Route::get('/filter', ['as' => 'admin.filter', 'uses' => 'AdminController@filter']);
	Route::get('/filter/delete/{id}', 'AdminController@filterDelete');
	Route::get('/withdraws', ['as' => 'admin.withdraws', 'uses' => 'AdminController@withdraws']);
    Route::get('/withdraw/{id}', 'AdminController@withdrawSend');
    Route::get('/return/{id}', 'AdminController@withdrawReturn');
	Route::get('/giveaway', ['as' => 'admin.giveaway', 'uses' => 'AdminController@giveaway']);
	Route::get('/giveaway/delete/{id}', 'AdminController@giveawayDelete');
	Route::get('/styles/delete/{id}', 'AdminController@deleteStyle');
	Route::get('/ranks/delete/{id}', 'AdminController@deleteRank');

	Route::post('/createTournament', 'AdminController@createTournament');
	Route::post('/createStyle', 'AdminController@createStyle');
	Route::post('/createRank', 'AdminController@createRank');
	Route::post('/setting/save', 'AdminController@settingsSave');
	Route::post('/ban', 'ChatController@ban');
	Route::post('/unban', 'ChatController@unban');
	Route::post('/clear', 'ChatController@clear');
	Route::post('/chatdel', 'ChatController@delete_message');
    Route::post('/user/save', 'AdminController@userSave');
	Route::post('/usersAjax', 'AdminController@usersAjax');
	Route::post('/getVKUser', 'AdminController@getVKUser');
	Route::post('/fakeSave', 'AdminController@fakeSave');
	Route::post('/promo/new', 'AdminController@promoNew');
	Route::post('/promo/save', 'AdminController@promoSave');
	Route::post('/filter/new', 'AdminController@filterNew');
	Route::post('/filter/save', 'AdminController@filterSave');
	Route::post('/bonus/new', 'AdminController@bonusNew');
	Route::post('/bonus/save', 'AdminController@bonusSave');
	Route::post('/giveaway/new', 'AdminController@giveawayNew');
	Route::post('/giveaway/save', 'AdminController@giveawaySave');
	Route::post('/getBanned', 'AdminController@getBanned');
	Route::post('/socket/start', 'AdminController@socketStart');
	Route::post('/socket/stop', 'AdminController@socketStop');
	Route::post('/getUserByMonth', 'AdminController@getUserByMonth');
	Route::post('/getDepsByMonth', 'AdminController@getDepsByMonth');
	Route::post('/getBalanceFK', 'AdminController@getBalanceFK');
	Route::post('/getBalancePE', 'AdminController@getBalancePE');
	Route::post('/chatSend', 'AdminController@add_message');
	Route::post('/gotJackpot', 'JackpotController@gotThis');
	Route::post('/betJackpot', 'JackpotController@adminBet');
	Route::post('/gotWheel', 'WheelController@gotThis');
	Route::post('/betWheel', 'WheelController@adminBet');
	Route::post('/gotCrash', 'CrashController@gotThis');
	Route::post('/betDice', 'DiceController@adminBet');
	Route::post('/gotBattle', 'BattleController@gotThis');
	Route::post('/betBattle', 'BattleController@adminBet');
});

Route::group(['prefix' => '/panel', 'middleware' => 'auth', 'middleware' => 'access:lowadmin'], function () {
	Route::get('/', ['as' => 'panel.promo', 'uses' => 'AdminController@promo_low']);
	Route::get('/promo/delete/{id}', 'AdminController@promoDelete_low');
	Route::get('/filter', ['as' => 'panel.filter', 'uses' => 'AdminController@filter_low']);
	Route::get('/filter/delete/{id}', 'AdminController@filterDelete_low');
	
	Route::post('/promo/new', 'AdminController@promoNew_low');
	Route::post('/promo/save', 'AdminController@promoSave_low');
	Route::post('/filter/new', 'AdminController@filterNew_low');
	Route::post('/filter/save', 'AdminController@filterSave_low');
});

Route::group(['prefix' => '/moder', 'middleware' => 'auth', 'middleware' => 'access:moder'], function () {
	Route::post('/getBanned', 'AdminController@getBanned');
	Route::post('/ban', 'ChatController@ban');
	Route::post('/unban', 'ChatController@unban');
	Route::post('/clear', 'ChatController@clear');
	Route::post('/chatdel', 'ChatController@delete_message');
});

Route::group(['prefix' => '/api', 'middleware' => 'secretKey'], function() {
	Route::group(['prefix' => '/king'], function() {
		Route::post('/slider', 'KingController@getSlider');
		Route::post('/newGame', 'KingController@newGame');
	});
	Route::group(['prefix' => '/jackpot'], function() {
		Route::post('/slider', 'JackpotController@getSlider');
		Route::post('/newGame', 'JackpotController@newGame');
		Route::post('/getGame', 'JackpotController@getGame');
		Route::post('/addBetFake', 'JackpotController@addBetFake');
		Route::post('/getRooms', 'JackpotController@getRooms');
	});
	Route::group(['prefix' => '/wheel'], function() {
		Route::post('/newGame', 'WheelController@newGame');
		Route::post('/slider', 'WheelController@getSlider');
		Route::post('/updateStatus', 'WheelController@updateStatus');
		Route::post('/getGame', 'WheelController@getGame');
		Route::post('/addBetFake', 'WheelController@addBetFake');
	});
	Route::group(['prefix' => '/dice'], function() {
		Route::post('/addBetFake', 'DiceController@addBetFake');
    });
	Route::group(['prefix' => 'crash'], function() {
        Route::post('/init', 'CrashController@init');
		Route::post('/slider', 'CrashController@startSlider');
		Route::post('/newGame', 'CrashController@newGame');
		Route::post('/newBet', 'CrashController@newBet');
		Route::post('/cashout', 'CrashController@Cashout');
    });
	Route::group(['prefix' => '/battle'], function() {
		Route::post('/newGame', 'BattleController@newGame');
		Route::post('/getSlider', 'BattleController@getSlider');
		Route::post('/getStatus', 'BattleController@getStatus');
		Route::post('/setStatus', 'BattleController@setStatus');
		Route::post('/addBetFake', 'BattleController@addBetFake');
    });
    Route::group(['prefix' => '/hilo'], function() {
    	Route::post('/newGame', 'HiLoController@newGame');
		Route::post('/getFlip', 'HiLoController@getFlip');
    	Route::post('/getStatus', 'HiLoController@getStatus');
    	Route::post('/setStatus', 'HiLoController@setStatus');
    });
	Route::group(['prefix' => '/giveaway'], function() {
		Route::post('/get', 'PagesController@getGiveaway');
		Route::post('/end', 'PagesController@endGiveaway');
    });
	Route::group(['prefix' => '/roulette'], function() {
        Route::post('/getGame', 'DoubleController@getGame');
        Route::post('/updateStatus', 'DoubleController@updateStatus');
        Route::post('/getSlider', 'DoubleController@getSlider');
        Route::post('/newGame', 'DoubleController@newGame');
		Route::post('/addBetFake', 'DoubleController@addBetFake');
    });

	Route::post('/unBan', 'ChatController@unBanFromUser');
	Route::post('/getMerchBalance', 'AdminController@getMerchBalance');
    Route::post('/getParam', 'AdminController@getParam');
    Route::post('/getOnline', 'AdminController@getOnline');
});

Route::get('/profile/{id}', ['as' => 'profile', 'uses' => 'ProfileController@index']);