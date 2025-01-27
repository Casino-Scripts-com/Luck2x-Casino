@extends('admin')

@section('content')
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
							{{$user->username}}
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget28">
						<div class="kt-widget28__visual" style="background: url({{$user->avatar}}) bottom center no-repeat"></div>
						<div class="kt-widget28__wrapper kt-portlet__space-x">
							<div class="tab-content">
								<div id="menu11" class="tab-pane active">
									<div class="kt-widget28__tab-items">
										<div class="kt-widget12">
											@if(!$user->fake)
											<div class="kt-widget12__content">
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Amount of deposits</span>
														<span class="kt-widget12__value">{{$pay}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Sum of withdrawals</span>
														<span class="kt-widget12__value">{{$withdraw}} €.</span>
													</div>
												</div>
												<div class="kt-widget12__item">
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Amount of swaps</span>
														<span class="kt-widget12__value">{{$exchanges}} €.</span>
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
														<span class="kt-widget12__value">{{$jackpotWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$jackpotLose}} €.</span>
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
														<span class="kt-widget12__value">{{$wheelWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$wheelLose}} €.</span>
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
														<span class="kt-widget12__value">{{$crashWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$crashLose}} €.</span>
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
														<span class="kt-widget12__value">{{$coinWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$coinLose}} €.</span>
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
														<span class="kt-widget12__value">{{$battleWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$battleLose}} €.</span>
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
														<span class="kt-widget12__value">{{$diceWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$diceLose}} €.</span>
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
														<span class="kt-widget12__value">{{$betWin}} €.</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Lost</span>
														<span class="kt-widget12__value">{{$betLose}} €.</span>
													</div>
												</div>
											</div>
											@endif
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
				@if(!$user->fake)
				<form class="kt-form" method="post" action="/admin/user/save">
					<div class="kt-portlet__body">
						<input name="id" value="{{$user->id}}" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Last Name First Name:</label>
								<input type="text" class="form-control" value="{{$user->username}}" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">IP address:</label>
								<input type="text" class="form-control" value="{{$user->ip}}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Balance:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="balance" value="{{$user->balance}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Bonuses:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="bonus" value="{{$user->bonus}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-diamond"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Privileges:</label>
								<select class="form-control" name="priv">
									<option value="admin" @if($user->is_admin) selected @endif>Administrator</option>
									<option value="moder" @if($user->is_moder) selected @endif>Moderator
									</option>
									<option value="youtuber" @if($user->is_youtuber) selected @endif>YouTube`r</option>
									<option value="user" @if(!$user->is_admin && !$user->is_moder && !$user->is_youtuber) selected @endif>User</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Style:</label>
								<select class="form-control" name="style">
									<option value="0" @if($user->style == 0) selected disabled @endif>Not selected</option>
									@foreach($styles as $style)
									<option value="{{$style['id']}}" @if($user->style == $style['id']) selected @endif>{{$style['title']}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Site ban:</label>
								<select class="form-control" name="ban">
									<option value="0" @if($user->ban == 0) selected @endif>No</option>
									<option value="1" @if($user->ban == 1) selected @endif>Yes</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Reason for site ban:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ban_reason" value="{{$user->ban_reason}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">A chat room ban until:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat" value="{{ !is_null($user->banchat) ? \Carbon\Carbon::parse($user->banchat)->format('d.m.Y H:i:s') : '' }}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Reason for chat ban:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat_reason" value="{{$user->banchat_reason}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Played out:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="requery" value="{{ $user->requery }}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label class="">Referral link:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ref_id" value="{{ strtolower($_SERVER['REQUEST_SCHEME']).'://' }}{{ strtolower($settings->domain) }}/?ref={{$u->unique_id}}" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-link"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Brought in players through a referral link:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="{{$user->link_reg}}" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-diamond"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Earned money on the referral system:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="{{$user->ref_money}}" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>All money earned on the referral system:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="{{$user->ref_money_all}}" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-eur"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>VK page:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="https://vk.com/id{{$user->user_id}}" disabled>
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
									@foreach($sends as $s)
									<tr class="col-xl-8">
										<td><a href="/admin/user/{{$s['id']}}">{{$s['username']}}</a></td>
										<td>{{$s['sum']}}</td>
										<td>{{$s['date']}}</td>
									</tr>
									@endforeach
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
									@foreach($sends_from as $s)
									<tr>
										<td><a href="/admin/user/{{$s['id']}}">{{$s['username']}}</a></td>
										<td>{{$s['sum']}}</td>
										<td>{{$s['date']}}</td>
									</tr>
									@endforeach
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
				@else
				<form class="kt-form" method="post" action="/admin/user/save">
					<div class="kt-portlet__body">
						<input name="id" value="{{$user->id}}" type="hidden">
						<div class="form-group row">
							<input type="hidden" class="form-control" name="balance" value="{{$user->balance}}">
							<input type="hidden" class="form-control" name="bonus" value="{{$user->bonus}}">
							<input type="hidden" class="form-control" name="ban" value="{{$user->ban}}">
							<div class="col-lg-6">
								<label>Surname First name:</label>
								<input type="text" class="form-control" value="{{$user->username}}" disabled>
							</div>
							<div class="col-lg-6">
								<label>Betting time</label>
								<select class="form-control" name="time">
									<option value="1" {{ $user->time == 1 ? 'selected' : '' }}>In the morning (6am to 12am)</option>
									<option value="2" {{ $user->time == 2 ? 'selected' : '' }}>In the afternoon (from 12pm to 18pm)</option>
									<option value="3" {{ $user->time == 3 ? 'selected' : '' }}>In the evening (from 18pm to 00pm)</option>
									<option value="4" {{ $user->time == 4 ? 'selected' : '' }}>At night (00am to 6am)</option>
									<option value="0" {{ $user->time == 0 ? 'selected' : '' }}>All the time.</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Privileges:</label>
								<select class="form-control" name="priv">
									<option value="admin" @if($user->is_admin) selected @endif>Administrator</option>
									<option value="moder" @if($user->is_moder) selected @endif>Moderator</option>
									<option value="youtuber" @if($user->is_youtuber) selected @endif>YouTube`r</option>
									<option value="user" @if(!$user->is_admin && !$user->is_moder && !$user->is_youtuber) selected @endif>User</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Page VK:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="https://vk.com/id{{$user->user_id}}" disabled>
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
				@endif
				<!--end::Form-->
			</div>
		</div>
	</div>
</div>
@endsection