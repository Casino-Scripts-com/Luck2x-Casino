

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/dice.css?v=1">
<script type="text/javascript" src="/js/dice.js?v=1"></script>
<div class="section game-section">
    <div class="container">
        <div class="game">
			<div class="game-component">
				<div class="game-block">
					<div class="game-area__wrap">
						<div class="game-area">
							
							
							<div class="bottom-corners"></div>
							<div class="game-area-content">
								<div class="dice">
									<div class="game-bar">

										<div class="bet-component">
											<div class="bet-form">
												<div class="">
													<div class="two-cols">
														<div class="form-row">
															<label>
																<div class="form-label"><span>Bet amount</span></div>
																<div class="form-row">
																	<div class="form-field">
																		<input type="number" name="sum" class="input-field no-bottom-radius" inputmode="numeric" autocomplete="off" value="" placeholder="0.00" id="sum">
																		<button type="button" class="btn btn-bet-clear" data-action="clear">
																			<svg class="icon icon-close">
																				<use xlink:href="/img/symbols.svg#icon-close"></use>
																			</svg>
																		</button>
																		<div class="buttons-group no-top-radius">
																			<button type="button" class="btn btn-action" data-action="plus" data-value="1">+1</button>
																			<button type="button" class="btn btn-action" data-action="plus" data-value="5">+5</button>
																			<button type="button" class="btn btn-action" data-action="plus" data-value="10">+10</button>
																			<button type="button" class="btn btn-action" data-action="multiply" data-value="2">2X</button>
																			<button type="button" class="btn btn-action" data-action="divide" data-value="2">1/2</button>
																			<button type="button" class="btn btn-action" data-action="all">MAX</button>
																		</div>
																	</div>
																</div>
															</label>
														</div>
														<div class="form-row">
															<label>
																<div class="form-label"><span>Chance</span></div>
																<div class="form-field">
																	<div class="input-valid">
																		<input class="input-field" value="90.00" id="chance">
																		<div class="input-suffix"><span id="chance_val">90.00</span> %</div>
																		<div class="valid"></div>
																	</div>
																	<div class="buttons-group no-top-radius">
																		<button type="button" class="btn btn-perc" data-action="min">MIN</button>
																		<button type="button" class="btn btn-perc" data-action="multiply" data-value="2">2X</button>
																		<button type="button" class="btn btn-perc" data-action="divide" data-value="2">1/2</button>
																		<button type="button" class="btn btn-perc" data-action="max">MAX</button>
																	</div>
																</div>
															</label>
														</div>
													</div>
													<div class="form-row">
														<div class="two-cols">
															<div class="form-row">
																<div class="two-cols">
                                                                    <div class="form-row form-row-sm">
                                                                        <button type="button" class="btn btn-green btn-play padding-plus" data-type="min">
                                                                            <div class="bet-chance">
                                                                                <div class="chance-text">
                                                                                    <span>Less</span>
                                                                                    <p id="min_tick">0 - 899999</p>
                                                                                </div>
                                                                            </div>
                                                                        </button>
                                                                    </div>
                                                                    <div class="form-row form-row-sm">
                                                                        <button type="button" class="btn btn-green btn-play padding-plus" data-type="max">
                                                                            <div class="bet-chance">
                                                                                <div class="chance-text">
                                                                                    <span>More</span>
                                                                                    <p id="max_tick">100000 - 999999</p>
                                                                                </div>
                                                                            </div>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="two-cols">

                                                                    <div class="form-row">
                                                                        <div class="bordered-block">
                                                                            <label class="nvuti-exp">
                                                                                <span class="number" id="win">0.00</span>
                                                                                <div class="form-label">
                                                                                    <span>Possible winnings</span></div>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">

                                                                            <div class="game-dice">
                                                                                <span class="result">
                                                                                </span>
                                                                            </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
							</div>
						</div>
					</div>
				</div>
				<div class="game-history__wrap">
					<div class="hash">
						<span class="title">HASH:</span> <span class="text">33c781be19eaf18c384e117ee8cdedf4</span>
					</div>
				</div>
				<!--  -->
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


					</div>
<div class="section bets-section">
	<div class="container">
		<div class="game-stats">
			<div class="table-heading">
				<div class="thead">
					<div class="tr">
						<div class="th">Player</div>
						<div class="th">Bet</div>
						<div class="th">Numbers</div>
						<div class="th">Target</div>
						<div class="th">Chance</div>
						<div class="th">Winning</div>
						<div class="th"></div>
					</div>
				</div>
			</div>
			<div class="table-stats-wrap" style="min-height: 530px; max-height: 100%;">
				<div class="table-wrap">
					<table class="table">
						<tbody>
							<?php $__currentLoopData = $game; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="username">
									<button type="button" class="btn btn-link" data-id="<?php echo e($g['unique_id']); ?>">
										<span class="sanitize-user">
											<div class="sanitize-avatar"><img src="<?php echo e($g['avatar']); ?>" alt=""></div>
											<span class="sanitize-name"><?php echo $g['username']; ?></span>
										</span>
									</button>
								</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span><?php echo e($g['sum']); ?></span>
											<svg class="icon icon-coin <?php echo e($g['balType']); ?>">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
								<td><?php echo e($g['num']); ?></td>
								<td><?php echo e($g['range']); ?></td>
								<td><?php echo e($g['perc']); ?>%</td>
								<td>
									<div class="bet-number">
										<span class="bet-wrap">
											<span class="<?php echo e($g['win'] ? 'win' : 'lose'); ?>"><?php echo e($g['win'] ? '+'.$g['win_sum'] : $g['win_sum']); ?></span>
											<svg class="icon icon-coin">
												<use xlink:href="/img/symbols.svg#icon-coin"></use>
											</svg>
										</span>
									</div>
								</td>
								<td><button class="btn btn-primary checkGame" data-hash="<?php echo e($g['hash']); ?>">Check</button></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/dice.blade.php */ ?>