@extends('layout')

@section('content')
<script src="/js/roulette.js?v={{time()}}"></script>
<style>
    .double-loop {
    font-weight: 700;
    max-width: 800px;
    margin: 0 auto;
    padding-bottom: 0;
    width: 100%;
    padding: 0px;
    overflow: hidden;
}

.double {
    width: 361px;
    height: 361px;
    position: relative;
    margin: 0 auto;
}

@media(max-width: 600px) {
    .double {
        width: 285px;
        height: 285px;
    }
}

.hash {
    position: relative;
    margin: 15px auto;
    color: #bbbbc3;
    text-align: center;
}

.double.active .double-row {
    transform: rotate(3500deg);
}

.double-win {
    position: absolute;
    left: 50%;
    margin-left: -15px;
    top: 0;
    z-index: 2;
    width: 34px;
    height: 56px;
    transform: rotate(-90deg);
}

.double-win img {
    width: 100%;
    height: auto;
}

.double-row {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    transition: 13s;
}

.double-row img {
    width: 100%;
    height: auto;
}

.double-rel {
    width: 168px;
    height: 168px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -84px;
    margin-left: -84px;
    border-radius: 50%;
    box-sizing: border-box;
    background: transparent;
    z-index: 4;
    color: #fff;
    line-height: 168px;
    text-align: center;
    font-size: 60px;
}

.double-timer {
    background: url(/img/double-timer.png) no-repeat center 10px;
    width: 168px;
    height: 168px;
    position: absolute;
    z-index: 3;
    top: 50%;
    left: 50%;
    margin-top: -84px;
    margin-left: -84px;
    border-radius: 50%;
    text-align: center;
    border: 3px solid #1e2224;
    box-sizing: border-box;
    line-height: 38px;
    color: #fff;
}

.double-time {
    font-size: 60px;
    font-weight: bold;
    color: #ffb432;
    margin: 73px 0 0 0;
}

.double-right {
    margin: 0 auto;
}

.double-last {
    overflow: hidden;
    margin: 16px 0;
    background: #03103b;
    padding: 10px;
    white-space: nowrap;
    border-radius: 50px;
    position: relative;
    box-shadow: 0 0 13px rgba(0, 0, 0, 0.16);
    border-radius: 25px;
}

.double-last:after {
    content: '';
    background: linear-gradient(to right, transparent, #21203a);
    position: absolute;
    top: 0;
    right: 0;
    width: 180px;
    height: 100%;
}

.double-last form {
    display: inline-block;
}

.double-last-i.black {
    background: url(/img/black.png) no-repeat 0 0;
}

.double-last-i.red {
    background: url(/img/red.png) no-repeat 0 0;
}

.double-last-i.green {
    background: url(/img/green.png) no-repeat 0 0;
}

.double-last-i:nth-child(1) {
    margin: 0;
}

.double-last-i {
    width: 41px;
    height: 41px;
    line-height: 42px;
    text-align: center;
    color: #fff;
    font-size: 15px;
    margin: 0 0 0 7px;
    display: inline-block;
    border: 0;
    cursor: pointer;
}

.double-button {
    text-align: center;
}

.double-button a:after {
    width: 29px;
    height: 29px;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
    position: absolute;
    top: 7px;
    right: 4px;
    transition: .5s;
}

.double-button a:last-child {
    margin: 0;
}

.double-button a:hover:after {
    transform: rotate(360deg);
}

.double-button a {
    width: 233px;
    height: 47px;
    line-height: 46px;
    display: inline-block;
    border-radius: 8px;
    position: relative;
    margin: -1px -1px 0px 0;
    box-sizing: border-box;
    padding: 0px 15px 0 0;
    text-align: center;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
}

.double-button-1 {
    border: 1px solid #eb3636;
    background: #fb3838;
}

.double-button-1:hover {
    box-shadow: 0 0 10px rgba(251,56,56, 0.4), inset 0 0 6px rgba(251,56,56, 0.25);
}

.double-button-1:after {
    background: #c13636;
    content: 'x2';
    box-shadow: 0 0 12px rgba(251,56,56, 0.6);
}

.double-button-2 {
    border: 1px solid #249b42;
    background: #4CAF50;
}

.double-button-2:hover {
    box-shadow: 0 0 10px rgba(36,155,66, 0.4), inset 0 0 6px rgba(36,155,66, 0.25);
}

.double-button-2:after {
    background: #249b42;
    content: 'x14';
    box-shadow: 0 0 12px rgba(36,155,66, 0.6);
}

.double-button-3 {
    border: 1px solid #313336;
    background: #494b4e;
}

.double-button-3:hover {
    box-shadow: 0 0 10px rgba(49,51,54, 0.4), inset 0 0 6px rgba(49,51,54, 0.25);
}

.double-button-3:after {
    background: #313336;
    content: 'x2';
    box-shadow: 0 0 12px rgba(49,51,54, 0.6);
}

.rates-full {
    margin: 15px 0 0 0;
    text-align: center;
    position: relative;
}

.rates-loop:after {
    width: 334px;
    height: 70px;
    position: absolute;
    top: -13px;
    left: -11px;
    content: '';
}

.rates-loop:nth-child(3) {
    margin: 0;
}

.rates-loop {
    width: 233px;
    background: #03103b;
    border-radius: 10px;
    position: relative;
    padding: 0 0 10px 0;
    margin: 0 5px 0 0;
    display: inline-grid;
    overflow: hidden;
    box-shadow: 0 0 13px rgba(0, 0, 0, 0.16);
}

.rates-top {
    background: #0d183c;
    height: 40px;
    line-height: 40px;
    border-bottom: 1px solid #182242;
    margin: 0 0 7px 0;
    box-shadow: 0 0 13px rgba(0, 0, 0, 0.16);
}

.rates-top div {
    position: relative;
    z-index: 3;
    color: #bbbbc3;
    font-size: 12px;
}

.rates-loop .rates-top span {
    color: #bbbbc3;
}

.rates-i:last-child {
    border: 0;
}

.rates-i {
    overflow: hidden;
    border-bottom: 1px solid #293857;
    padding: 5px;
}

.rates-ava {
    width: 40px;
    height: 40px;
    position: absolute;
    margin: 0 10px 0 0;
}

.rates-ava img {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: 0;
}

.rates-login {
    float: left;
    font-size: 12px;
    color: #ffb432;
    line-height: 40px;
    margin-left: 45px;
    text-align: left;
}

.rates-login b {
    display: block;
    color: #bbbbc3;
    font-size: 13px;
    overflow: hidden;
    width: 120px;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.rates-loop:nth-child(1) .rates-rub {
    border: 1px solid #ee3737;
}

.rates-loop:nth-child(2) .rates-rub {
    border: 1px solid #249541;
}

.rates-loop:nth-child(3) .rates-rub {
    border: 1px solid #313336;
}

.rates-rub {
    float: right;
    width: 58px;
    height: 28px;
    text-align: center;
    border-radius: 20px;
    margin: 6px 0 0 0;
    color: #bbbbc3;
    font-size: 14px;
    line-height: 26px;
}

.double-history {
    text-align: center;
    background: #21203a;
    box-shadow: 0 0 13px rgba(0, 0, 0, 0.16);
    border-radius: 25px;
    padding: 15px;
}

.double-history li {
    width: 200px;
    display: inline-block;
    margin: 10px;
    background: rgba(255, 255, 255, 0.01);
    border-radius: 15px;
    padding: 15px;
    transition: .5s linear;
}

.double-history li:hover {
    background: rgba(255, 255, 255, 0.05);
}

.double-history li .game {
    color: #bbbbc3;
    font-size: 15px;
}

.double-history li .number {
    margin: 15px auto;
    width: 80px;
    height: 80px;
    line-height: 80px;
    border-radius: 100%;
    font-size: 28px;
    color: #fff;
}

.double-history li .check-random {
    padding: 0 20px;
}

.double-history li .check-random .btn {
    padding: 10px 10px;
    background: linear-gradient(160deg, #058aff, #a60cff);
    border-radius: 50px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 700;
    transition: .2s linear;
    cursor: pointer;
    border: 0;
}

.double-history li .check-random .btn:hover {
    text-decoration: none;
    -webkit-box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
    -moz-box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
    box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
}

@media(max-width: 1280px) {
    .bet-input .value {
        width: 100%;
        display: block;
        margin-bottom: 10px !important;
    }

    .bet-input .upper a {
        display: inline-block;
    }

    .double-button a {
        width: 200px;
    }

    .rates-loop {
        width: 233px;
    }
}

.bet-input .value, .bet-input .autoout {
        display: block;
        width: 100%;
    }
    .bet-input .upper a {
        display: inline-block;
        margin: 5px;
    }
    .bet-input .makeBet {
        display: block;
    }

    @media (max-width: 1344px) {
    .bet-input-value-double {
        margin-bottom: 30px;
    }
}

.bet-input {
    position: relative;
    text-align: center;
    margin: 10px 0;
}

.bet-input .value {
    display: inline-block;
    width: 180px;
    position: relative;
}

.bet-input .value input, .bet-input .autoout input {
    background: #293857;
    line-height: 45px;
    border-radius: 50px;
    text-align: center;
    color: #bbbbc3;
    font-size: 22px;
    width: 100%;
    border: double 2px transparent;
    background-image: linear-gradient(#21203a, #2b2a48), linear-gradient(160deg, #03103b, #0e1f58);
    background-origin: border-box;
    background-clip: content-box, border-box;
}

.bet-input .value i {
    position: absolute;
    right: 15px;
    top: 0;
    margin: 12px 0;
    padding: 4px;
    font-size: 18px;
}

.bet-input .autoout {
    display: inline-block;
    width: 180px;
    position: relative;
}

.bet-input .autoout input {
    background: #293857;
    line-height: 45px;
    border-radius: 50px;
    text-align: center;
    color: #bbbbc3;
    font-size: 22px;
    width: 100%;
    border: double 2px transparent;
    background-image: linear-gradient(#21203a, #2b2a48), linear-gradient(160deg, #058AFF, #a60cff);
    background-origin: border-box;
    background-clip: content-box, border-box;
}

.bet-input .autoout i {
    position: absolute;
    right: 15px;
    top: 0;
    margin: 12px 0;
    padding: 4px;
    font-size: 18px;
}

.bet-input .upper {
    display: inline-block;
}

.bet-input .upper a {
    padding: 15px;
    background: #21203a;
    border-radius: 10px;
    cursor: pointer;
    transition: .2s linear;
    border: 1px solid #2b2a48;
}

.bet-input .upper a:hover {
    background: #272a4f;
    border: 1px solid #7a6cf3;
}

.bet-input .upper i {
    display: contents;
}

.bet-input .makeBet {
    padding: 15px 20px;
    background: linear-gradient(160deg, #058AFF, #a60cff);
    border-radius: 50px;
    color: #fff;
    text-transform: uppercase;
    font-size: 15px;
    font-weight: 700;
    transition: .2s linear;
    cursor: pointer;
    height: 100%;
}

.bet-input .makeBet:hover {
    text-decoration: none;
    -webkit-box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
    -moz-box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
    box-shadow: 0px 0px 40px 0px rgba(122, 108, 243, 0.75);
}

.second-title {
    color: #bbbbc3;
    text-align: center;
    font-size: 24px;
    padding: 15px 0;
}

@media(max-width: 1037px) {
    .double-button a:last-child {
        margin: 0 0px 0 0;
    }

    .rates-loop:nth-child(3) {
        margin: 0 6px 0 0;
    }
}

@media (max-width: 1370px) {
    .rates-loop {
        margin-bottom: 15px;
    }
}

@media (max-width: 1370px) {
    .double-button a {
        margin-bottom: 15px;
    }
}

@media screen and (max-width: 999px)
.wrapper .main-content .main-content-footer, .wrapper .main-content .sections {
    padding-left: 0px;
    padding-right: 0px;
    }
}
</style>


				

							

<div class="sections game-sections">										
    <div class="double-loop">
<div class="game-block">
        <div class="double">
            <div class="double-timer">
                <div class="double-time is-countdown" id="timer3">
                    <span class="countdown-row countdown-show1">
                        <span class="countdown-section">
                            <span class="countdown-amount" id="rez-numbr">{{$settings->roulette_timer}}</span>
                            <span class="countdown-period"></span>
                        </span>
                    </span>
                </div> 
                <span class="double-text">Left</span>
            </div>
            <div class="double-rel" style="background: none; display: none;"></div>
            <div class="double-win"><img src="/img/double-win.png" alt=""></div>
            <div class="double-row" id="reletteact" style="transform: rotate({{ $rotate }}deg); transition: -webkit-transform 10000ms cubic-bezier(0.32, 0.64, 0.45, 1);"><img src="/img/double-row.png" alt=""></div>
            @if($game->status == 2)
            <script>
                setTimeout(() => {
                    $('#reletteact').css({
                        'transition' : 'transform {{ $time }}s ease',
                        'transform' : 'rotate({{ $rotate2 }}deg)'
                    });
                }, 1);
                setTimeout(() => {
                    $('#rez-numbr').text('{{ $game->winner_num }}');
                }, parseInt('{{ $time }}')*1000);
            </script>
            @endif
        </div>
        <div class="hash">HASH: <span id="hash">{{$game->hash}}</span></div>
        <div class="double-last">
        @foreach($history as $l)
            <a class="double-last-i {{ $l->winner_color }}">{{ $l->winner_num }}</a>
        @endforeach
        </div>
        @auth
        <div class="double-right">
            <div class="bet-input">
                <div class="value">
                    <input type="text" id="sum" value="1.00">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="upper">
                    <a class="btn-act" data-value="1" data-action="plus">+1</a>
                    <a class="btn-act" data-value="10" data-action="plus">+10</a>
                    <a class="btn-act" data-value="100" data-action="plus">+100</a>
                    <a class="btn-act" data-value="1000" data-action="plus">+1000</a>
                    <a class="btn-act" data-value="2" data-action="divide">1/2</a>
                    <a class="btn-act" data-value="2" data-action="multiply">x2</a>
                    <a class="btn-act" data-action="all">MAX</a>
                </div>
            </div>
            <div class="second-title"><span>place a bet:</span></div>
            <div class="double-button">
                <a class="double-button-1 betButton" data-bet-type="red"><b class="bet-amount">Bet on Red</b></a>
                <a class="double-button-2 betButton" data-bet-type="green"><b class="bet-amount">Bet on Green</b></a>
                <a class="double-button-3 betButton" data-bet-type="black"><b class="bet-amount">Bet on Black</b></a>
            </div>
        </div>
        @endauth
        <div class="rates-full">
            <div class="rates-loop" data-type="red">
                <div class="rates-top"><div>TOTAL BET: <span class="bet" id="bank_red">{{ (isset($prices['red'])) ? $prices['red'] : 0 }}</span></div></div>
                <div class="rates-content_red bets">
                @foreach($bets as $bet) @if($bet->type == 'red')
                    <div class="rates-i" data-userid="{{ $bet->user_id }}">
                        <div class="rates-ava">
                            <img src="{{ $bet->avatar }}">
                        </div>
                        <div class="hidden">
                            <div class="rates-login"><b class="ell">{{ $bet->username }}</b></div>
                            <div class="rates-rub">{{ $bet->value }}</div>
                        </div>
                    </div>
                @endif @endforeach
                </div>
            </div>
            <div class="rates-loop" data-type="green">
                <div class="rates-top"><div>TOTAL BET: <span class="bet" id="bank_green">{{ (isset($prices['green'])) ? $prices['green'] : 0 }}</span></div></div>
                <div class="rates-content_green bets">
                @foreach($bets as $bet) @if($bet->type == 'green')
                    <div class="rates-i" data-userid="{{ $bet->user_id }}">
                        <div class="rates-ava">
                            <img src="{{ $bet->avatar }}">
                        </div>
                        <div class="hidden">
                            <div class="rates-login"><b class="ell">{{ $bet->username }}</b></div>
                            <div class="rates-rub">{{ $bet->value }}</div>
                        </div>
                    </div>
                @endif @endforeach
                </div>
            </div>
            <div class="rates-loop" data-type="black">
                <div class="rates-top"><div>TOTAL BET: <span class="bet" id="bank_black">{{ (isset($prices['black'])) ? $prices['black'] : 0 }}</span></div></div>
                <div class="rates-content_black bets">
                @foreach($bets as $bet) @if($bet->type == 'black')
                    <div class="rates-i" data-userid="{{ $bet->user_id }}">
                        <div class="rates-ava">
                            <img src="{{ $bet->avatar }}">
                        </div>
                        <div class="hidden">
                            <div class="rates-login"><b class="ell">{{ $bet->username }}</b></div>
                            <div class="rates-rub">{{ $bet->value }}</div>
                        </div>
                    </div>
                @endif @endforeach
                </div>
            </div>
        </div>
    </div>
    @guest
				<div class="game-sign">
					<div class="game-sign-wrap">
						<div class="game-sign-block auth-buttons">
						You must be logged in to play 
							<a data-toggle="modal" data-target="#authModal" class="btn">
							Login
							</a>
						</div>
					</div>
				</div>
				@endguest
</div>
  </div>



@endsection