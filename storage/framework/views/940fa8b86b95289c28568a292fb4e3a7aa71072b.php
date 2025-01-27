<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/hilo.css?v=2">
<script type="text/javascript" src="/js/hilo.js"></script>
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
                                    <div class="bet-block btnToggle">
										<div class="hilo-bet">
											<button class="btn-bet bet-high" data-type="1">
												<div class="bet-chance">
													<div class="chance-icon">
														<svg class="icon icon-arrow-up">
															<use xlink:href="/img/symbols.svg#icon-arrow-up"></use>
														</svg>
													</div>
													<div class="chance-text"><span class="probability_hi"><?php echo e($hilo['hi_perc']); ?>%</span></div>
												</div>
												<div class="bet-text factor_hi"><?php echo e($hilo['hi']); ?>x</div>
											</button>
											<button class="btn-bet bet-low" data-type="2">
												<div class="bet-chance">
													<div class="chance-icon">
														<svg class="icon icon-arrow-down">
															<use xlink:href="/img/symbols.svg#icon-arrow-down"></use>
														</svg>
													</div>
													<div class="chance-text"><span class="probability_lo"><?php echo e($hilo['lo_perc']); ?>%</span></div>
												</div>
												<div class="bet-text factor_lo"><?php echo e($hilo['lo']); ?>x</div>
											</button>
										</div>
										<div class="hilo-bet">
											<button class="btn-bet bet-red" data-type="3">
												<div class="bet-chance">
													<div class="chance-text"><span>Red</span></div>
												</div>
												<div class="bet-text">2.00x</div>
											</button>
											<button class="btn-bet bet-black" data-type="4">
												<div class="bet-chance">
													<div class="chance-text"><span>Black</span></div>
												</div>
												<div class="bet-text">2.00x</div>
											</button>
										</div>
										<div class="hilo-bet">
											<button class="btn-bet bet-numb" data-type="5">
												<div class="bet-chance">
													<div class="chance-text"><span>2 - 9</span></div>
												</div>
												<div class="bet-text">1.50x</div>
											</button>
											<button class="btn-bet bet-letr" data-type="6">
												<div class="bet-chance">
													<div class="chance-text"><span>J Q K A</span></div>
												</div>
												<div class="bet-text">3.00x</div>
											</button>
										</div>
										<div class="hilo-bet">
											<button class="btn-bet bet-ka" data-type="7">
												<div class="bet-chance">
													<div class="chance-text"><span>K A</span></div>
												</div>
												<div class="bet-text">6.00x</div>
											</button>
											<button class="btn-bet bet-a" data-type="8">
												<div class="bet-chance">
													<div class="chance-text"><span>A</span></div>
												</div>
												<div class="bet-text">12.00x</div>
											</button>
										</div>
										<div class="hilo-bet">
											<button class="btn-bet bet-j" data-type="9">
												<div class="bet-chance">
													<div class="chance-text"><span>JOKER</span></div>
												</div>
												<div class="bet-text">24.00x</div>
											</button>
										</div>
                                    </div>
                                </label>
                            </div>
                            <button type="button" class="btn btn-green btn-play"><span>Place a bet</span></button>
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
				<div class="game-block">
					<div class="hilo-history">
						<?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="hilo-history-card hilo-card hilo-card_sm hilo-card_<?php echo e($item->card_section); ?> checkGame" data-hash="<?php echo e($item->hash); ?>">
							<div class="hilo-card-num">
								<?php echo e($item->card_name); ?>

							</div>
							<div class="hilo-history-feed">
								<?php if(!is_null($item->card_sign)): ?>
								<img src="/img/hilo-card-<?php echo e(($item->card_sign == 'lo') ? 'arrow' : ($item->card_sign == 'hi') ? 'arrow' : 'eq'); ?>.png" class="hilo-history-feed-sign hilo-history-feed__comparison-sign_<?php echo e(($item->card_sign == 'lo') ? 'lo' : (($item->card_sign == 'hi') ? 'hi' : 'eq')); ?>">
								<?php endif; ?>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="game-area__wrap">
						<div class="game-area">
							<div class="progress-wrap">
								<div class="progress-item left">
									<div class="title">Min. amount: <span id="minBet"><?php echo e($settings->hilo_min_bet); ?></span> <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
									<div class="title">Max. amount: <span id="maxBet"><?php echo e($settings->hilo_max_bet); ?></span> <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>
								</div>
								<div class="progress-item right">
									<div class="title">Game #<span id="gameId"><?php echo e($game->id); ?></span></div>
								</div>
							</div>
							<div class="game-area-content">
								<div class="hilo-main">
									<div class="hilo-deck">
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-deck-card placeholder-card"><div class="card-back"></div></div>
										<div class="hilo-card-region">
											<div class="hilo-deck-card">
												<div class="hilo-flipper" style="transform: rotateY(180deg) scale(1);">
													<div class="card-back"></div>
													<?php if($lastCard): ?>
													<div class="card-front hilo-card hilo-card_<?php echo e($lastCard->card_section); ?> hilo-card_bordered">
														<div class="hilo-label hilo-label_top">
															<div class="hilo-sign"><?php echo e($lastCard->card_name); ?></div>
														</div>
														<div class="hilo-countdown-wrapper">
															<div class="hilo-countdown">
																<svg style="display: block; width: 100%;" viewbox="0 0 100 100">
																	<path id="timer_back" d="M 50,50 m 0,-48.5 a 48.5,48.5 0 1 1 0,97 a 48.5,48.5 0 1 1 0,-97" fill-opacity="0" stroke="<?php echo e(($lastCard->card_section == 'red') ? 'rgba(251, 15, 66, 0.4)' : (($lastCard->card_section == 'joker') ? 'rgba(255, 255, 255, 0.4)' : 'rgba(0, 0, 0, 0.4)')); ?>" stroke-width="3"></path>
																	<path id="timer" d="M 50,50 m 0,-48.5 a 48.5,48.5 0 1 1 0,97 a 48.5,48.5 0 1 1 0,-97" fill-opacity="0" stroke="<?php echo e(($lastCard->card_section == 'red') ? '#fb0f42' : (($lastCard->card_section == 'joker') ? '#ffffff' : '#000000')); ?>" stroke-width="3" style="stroke-dasharray: 304.844, 304.844; stroke-dashoffset: 304.844;"></path>
																</svg>
															</div>
														</div>
														<div class="hilo-label hilo-label_bottom">
															<div class="hilo-sign"><?php echo e($lastCard->card_name); ?></div>
														</div>
													</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hilo-statistics-region">
									<div class="hilo-statistics">
										<div class="hilo-statistics-top">
											<div class="hilo-stat_title">
											Statistics for 20 rounds
											</div>
											<div class="hilo-statistics-colors-ratio">
												<div class="ratio__red" style="width: <?php echo e($stat['red_perc']); ?>%;">
													<?php echo e($stat['red_perc']); ?>%
												</div>
												<div class="ratio__black" style="width: <?php echo e($stat['black_perc']); ?>%;">
													<?php echo e($stat['black_perc']); ?>%
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hash">
									<span class="title">HASH:</span> <span class="text" id="hash"><?php echo e($game->hash); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hilo-footer">
					<div class="hilo-statistics__cards">
						<div class="card_stat_2">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">2</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['two']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['two']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_3">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">3</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['three']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['three']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_4">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">4</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['four']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['four']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_5">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">5</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['five']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['five']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_6">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">6</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['six']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['six']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_7">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">7</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['seven']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['seven']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_8">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">8</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['eight']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['eight']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_9">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">9</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['nine']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['nine']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_J">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">J</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['J']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['J']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_Q">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">Q</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['Q']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['Q']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_K">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">K</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['K']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['K']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_A">
							<div class="hilo-card hilo-card_sm hilo-card_spades">
								<div class="hilo-card__sign">A</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['A']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['A']['count']); ?></span>x
							</div>
						</div>
						<div class="card_stat_JOKER">
							<div class="hilo-card hilo-card_sm hilo-card_joker">
								<div class="hilo-card__sign">🃏</div>
								<div class="hilo-statistics__card-frequency-progress" style="height: <?php echo e($stat['cards']['JOKER']['perc']); ?>%;"></div>
							</div>
							<div class="hilo-statistics__card-label">
								<span><?php echo e($stat['cards']['JOKER']['count']); ?></span>x
							</div>
						</div>
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
        <div>How to play HILO?</div>
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
						<div class="th">Player</div>
						<div class="th">Bet</div>
						<div class="th">Type</div>
						<div class="th">Rate</div>
						<div class="th">Winning</div>
					</div>
				</div>
			</div>
			<div class="table-stats-wrap" style="min-height: 530px; max-height: 100%;">
				<div class="table-wrap" style="transform: translateY(0px);">
					<table class="table">
						<tbody id="bets">
							<?php if($bets): ?> <?php $__currentLoopData = $bets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="username">
									<button type="button" class="btn btn-link" data-id="<?php echo e($bet['unique_id']); ?>">
										<span class="sanitize-user">
											<div class="sanitize-avatar"><img src="<?php echo e($bet['avatar']); ?>" alt=""></div>
											<span class="sanitize-name"><?php echo $bet['username']; ?></span>
										</span>
									</button>
								</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span><?php echo e($bet['sum']); ?></span>
											<svg class="icon icon-coin <?php echo e($bet['balance']); ?>">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
								<td><?php echo e($bet['type']); ?></td>
								<td><?php echo e($bet['multipler']); ?>x</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span><?php echo e($bet['win']); ?></span>
											<svg class="icon icon-coin <?php echo e($bet['balance']); ?>">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/hilo.blade.php */ ?>