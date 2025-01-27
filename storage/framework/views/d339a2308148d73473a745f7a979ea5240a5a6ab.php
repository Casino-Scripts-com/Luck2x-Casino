

<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="/js/chart.min.js"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Statistics</h3>
	</div>
	<div class="kt-subheader__toolbar">
		<div class="kt-subheader__wrapper">
			<span class="kt-font-bold">Withdrawn today: <?php echo e($with_today); ?> <i class="la la-eur"></i></span>
		</div>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet">
		<div class="kt-portlet__body  kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::Total Profit-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Refills
								</h4>
								<span class="kt-widget24__desc">
									today
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								<?php echo e($pay_today); ?><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::Total Profit-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Feedbacks-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Refills
								</h4>
								<span class="kt-widget24__desc">
									in 7 days
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								<?php echo e($pay_week); ?><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Feedbacks-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Orders-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Refills
								</h4>
								<span class="kt-widget24__desc">
									per month
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								<?php echo e($pay_month); ?><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Orders-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Refills
								</h4>
								<span class="kt-widget24__desc">
									all time
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								<?php echo e($pay_all); ?><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Users-->
				</div>

			</div>
		</div>
	</div>
	<div class="kt-portlet">
		<div class="kt-portlet__body  kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::Total Profit-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Users
								</h4>
								<span class="kt-widget24__desc">
									total
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-brand">
								<?php echo e($usersCount); ?><i class="la la-user"></i>
							</span>
						</div>
					</div>
					<!--end::Total Profit-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Orders-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									To withdraw
								</h4>
								<span class="kt-widget24__desc">
									total amount
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-danger">
								<?php echo e($with_req); ?><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Orders-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Wallet balance
								</h4>
								<span class="kt-widget24__desc">
									FreeKassa EUR
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-warning">
								<span id="fkBal"><img src="https://i1.wp.com/caringo.com/wp-content/themes/bootstrap/wwwroot/img/spinning-wheel-1.gif" height="26px" /></span><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Users-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Wallet balance
								</h4>
								<span class="kt-widget24__desc">
									Payeer EUR
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-warning">
								<span id="peBal"><img src="https://i1.wp.com/caringo.com/wp-content/themes/bootstrap/wwwroot/img/spinning-wheel-1.gif" height="26px" /></span><i class="la la-eur"></i>
							</span>
						</div>
					</div>
					<!--end::New Users-->
				</div>

			</div>
		</div>
	</div>
	<div class="kt-portlet">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">
				<div class="col-md-12 col-lg-12 col-xl-4">
					<!--begin:: Widgets/Stats2-1 -->
					<div class="kt-widget1">
						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Jackpot Commission</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_jackpot); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">PvP Commission</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_pvp); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Battle Commission</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_battle); ?><i class="la la-eur"></i></span>
						</div>

					</div>
					<!--end:: Widgets/Stats2-1 -->
				</div>
				<div class="col-md-12 col-lg-12 col-xl-4">
					<!--begin:: Widgets/Stats2-2 -->
					<div class="kt-widget1">
						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Wheel Profit</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_wheel); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Dice Profit</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_dice); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Crash Profit</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_crash); ?><i class="la la-eur"></i></span>
						</div>

					</div>
					<!--end:: Widgets/Stats2-2 -->
				</div>
				<div class="col-md-12 col-lg-12 col-xl-4">
					<!--begin:: Widgets/Stats2-3 -->
					<div class="kt-widget1">
						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">HiLo Profit</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_hilo); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Profit exchanges</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit_exchange); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Total Profit</h3>
							</div>
							<span class="kt-widget1__number kt-font-success"><?php echo e($profit); ?><i class="la la-eur"></i> / <?php echo e($settings->profit_money); ?><i class="la la-eur"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Ref. system\Promo (consumption)</h3>
							</div>
							<span class="kt-widget1__number kt-font-danger"><?php echo e($profit_ref); ?><i class="la la-eur"></i></span>
						</div>
					</div>
					<!--end:: Widgets/Stats2-3 -->
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-6">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Schedule of registrations for the current month
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fluid">
					<div class="kt-widget12">
						<div class="kt-widget12__chart" style="height:250px;">
							<canvas id="authChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Refill schedule for the current month
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fluid">
					<div class="kt-widget12">
						<div class="kt-widget12__chart" style="height:250px;">
							<canvas id="depsChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if($u->superadmin): ?>
	<div class="row">
		<div class="col-xl-4">

			<!--begin:: Widgets/Support Tickets -->
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Chat
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flaticon-more-1"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__item">
										<a class="kt-nav__link clearChat">
											<i class="kt-nav__link-icon flaticon-delete"></i>
											<span class="kt-nav__link-text">Clear</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body" id="chat_app">
					<div class="kt-widget3 chat-scroll kt-scroll" data-scroll="true" data-height="345">
						<?php if($messages != 0): ?> <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="kt-widget3__item chat_mes" id="chatm_<?php echo e($sms['time2']); ?>">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">
									<img class="kt-widget3__img" src="<?php echo e($sms['avatar']); ?>" alt="">
								</div>
								<div class="kt-widget3__info">
									<span class="kt-widget3__username">
										<?php echo e($sms['username']); ?>

									</span><br>
									<span class="kt-widget3__time">
										<?php echo e($sms['time']); ?>

									</span>
								</div>
								<span class="kt-widget3__status">
									<button class="btn btn-sm btn-label-brand btn-bold" onclick="chatdelet(<?php echo e($sms['time2']); ?>)">Delete</button>
								</span>
							</div>
							<div class="kt-widget3__body">
								<p class="kt-widget3__text">
									<?php echo $sms['messages']; ?>

								</p>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
					</div>

					<div class="form-group" style="margin-top: 10px;">
						<label for="exampleSelect1">Select a user</label>
						<select class="form-control" id="users">
							<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($user->user_id); ?>"><?php echo e($user->username); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<div class="form-group" style="margin-bottom: 0px;">
						<input type="text" class="form-control" placeholder="Enter text" id="chatmess">
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="reset" class="btn btn-primary" id="chatsend">Send</button>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if($u->superadmin): ?>
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Jackpot twist
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<ul class="nav nav-tabs nav-fill" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#room_easy">EASY</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#room_medium">MEDIUM</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#room_hard">HARD</a>
						</li>
					</ul>
					<div class="tab-content kt-scroll" data-scroll="true" data-height="507">
						<div class="tab-pane active" id="room_easy" role="tabpanel">
							<div class="kt-timeline-v1__item-body">
								<div class="kt-widget4" id="chance_easy">
									<?php $__currentLoopData = $chances_easy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="kt-widget4__item">
										<div class="kt-widget4__pic">
											<img src="<?php echo e($user['avatar']); ?>" alt="">
										</div>
										<div class="kt-widget4__info">
											<span class="kt-widget4__username">
												<?php echo e($user['username']); ?>

											</span>
											<p class="kt-widget4__text">
												<?php echo e($user['sum']); ?>€./<?php echo e($user['chance']); ?>%
											</p>
										</div>
										<button class="btn btn-sm btn-outline-success btn-bold" onclick="gotRoulette('<?php echo e($user['game_id']); ?>', <?php echo e($user['id']); ?>)">Twist</button>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="room_medium" role="tabpanel">
							<div class="kt-timeline-v1__item-body">
								<div class="kt-widget4" id="chance_medium">
									<?php $__currentLoopData = $chances_medium; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="kt-widget4__item">
										<div class="kt-widget4__pic">
											<img src="<?php echo e($user['avatar']); ?>" alt="">
										</div>
										<div class="kt-widget4__info">
											<span class="kt-widget4__username">
												<?php echo e($user['username']); ?>

											</span>
											<p class="kt-widget4__text">
												<?php echo e($user['sum']); ?>€./<?php echo e($user['chance']); ?>%
											</p>
										</div>
										<button class="btn btn-sm btn-outline-success btn-bold" onclick="gotRoulette('<?php echo e($user['game_id']); ?>', <?php echo e($user['id']); ?>)">Twist</button>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="room_hard" role="tabpanel">
							<div class="kt-timeline-v1__item-body">
								<div class="kt-widget4" id="chance_hard">
									<?php $__currentLoopData = $chances_hard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="kt-widget4__item">
										<div class="kt-widget4__pic">
											<img src="<?php echo e($user['avatar']); ?>" alt="">
										</div>
										<div class="kt-widget4__info">
											<span class="kt-widget4__username">
												<?php echo e($user['username']); ?>

											</span>
											<p class="kt-widget4__text">
												<?php echo e($user['sum']); ?>€./<?php echo e($user['chance']); ?>%
											</p>
										</div>
										<button class="btn btn-sm btn-outline-success btn-bold" onclick="gotRoulette('<?php echo e($user['game_id']); ?>', <?php echo e($user['id']); ?>)">Twist</button>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4">

			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Jackpot bets
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form">
					<div class="kt-portlet__body" style="height: 533px;">
						<div class="form-group">
							<label for="exampleSelect1">Select a user</label>
							<select class="form-control" id="users_jackpot">
								<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($user->user_id); ?>"><?php echo e($user->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Room</label>
							<select class="form-control" id="room_jackpot">
								<option value="easy">Easy</option>
								<option value="medium">Medium</option>
								<option value="hard">Hard</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Balance</label>
							<select class="form-control" id="balance_jackpot">
								<option value="balance">Real</option>
								<option value="bonus">Bonus</option>
							</select>
						</div>
						<div class="form-group">
							<label>Bet amount</label>
							<input type="text" class="form-control" placeholder="Enter the amount" id="sum_jackpot">
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<button type="reset" class="btn btn-primary betJackpot">Put up</button>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>

		</div>
	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Recent additions
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						<?php $__currentLoopData = $last_dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">
									<img class="kt-widget3__img" src="<?php echo e($pay['avatar']); ?>" alt="">
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/<?php echo e($pay['id']); ?>" class="kt-widget3__username">
										<?php echo e($pay['username']); ?>

									</a><br>
									<span class="kt-widget3__time">
										<?php echo e(Carbon\Carbon::parse($pay['date'])->diffForHumans()); ?>

									</span>
								</div>
								<span class="kt-widget3__status kt-font-success">
									<?php echo e($pay['sum']); ?> <i class="la la-eur"></i>
								</span>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php if($u->superadmin): ?>
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Twist Wheel
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="text-center">
						<button type="button" class="btn btn-primary gotWheel" data-color="black">x2</button>
						<button type="button" class="btn btn-danger gotWheel" data-color="red">x3</button>
						<button type="button" class="btn btn-success gotWheel" data-color="green">x5</button>
						<button type="button" class="btn btn-warning gotWheel" data-color="yellow">x50</button>
					</div>
				</div>
			</div>
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Betting at Wheel
						</h3>
					</div>
				</div>
				<form class="kt-form">
					<div class="kt-portlet__body">
						<div class="form-group">
							<label for="exampleSelect1">Select a user</label>
							<select class="form-control" id="users_wheel">
								<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($user->user_id); ?>"><?php echo e($user->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Multiplier</label>
							<select class="form-control" id="color_wheel">
								<option value="black">x2</option>
								<option value="red">x3</option>
								<option value="green">x5</option>
								<option value="yellow">x50</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Balance</label>
							<select class="form-control" id="balance_wheel">
								<option value="balance">Real</option>
								<option value="bonus">Bonus</option>
							</select>
						</div>
						<div class="form-group">
							<label>Bet amount</label>
							<input type="text" class="form-control" placeholder="Enter the amount" id="sum_wheel">
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<button type="reset" class="btn btn-primary betWheel">Put up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crash tweak
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Enter a number" id="multiplier_crash">
						<div class="input-group-append">
							<button class="btn btn-primary gotCrash" type="button">Twist</button>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Betting at Dice
						</h3>
					</div>
				</div>
				<form class="kt-form">
					<div class="kt-portlet__body">
						<div class="form-group">
							<label for="exampleSelect1">Select a user</label>
							<select class="form-control" id="users_dice">
								<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($user->user_id); ?>"><?php echo e($user->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Chance</label>
							<input type="text" class="form-control" placeholder="Enter a multiplier" id="chance_dice">
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Balance</label>
							<select class="form-control" id="balance_dice">
								<option value="balance">Real</option>
								<option value="bonus">Bonus</option>
							</select>
						</div>
						<div class="form-group">
							<label>Bet amount</label>
							<input type="text" class="form-control" placeholder="Enter the amount" id="sum_dice">
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<button type="reset" class="btn btn-primary betDice">Put up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Recent users
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">
									<img class="kt-widget3__img" src="<?php echo e($user->avatar); ?>" alt="">
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/<?php echo e($user->id); ?>" class="kt-widget3__username">
										<?php echo e($user->username); ?>

									</a><br>
									<span class="kt-widget3__time">
										Referral: <?php if($user->ref_id): ?>
										<a href="/admin/user/<?php echo e(App\User::findRef($user->ref_id)->id); ?>">
											<?php echo e(App\User::findRef($user->ref_id)->username); ?>

										</a>
										<?php else: ?>
										No
										<?php endif; ?>
									</span>
								</div>
								<span class="kt-widget3__status kt-font-success">
									<?php
									// Set the locale to English for this specific instance
									\Carbon\Carbon::setLocale('en');
									$diff = Carbon\Carbon::parse($user->created_at)->diffForHumans();
									?>
									<?php echo e($diff); ?>

								</span>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


					</div>
				</div>
			</div>
		</div>
		<?php if($u->superadmin): ?>
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Twist Battle
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="text-center">
						<button type="button" class="btn btn-danger gotBattle" data-color="red">Red</button>
						<button type="button" class="btn btn-info gotBattle" data-color="blue">Blue</button>
					</div>
				</div>
			</div>
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Bets in Battle
						</h3>
					</div>
				</div>
				<form class="kt-form">
					<div class="kt-portlet__body">
						<div class="form-group">
							<label for="exampleSelect1">Select a user</label>
							<select class="form-control" id="users_battle">
								<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($user->user_id); ?>"><?php echo e($user->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Team</label>
							<select class="form-control" id="color_battle">
								<option value="red">Red</option>
								<option value="blue">Blue</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleSelect1">Balance</label>
							<select class="form-control" id="balance_battle">
								<option value="balance">Real</option>
								<option value="bonus">Bonus</option>
							</select>
						</div>
						<div class="form-group">
							<label>Bet amount</label>
							<input type="text" class="form-control" placeholder="Enter the amount" id="sum_battle">
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<button type="reset" class="btn btn-primary betBattle">Put up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php endif; ?>
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							The richest
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						<?php $__currentLoopData = $userTop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">
									<img class="kt-widget3__img" src="<?php echo e($top->avatar); ?>" alt="">
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/<?php echo e($top->id); ?>" class="kt-widget3__username">
										<?php echo e($top->username); ?>

									</a>
								</div>
								<span class="kt-widget3__status kt-font-success">
									<?php echo e($top->balance); ?> <i class="la la-eur"></i>
								</span>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(function() {
		$.ajax({
			method: 'POST',
			url: '/admin/getUserByMonth',
			success: function(res) {
				var authChart = 'authChart';
				if ($('#' + authChart).length > 0) {
					var months = [];
					var users = [];

					$.each(res, function(index, data) {
						months.push(data.date);
						users.push(data.count);
					});

					var lineCh = document.getElementById(authChart).getContext("2d");

					var chart = new Chart(lineCh, {
						type: 'line',
						data: {
							labels: months,
							datasets: [{
								label: "",
								tension: 0.4,
								backgroundColor: 'transparent',
								borderColor: '#2c80ff',
								pointBorderColor: "#2c80ff",
								pointBackgroundColor: "#fff",
								pointBorderWidth: 2,
								pointHoverRadius: 6,
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#2c80ff",
								pointHoverBorderWidth: 2,
								pointRadius: 6,
								pointHitRadius: 6,
								data: users,
							}]
						},
						options: {
							legend: {
								display: false
							},
							maintainAspectRatio: false,
							tooltips: {
								callbacks: {
									title: function(tooltipItem, data) {
										return 'Date : ' + data['labels'][tooltipItem[0]['index']];
									},
									label: function(tooltipItem, data) {
										return data['datasets'][0]['data'][tooltipItem['index']] + ' people.';
									}
								},
								backgroundColor: '#eff6ff',
								titleFontSize: 13,
								titleFontColor: '#6783b8',
								titleMarginBottom: 10,
								bodyFontColor: '#9eaecf',
								bodyFontSize: 14,
								bodySpacing: 4,
								yPadding: 15,
								xPadding: 15,
								footerMarginTop: 5,
								displayColors: false
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true,
										fontSize: 12,
										fontColor: '#9eaecf',
										stepSize: Math.ceil(users / 5)
									},
									gridLines: {
										color: "#e5ecf8",
										tickMarkLength: 0,
										zeroLineColor: '#e5ecf8'
									},

								}],
								xAxes: [{
									ticks: {
										beginAtZero: true,
										fontSize: 12,
										fontColor: '#9eaecf',
										source: 'auto',
									},
									gridLines: {
										color: "transparent",
										tickMarkLength: 20,
										zeroLineColor: '#e5ecf8',
									},
								}]
							}
						}
					});
				}
			}
		});
		$.ajax({
			method: 'POST',
			url: '/admin/getDepsByMonth',
			success: function(res) {
				var depsChart = 'depsChart';
				if ($('#' + depsChart).length > 0) {
					var months = [];
					var deps = [];

					$.each(res, function(index, data) {
						months.push(data.date);
						deps.push(data.sum);
					});

					var lineCh = document.getElementById(depsChart).getContext("2d");

					var chart = new Chart(lineCh, {
						type: 'line',
						data: {
							labels: months,
							datasets: [{
								label: "",
								tension: 0.4,
								backgroundColor: 'transparent',
								borderColor: '#2c80ff',
								pointBorderColor: "#2c80ff",
								pointBackgroundColor: "#fff",
								pointBorderWidth: 2,
								pointHoverRadius: 6,
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#2c80ff",
								pointHoverBorderWidth: 2,
								pointRadius: 6,
								pointHitRadius: 6,
								data: deps,
							}]
						},
						options: {
							legend: {
								display: false
							},
							maintainAspectRatio: false,
							tooltips: {
								callbacks: {
									title: function(tooltipItem, data) {
										return 'Date : ' + data['labels'][tooltipItem[0]['index']];
									},
									label: function(tooltipItem, data) {
										return data['datasets'][0]['data'][tooltipItem['index']] + ' Euro.';
									}
								},
								backgroundColor: '#eff6ff',
								titleFontSize: 13,
								titleFontColor: '#6783b8',
								titleMarginBottom: 10,
								bodyFontColor: '#9eaecf',
								bodyFontSize: 14,
								bodySpacing: 4,
								yPadding: 15,
								xPadding: 15,
								footerMarginTop: 5,
								displayColors: false
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true,
										fontSize: 12,
										fontColor: '#9eaecf',
										stepSize: Math.ceil(deps / 5)
									},
									gridLines: {
										color: "#e5ecf8",
										tickMarkLength: 0,
										zeroLineColor: '#e5ecf8'
									},

								}],
								xAxes: [{
									ticks: {
										fontSize: 12,
										fontColor: '#9eaecf',
										source: 'auto',
									},
									gridLines: {
										color: "transparent",
										tickMarkLength: 20,
										zeroLineColor: '#e5ecf8',
									},
								}]
							}
						}
					});
				}
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/admin/index.blade.php */ ?>