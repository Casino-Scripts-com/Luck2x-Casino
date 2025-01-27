@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/mines.css?v={{time()}}">
<script src="/js/mines.js?v={{time()}}"></script>
<div class="section game-section">
    <div class="container">
<div class="game mines-prefix">
                <h1 class="sr--only">Mines</h1>
                <div class="game-sidebar">
                    <div class="sidebar-block hasTabs">
                        <div class="bet-component">
                            <div class="bet-form">
                                <div class="form-row">
                                  <label>
                                    <div class="form-label">
                                      <span>Bet amount</span>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-field">
                                        <input type="text" name="sum" class="input-field no-bottom-radius" value="0.00" id="sum">
                                        <button type="button" class="btn btn-bet-clear" data-action="clear">
                                          <svg class="icon icon-close">
                                            <use xlink:href="/img/symbols.svg#icon-close"></use>
                                          </svg>
                                        </button>
                                        <div class="buttons-group no-top-radius">
                                          <button type="button" class="btn btn-action" data-action="plus" data-value="0.10">+0.10</button>
                                          <button type="button" class="btn btn-action" data-action="plus" data-value="0.50">+0.50</button>
                                          <button type="button" class="btn btn-action" data-action="plus" data-value="1">+1.00</button>
                                          <button type="button" class="btn btn-action" data-action="multiply" data-value="2">2X</button>
                                          <button type="button" class="btn btn-action" data-action="divide" data-value="2">1/2</button>
                                          <button type="button" class="btn btn-action" data-action="all">MAX</button>
                                        </div>
                                      </div>
                                    </div>
                                  </label>
                                </div>
                                <div class="form-row bomb_buttons">
                                    <div class="form-label">Number of Mines</div>
                                    <div class="form-field">
                                        <div class="buttons-group buttons-group--tall">
                                            <button type="button" value="3" class="btn btn-action" data-select="3" style="transition: 0s;">3</button>
                                            <button type="button" value="5" class="btn btn-action isActive" data-select="5" style="transition: 0s;">5</button>
                                            <button type="button" value="10" class="btn btn-action" data-select="10" style="transition: 0s;">10</button>
                                            <button type="button" value="24" class="btn btn-action" data-select="24" style="transition: 0s;">24</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-green btn-play start-mines-btn" id="startMines">Play
                                </button>
                                <button type="button" class="btn btn-green btn-play" id="finishMines" style="display:none;">Cash out <span id="win"></span></button>
	
                            </div>
                            <div class="bet-footer">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#fairModal">
                                    <svg class="icon icon-fairness">
                                        <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                    </svg>
                                    <span>Provably Fair</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="game-component">
                    <div class="game-block">
                        <div class="game-area__wrap">
                            <div class="game-area">
                                <div class="game-area-content">
                                    <div class="mines__component">
                                        <div class="mines__wrapper">
                                            @for($i=1;$i<=25;$i++)
                                            <button type="button" class="mines__btn" data-number="{{$i}}">
                                                <span class="mines_appear"></span>
                                            </button>
                                            @endfor
                                        </div>
                                        <div class="progress__wrapper">
                                            <div class="progress__item progress__left">
                                                <div class="progress__img">
                                                    <img src="/static/media/gem.svg" alt="" draggable="false"></div>
                                                    <span class="progress__number">20</span>
                                            </div>
                                            <div class="progress__item progress__right">
                                                <div class="progress__img progress__bomb">
                                                    <img src="/static/media/bomb.png" alt="" draggable="false"></div>
                                                    <span class="progress__number">5</span>
                                            </div>
                                        </div>
                                    </div>
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
                    <div class="hits__area">
                      <div id="courosel_koeff" class="carousel slide" data-ride="carousel" data-interval="0">
                        <div class="carousel-inner">
                        </div>
                        <a class="carousel-control-prev" href="#courosel_koeff" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only"></span>
                        </a>
                        <a class="carousel-control-next" href="#courosel_koeff" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only"></span>
                        </a>
                      </div>
                    </div>
                    <div class="game-history__wrap mines__multi" style="display: none;">
                      <div class="mines-picker"></div>
                      <div class="game-history" style="justify-content: center;"></div>
                    </div>
				</div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        renderCoefs(5);
                        renderMines()
                    })
                </script>
            </div>
    </div>
</div>
<div class="section footer-accordion">
    <div class="accordion-header">
        <div>How to play MINES?</div>
        <svg class="icon icon-close accordion-header__switch accordion-header__switch-close">
            <use xlink:href="/img/symbols.svg#icon-close"></use>
        </svg>
    </div>
    <div class="accordion-content" style="display: none;">
        <p> 
        Mines - New game for real money
A virtual version of a well-known game. The client of the Up-Money project sets the bet amount and chooses the number of minutes (ranging from 2 to 24). The goal of the player: to pass the minefield and not to blow up on it. The payout increases after the successful completion of a move. A move can be cancelled at any time and the prize money received. The losing miner loses the money and forfeits his vote.        </p>
    </div>
</div>
<div class="section bets-section">
	<div class="container">
		<div class="game-stats" style="text-align: center;">
			<div class="table-heading">
				<div class="thead">
					<div class="tr">
						<div class="th">Player</div>
						<div class="th">Bet</div>
						<div class="th">Bombs</div>
						<div class="th">Ratio</div>
						<div class="th">Winning</div>
					</div>
				</div>
			</div>
			<div class="table-stats-wrap" style="min-height: 530px; max-height: 100%;">
				<div class="table-wrap">
					<table class="table">
						<tbody>
							@foreach($game as $g)
							<tr>
								<td class="username">
									<button type="button" class="btn btn-link" data-id="{{$g['unique_id']}}">
										<span class="sanitize-user">
											<div class="sanitize-avatar"><img src="{{$g['avatar']}}" alt=""></div>
											<span class="sanitize-name">{!! $g['username'] !!}</span>
										</span>
									</button>
								</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span>{{$g['sum']}}</span>
											<svg class="icon icon-coin balance">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
								<td>{{$g['bombs']}}</td>
                <td>{{$g['coef']}}x</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span class="{{ $g['win_sum'] > 0 ? 'win' : 'lose' }}">{{ $g['win_sum'] }}</span>
											<svg class="icon icon-coin">
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