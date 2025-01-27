

<?php $__env->startSection('content'); ?>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Editing a user</h3>
	</div>
</div>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay">
				<div class="kt-portlet__head kt-portlet__space-x">
					<div class="kt-portlet__head-label" style="width: 100%;">
						<h3 class="kt-portlet__head-title text-center" style="width: 100%;">
							<?php echo e($user->username); ?>

						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget28">
						<div class="kt-widget28__visual" style="background: url(<?php echo e($user->avatar); ?>) bottom center no-repeat"></div>
						<div class="kt-widget28__wrapper kt-portlet__space-x">
							<div class="tab-content">
								<div id="menu11" class="tab-pane active">
									<div class="kt-widget28__tab-items">
										<div class="kt-widget12">
											<?php if(!$user->fake): ?>
											<div class="kt-widget12__content">
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Amount of deposits</span>
														<span class="kt-widget12__value"><?php echo e($pay); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Sum of withdrawals</span>
														<span class="kt-widget12__value"><?php echo e($withdraw); ?> €.</span>
													</div>
												</div>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Amount of swaps</span>
														<span class="kt-widget12__value"><?php echo e($exchanges); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
													Jackpot Bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($jackpotWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($jackpotLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
													Wheel bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($wheelWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($wheelLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
												Crash bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($crashWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($crashLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
												PvP Bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($coinWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($coinLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
													Battle Bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($battleWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($battleLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
													Dice Bets
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($diceWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($diceLose); ?> €.</span>
													</div>
												</div>
											</div>
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
												Summary
												</h6>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Won</span>
														<span class="kt-widget12__value"><?php echo e($betWin); ?> €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value"><?php echo e($betLose); ?> €.</span>
													</div>
												</div>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
						User information
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<?php if(!$user->fake): ?>
				<form class="kt-form" method="post" action="/admin/user/save">
					<div class="kt-portlet__body">
						<input name="id" value="<?php echo e($user->id); ?>" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Last Name First Name:</label>
								<input type="text" class="form-control" value="<?php echo e($user->username); ?>" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">IP address:</label>
								<input type="text" class="form-control" value="<?php echo e($user->ip); ?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Balance:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="balance" value="<?php echo e($user->balance); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Bonuses:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="bonus" value="<?php echo e($user->bonus); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-diamond"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Privileges:</label>
								<select class="form-control" name="priv">
									<option value="admin" <?php if($user->is_admin): ?> selected <?php endif; ?>>Administrator</option>
									<option value="moder" <?php if($user->is_moder): ?> selected <?php endif; ?>>Moderator
									</option>
									<option value="youtuber" <?php if($user->is_youtuber): ?> selected <?php endif; ?>>YouTube`r</option>
									<option value="user" <?php if(!$user->is_admin && !$user->is_moder && !$user->is_youtuber): ?> selected <?php endif; ?>>User</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Style:</label>
								<select class="form-control" name="style">
									<option value="0" <?php if($user->style == 0): ?> selected disabled <?php endif; ?>>Not selected</option>
									<?php $__currentLoopData = $styles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($style['id']); ?>" <?php if($user->style == $style['id']): ?> selected <?php endif; ?>><?php echo e($style['title']); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Site ban:</label>
								<select class="form-control" name="ban">
									<option value="0" <?php if($user->ban == 0): ?> selected <?php endif; ?>>No</option>
									<option value="1" <?php if($user->ban == 1): ?> selected <?php endif; ?>>Yes</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Reason for site ban:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ban_reason" value="<?php echo e($user->ban_reason); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">A chat room ban until:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat" value="<?php echo e(!is_null($user->banchat) ? \Carbon\Carbon::parse($user->banchat)->format('d.m.Y H:i:s') : ''); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Reason for chat ban:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat_reason" value="<?php echo e($user->banchat_reason); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Played out:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="requery" value="<?php echo e($user->requery); ?>">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label class="">Referral link:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ref_id" value="<?php echo e(strtolower($_SERVER['REQUEST_SCHEME']).'://'); ?><?php echo e(strtolower($settings->domain)); ?>/?ref=<?php echo e($u->unique_id); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-link"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Brought in players through a referral link:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="<?php echo e($user->link_reg); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-diamond"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Earned money on the referral system:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="<?php echo e($user->ref_money); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>All money earned on the referral system:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="<?php echo e($user->ref_money_all); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>VK page:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="https://vk.com/id<?php echo e($user->user_id); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-vk"></i></span></span>
								</div>
							</div>
						</div>
						<div class="kt-portlet">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">
									User translations
									</h3>
								</div>
							</div>
							<table class="table mb-0">
								<thead>
									<tr>
										<th>To whom</th>
										<th>Amount</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $sends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr class="col-xl-8">
										<td><a href="/admin/user/<?php echo e($s['id']); ?>"><?php echo e($s['username']); ?></a></td>
										<td><?php echo e($s['sum']); ?></td>
										<td><?php echo e($s['date']); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>

						<div class="kt-portlet">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">
									Transfers from other users.
									</h3>
								</div>
							</div>
							<table class="table mb-0">
								<thead>
									<tr>
										<th>From whom</th>
										<th>Amount</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $sends_from; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><a href="/admin/user/<?php echo e($s['id']); ?>"><?php echo e($s['username']); ?></a></td>
										<td><?php echo e($s['sum']); ?></td>
										<td><?php echo e($s['date']); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--solid">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-12">
										<button type="submit" class="btn btn-brand">Save</button>
									</div>
								</div>
							</div>
						</div>
				</form>
				<?php else: ?>
				<form class="kt-form" method="post" action="/admin/user/save">
					<div class="kt-portlet__body">
						<input name="id" value="<?php echo e($user->id); ?>" type="hidden">
						<div class="form-group row">
							<input type="hidden" class="form-control" name="balance" value="<?php echo e($user->balance); ?>">
							<input type="hidden" class="form-control" name="bonus" value="<?php echo e($user->bonus); ?>">
							<input type="hidden" class="form-control" name="ban" value="<?php echo e($user->ban); ?>">
							<div class="col-lg-6">
								<label>Surname First name:</label>
								<input type="text" class="form-control" value="<?php echo e($user->username); ?>" disabled>
							</div>
							<div class="col-lg-6">
								<label>Betting time</label>
								<select class="form-control" name="time">
									<option value="1" <?php echo e($user->time == 1 ? 'selected' : ''); ?>>In the morning (6am to 12am)</option>
									<option value="2" <?php echo e($user->time == 2 ? 'selected' : ''); ?>>In the afternoon (from 12pm to 18pm)</option>
									<option value="3" <?php echo e($user->time == 3 ? 'selected' : ''); ?>>In the evening (from 18pm to 00pm)</option>
									<option value="4" <?php echo e($user->time == 4 ? 'selected' : ''); ?>>At night (00am to 6am)</option>
									<option value="0" <?php echo e($user->time == 0 ? 'selected' : ''); ?>>All the time.</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Privileges:</label>
								<select class="form-control" name="priv">
									<option value="admin" <?php if($user->is_admin): ?> selected <?php endif; ?>>Administrator</option>
									<option value="moder" <?php if($user->is_moder): ?> selected <?php endif; ?>>Moderator</option>
									<option value="youtuber" <?php if($user->is_youtuber): ?> selected <?php endif; ?>>YouTube`r</option>
									<option value="user" <?php if(!$user->is_admin && !$user->is_moder && !$user->is_youtuber): ?> selected <?php endif; ?>>User</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Page VK:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="https://vk.com/id<?php echo e($user->user_id); ?>" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-vk"></i></span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot kt-portlet__foot--solid">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-12">
									<button type="submit" class="btn btn-brand">Save</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<?php endif; ?>
				<!--end::Form-->
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/admin/user.blade.php */ ?>