<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/jackpot.css?v=2">
<script type="text/javascript" src="/js/chart.min.js?v=<?php echo e(time()); ?>"></script>
<script type="text/javascript" src="/js/chartjs-plugin-labels.js?v=<?php echo e(time()); ?>"></script>
<script type="text/javascript" src="/js/jquery.kinetic.min.js?v=<?php echo e(time()); ?>"></script>
<script type="text/javascript" src="/js/jackpot.js?v=<?php echo e(time()); ?>"></script>
<div class="section game-section">
    <div class="container">
        <div class="game jackpot-prefix">
            <div class="game-sidebar">
                <div class="sidebar-block">
                    <div class="bet-component">
                        <div class="bet-form">
                            <div class="form-row">
                                <label>
                                    <div class="form-label"><span>Bet amount</span></div>
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
                                            <div class="input-validation top"><span>Not enough coins</span></div>
                                        </div>
                                    </div>
                                </label>
                            </div>
							<div class="button-group__wrap">
								<div class="button-group__content rooms">
									<?php $__currentLoopData = $rooms->sortBy('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a class="btn <?php echo e($r->name); ?>" data-room="<?php echo e($r->name); ?>"><span><?php echo e($r->title); ?></span></a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<span class="button-group-label"><span>Rooms</span></span>
							</div>
                            <button type="button" class="btn btn-green btn-play"><span>Place a bet</span></button>
                        </div>
                        <div class="bet-footer">
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#fairModal">
                                <svg class="icon icon-fairness">
                                    <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                                </svg><span>Provably Fair</span>
                            </button>
                            <a class="btn btn-light" href="/jackpot/history">
                                <svg class="icon icon-history">
                                    <use xlink:href="/img/symbols.svg#icon-history"></use>
                                </svg><span>Game History</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="game-component">
				<div class="game-block">
					<div class="progress-wrap">
						<div class="progress-item left">
							<div class="title">Min. amount: <span id="minBet">0</span> <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
							<div class="title">Max. amount: <span id="maxBet">0</span> <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
						</div>
						<div class="progress-item right">
							<div class="title">Game #<span id="gameId">0</span></div>
						</div>
					</div>
					<div class="game-area__wrap">
						<div class="game-area">
							<div class="game-area-content">
								<div class="circle">
									<div class="fix-circle">
										<canvas id="circle" class="circle_jackpot"></canvas>
									</div>
									<div class="time">
										<div class="spinner" style="transform: rotate(0deg);">
											<svg class="icon"><use xlink:href="/img/symbols.svg?v=1#icon-pointer"></use></svg>
										</div>
										<div class="block">
											<div class="title">Game Bank</div>
											<div class="value" id="value">???</div>
											<div class="line"></div>
											<div class="title">Till the start</div>
											<div class="value" id="timer">00:00</div>
										</div>
									</div>
								</div>
								<div class="hash">
									<span class="title">HASH:</span> <span class="text" id="hash">???</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="jackpot-hits">
					<div class="carousel slide" id="carousel">
						<button type="button" class="btn btn-prev">
							<svg class="icon icon-left">
								<use xlink:href="/img/symbols.svg#icon-left"></use>
							</svg>
						</button>
						<div class="carousel-inner chances">
							<div class="carousel-item active" id="chances">
							</div>
						</div>
						<button type="button" class="btn btn-next">
							<svg class="icon icon-left">
								<use xlink:href="/img/symbols.svg#icon-left"></use>
							</svg>
						</button>
					</div>
				</div>
				<?php if(auth()->guard()->guest()): ?>
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
				<?php endif; ?>
			</div>
        </div>
    </div>
</div>
<div class="section footer-accordion">
    <div class="accordion-header">
        <div>How to playJACKPOT?</div>
        <svg class="icon icon-close accordion-header__switch accordion-header__switch-close">
            <use xlink:href="/img/symbols.svg#icon-close"></use>
        </svg>
    </div>
    <div class="accordion-content" style="display: none;">
        <p>
		Jackpot by Luck2x where the user competes with others to win. There are three rooms for games: Easy, Medium, Hard. They differ from each other in the size of bets. The higher the bet amount - the more lottery tickets and chances for luck. The number of players in the room should not exceed 10 people, each user has the same number of bets. The winning ticket is determined as a result of the draw.        </p>
    </div>
</div>

<div class="section bets-section">
	<div class="container">
		<div class="game-stats">
			<div class="table-heading">
				<div class="thead">
					<div class="tr">
						<div class="th">Player</div>
						<div class="th">Bet</div>
						<div class="th">Percentage</div>
						<div class="th">Tickets</div>
					</div>
				</div>
			</div>
			<div class="table-stats-wrap" style="min-height: 530px; max-height: 100%;">
				<div class="table-wrap" style="transform: translateY(0px);">
					<table class="table">
						<tbody id="bets">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/jackpot.blade.php */ ?>