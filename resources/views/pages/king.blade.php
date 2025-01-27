@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/king.css?v={{time()}}">
<script type="text/javascript" src="/js/king.js?v={{time()}}"></script>
<div class="section game-section">
    <div class="container">
        <div class="game">
            <div class="game-sidebar">
                <div class="sidebar-block">
                    <div class="bet-component">
                        <div class="bet-form">
                            <div class="form-row">
                                <label>
                                    <div class="form-label"><span>Bet amount</span></div>
                                    <div class="form-row">
                                        <div class="form-field">
                                            <input type="text" name="sum" class="input-field no-bottom-radius" value="2.00" id="sum" readonly>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <button type="button" class="btn btn-green btn-play" onclick="kingBet()"><span>Place a bet</span></button>
                        </div>
                        <div class="bet-footer">
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#fairModal">
                                <svg class="icon icon-fairness">
                                    <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                </svg><span>Provably Fair</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
			<div class="game-component">
				<div class="game_King" style="">
					<div class="king_progress">
						<span class="king_bank left">{{$bank}} <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span>
						<span class="king_timer right">00:10</span>
					</div>
					<div class="king_avatar" data-rotate="0">
						@if(count($lastBet) >= 1) 
							<img draggable="false" src="{{$lastBet['avatar']}}">
						@endif
					</div>
					<div class="king_bets">
						@if(count($lastBet) >= 1) 
							<img class="currentBet" src="{{$lastBet['avatar']}}">
							@foreach($players as $p)
							<img src="{{$p['avatar']}}">
							@endforeach
						@endif
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
    </div>
</div>
<div class="section footer-accordion">
    <div class="accordion-header">
        <div>How to play KING?</div>
        <svg class="icon icon-close accordion-header__switch accordion-header__switch-close">
            <use xlink:href="/img/symbols.svg#icon-close"></use>
        </svg>
    </div>
    <div class="accordion-content" style="display: none;">
        <p>

        </p>
    </div>
</div>
<div class="section bets-section">
	<div class="container">
		<div class="game-stats">
			<div class="table-heading">
				<div class="thead">
					<div class="tr">
						<div class="th" style="text-align: center;">Player</div>
						<div class="th" style="text-align: center;">Bet</div>
					</div>
				</div>
			</div>
			<div class="table-stats-wrap" style="min-height: 530px; max-height: 100%;">
				<div class="table-wrap" style="transform: translateY(0px);">
					<table class="table">
						<tbody id="kingBets">
							@foreach($bets as $b)
							<tr>
								<td class="username">
									<button type="button" class="btn btn-link" data-id="{{$b['unique_id']}}">
										<span class="sanitize-user">
											<div class="sanitize-avatar"><img src="{{$b['avatar']}}" alt=""></div>
											<span class="sanitize-name">{!! $b['username'] !!}</span>
										</span>
									</button>
								</td>
								<td style="text-align: center;">
									<div class="bet-number">
										<span class="bet-wrap">
											<span>{{$b['bet']}}</span>
											<svg class="icon icon-coin balance">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection