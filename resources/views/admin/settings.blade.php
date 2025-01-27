@extends('admin')

@section('content')
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Settings</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-toolbar">
				<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#site" role="tab" aria-selected="true">
						Site settings
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#jackpot" role="tab" aria-selected="false">
							Jackpot
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#wheel" role="tab" aria-selected="false">
							Wheel
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#crash" role="tab" aria-selected="false">
							Crash
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#pvp" role="tab" aria-selected="false">
							PvP
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#battle" role="tab" aria-selected="false">
							Battle
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#dice" role="tab" aria-selected="false">
							Dice
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#hilo" role="tab" aria-selected="false">
							HiLo
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tower" role="tab" aria-selected="false">
							Tower
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#fake" role="tab" aria-selected="false">
						Fake betting system
						</a>
					</li>
				</ul>
			</div>
		</div>
		<form class="kt-form" method="post" action="/admin/setting/save">
			<div class="kt-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="site" role="tabpanel">
						<div class="kt-section">
							<h3 class="kt-section__title">
							General settings:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Domain name:</label>
									<input type="text" class="form-control" placeholder="Luck2x.com" value="{{$settings->domain}}" name="domain">
								</div>
								<div class="col-lg-4">
									<label>Site Name:</label>
									<input type="text" class="form-control" placeholder="Luck2x.com" value="{{$settings->sitename}}" name="sitename">
								</div>
								<div class="col-lg-4">
									<label>Site title (title):</label>
									<input type="text" class="form-control" placeholder="Luck2x.com - short description" value="{{$settings->title}}" name="title">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Description for search engines:</label>
									<input type="text" class="form-control" placeholder="Description for the website..." value="{{$settings->description}}" name="description">
								</div>
								<div class="col-lg-4">
									<label>Keywords for search engines:</label>
									<input type="text" class="form-control" placeholder="site, name, domain, etc...." value="{{$settings->keywords}}" name="keywords">
								</div>
								<div class="col-lg-4">
									<label>Replacing censorious words in chat with:</label>
									<input type="text" class="form-control" placeholder="i ❤ luck2x" value="{{$settings->censore_replace}}" name="censore_replace">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Fake betting system:</label>
									<select class="form-control" name="fakebets">
										<option value="0" {{ ($settings->fakebets == 0) ? 'selected' : '' }}>Off</option>
										<option value="1" {{ ($settings->fakebets == 1) ? 'selected' : '' }}>Included</option>
									</select>
								</div>
								<div class="col-lg-4">
									<label>Minimum amount for bonus exchange:</label>
									<input type="text" class="form-control" placeholder="1000" value="{{$settings->exchange_min}}" name="exchange_min">
								</div>
								<div class="col-lg-4">
									<label>Rate for bonus exchange:</label>
									<input type="text" class="form-control" placeholder="2" value="{{$settings->exchange_curs}}" name="exchange_curs">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Interval of subscription bonus issue (every N minutes):</label>
									<input type="text" class="form-control" placeholder="15" value="{{$settings->bonus_group_time}}" name="bonus_group_time">
								</div>
								<div class="col-lg-4">
									<label>Number of active referrals to receive bonus:</label>
									<input type="text" class="form-control" placeholder="8" value="{{$settings->max_active_ref}}" name="max_active_ref">
								</div>
								<div class="col-lg-4">
									<label>Deposit amount for using chat. 0 - Disabled:</label>
									<input type="text" class="form-control" placeholder="0" value="{{$settings->chat_dep}}" name="chat_dep">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Minimum deposit amount for bonus issuance. 0 - Disabled</label>
									<input type="text" class="form-control" placeholder="0" value="{{$settings->dep_bonus_min}}" name="dep_bonus_min">
								</div>
								<div class="col-lg-4">
									<label>Percentage of the deposit amount as a bonus:</label>
									<input type="text" class="form-control" placeholder="0" value="{{$settings->dep_bonus_perc}}" name="dep_bonus_perc">
								</div>
								<div class="col-lg-4">
									<label>Percentage of winnings for wagering purposes:</label>
									<input type="text" class="form-control" placeholder="0" value="{{$settings->requery_perc}}" name="requery_perc">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Percentage of bet amount for wagering:</label>
									<input type="text" class="form-control" placeholder="0" value="{{$settings->requery_bet_perc}}" name="requery_bet_perc">
								</div>
								<div class="col-lg-4">
									<label>Technical works:</label>
									<select class="form-control" name="site_disable">
										<option value="0" {{ ($settings->site_disable == 0) ? 'selected' : '' }}>Off</option>
										<option value="1" {{ ($settings->site_disable == 1) ? 'selected' : '' }}>On</option>
									</select>
								</div>
							</div>
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
							Referral system settings:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>What percentage of the winnings does the invite receive:</label>
									<input type="text" class="form-control" placeholder="Enter the percentage" value="{{$settings->ref_perc}}" name="ref_perc">
								</div>
								<div class="col-lg-4">
									<label>How much money the invitee receives on a real account:</label>
									<input type="text" class="form-control" placeholder="Enter the amount" value="{{$settings->ref_sum}}" name="ref_sum">
								</div>
								<div class="col-lg-4">
									<label>Minimum amount for withdrawal from the ref. account:</label>
									<input type="text" class="form-control" placeholder="Enter the amount" value="{{$settings->min_ref_withdraw}}" name="min_ref_withdraw">
								</div>
							</div>
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
							Other settings:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Minimum deposit amount:</label>
									<input type="text" class="form-control" placeholder="Enter the amount" value="{{$settings->min_dep}}" name="min_dep">
								</div>
								<div class="col-lg-4">
									<label>Amount of deposits to make a withdrawal:</label>
									<input type="text" class="form-control" placeholder="Enter the amount" value="{{$settings->min_dep_withdraw}}" name="min_dep_withdraw">
								</div>
								<div class="col-lg-4">
									<label>How much to give of the deposit amount (1/N):</label>
									<input type="text" class="form-control" placeholder="Enter the amount" value="{{$settings->profit_koef}}" name="profit_koef">
								</div>
							</div>
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
							VK group settings:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Link to VK group:</label>
									<input type="text" class="form-control" placeholder="https://vk.com/..." value="{{$settings->vk_url}}" name="vk_url">
								</div>
								<div class="col-lg-4">
									<label>Link to VK group posts:</label>
									<input type="text" class="form-control" placeholder="https://vk.com/im?media=&sel=..." value="{{$settings->vk_support_link}}" name="vk_support_link">
								</div>
								<div class="col-lg-4">
									<label>Application service access key:</label>
									<input type="text" class="form-control" placeholder="1f27230c1f27230c1f27230c841..." value="{{$settings->vk_service_key}}" name="vk_service_key">
								</div>
							</div>
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
							FreeKassa payment system settings:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Shop ID FK:</label>
									<input type="text" class="form-control" placeholder="Fxxxxxx" value="{{$settings->fk_mrh_ID}}" name="fk_mrh_ID">
								</div>
								<div class="col-lg-4">
									<label>FK Secret 1:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_secret1}}" name="fk_secret1">
								</div>
								<div class="col-lg-4">
									<label>FK Secret 2:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_secret2}}" name="fk_secret2">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-6">
									<label>FK Wallet:</label>
									<input type="text" class="form-control" placeholder="Pxxxxxx" value="{{$settings->fk_wallet}}" name="fk_wallet">
								</div>
								<div class="col-lg-6">
									<label>FK API Key:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_api}}" name="fk_api">
								</div>
							</div>
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
							Adjusting the withdrawal fee:
							</h3>
							<div class="form-group row">
								<div class="col-sm-1-5">
									<label>QIWI (+%)</label>
									<input type="text" class="form-control" name="qiwi_com_percent" value="{{$settings->qiwi_com_percent}}" placeholder="%">
									<label>QIWI (+Euro)</label>
									<input type="text" class="form-control" name="qiwi_com_rub" value="{{$settings->qiwi_com_rub}}" placeholder="Euro">
									<label>QIWI Min. amount</label>
									<input type="text" class="form-control" name="qiwi_min" value="{{$settings->qiwi_min}}" placeholder="Min. amount">
								</div>
								<div class="col-sm-1-5">
									<label>Yandex (+%)</label>
									<input type="text" class="form-control" name="yandex_com_percent" value="{{$settings->yandex_com_percent}}" placeholder="%">
									<label>Yandex (+Euro)</label>
									<input type="text" class="form-control" name="yandex_com_rub" value="{{$settings->yandex_com_rub}}" placeholder="Euro">
									<label>Yandex Min. amount</label>
									<input type="text" class="form-control" name="yandex_min" value="{{$settings->yandex_min}}" placeholder="Min. amount">
								</div>
								<div class="col-sm-1-5">
									<label>WebMoney (+%)</label>
									<input type="text" class="form-control" name="webmoney_com_percent" value="{{$settings->webmoney_com_percent}}" placeholder="%">
									<label>WebMoney (+Euro)</label>
									<input type="text" class="form-control" name="webmoney_com_rub" value="{{$settings->webmoney_com_rub}}" placeholder="Euro">
									<label>WebMoney Min. amount</label>
									<input type="text" class="form-control" name="webmoney_min" value="{{$settings->webmoney_min}}" placeholder="Min. amount">
								</div>
								<div class="col-sm-1-5">
									<label>VISA (+%)</label>
									<input type="text" class="form-control" name="visa_com_percent" value="{{$settings->visa_com_percent}}" placeholder="%">
									<label>VISA (+Euro)</label>
									<input type="text" class="form-control" name="visa_com_rub" value="{{$settings->visa_com_rub}}" placeholder="Euro">
									<label>VISA Min. amount</label>
									<input type="text" class="form-control" name="visa_min" value="{{$settings->visa_min}}" placeholder="Min. amount">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="jackpot" role="tabpanel">
						<div class="form-group">
							<label>The Game Commission's %:</label>
							<input type="text" class="form-control" placeholder="Enter the percentage" value="{{$settings->jackpot_commission}}" name="jackpot_commission">
						</div>
						@foreach($rooms as $r)
						<div class="kt-section">
							<h3 class="kt-section__title">
							Room "{{$r->title}}":
							</h3>
							<div class="form-group row">
								<div class="col-lg-3">
									<label>Timer:</label>
									<input type="text" class="form-control" name="time_{{$r->name}}" value="{{$r->time}}" placeholder="Timer">
								</div>
								<div class="col-lg-3">
									<label>Minimum bet amount:</label>
									<input type="text" class="form-control" name="min_{{$r->name}}" value="{{$r->min}}" placeholder="Minimum bet amount">
								</div>
								<div class="col-lg-3">
									<label>Maximum bet amount:</label>
									<input type="text" class="form-control" name="max_{{$r->name}}" value="{{$r->max}}" placeholder="Maximum bet amount">
								</div>
								<div class="col-lg-3">
									<label>Maximum number of bets for a player:</label>
									<input type="text" class="form-control" name="bets_{{$r->name}}" value="{{$r->bets}}" placeholder="Max. number of bets for a player">
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="tab-pane" id="wheel" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>Timer:</label>
								<input type="text" class="form-control" placeholder="Timer" value="{{$settings->wheel_timer}}" name="wheel_timer">
							</div>
							<div class="col-lg-4">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->wheel_min_bet}}" name="wheel_min_bet">
							</div>
							<div class="col-lg-4">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->wheel_max_bet}}" name="wheel_max_bet">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="crash" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>Timer:</label>
								<input type="text" class="form-control" placeholder="Timer" value="{{$settings->crash_timer}}" name="crash_timer">
							</div>
							<div class="col-lg-4">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->crash_min_bet}}" name="crash_min_bet">
							</div>
							<div class="col-lg-4">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->crash_max_bet}}" name="crash_max_bet">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="pvp" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>The Game Commission's %:</label>
								<input type="text" class="form-control" placeholder="Max. number of active games per player" value="{{$settings->flip_commission}}" name="flip_commission">
							</div>
							<div class="col-lg-4">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->flip_min_bet}}" name="flip_min_bet">
							</div>
							<div class="col-lg-4">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->flip_max_bet}}" name="flip_max_bet">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="battle" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-3">
								<label>Timer:</label>
								<input type="text" class="form-control" placeholder="Timer" value="{{$settings->battle_timer}}" name="battle_timer">
							</div>
							<div class="col-lg-3">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->battle_min_bet}}" name="battle_min_bet">
							</div>
							<div class="col-lg-3">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->battle_max_bet}}" name="battle_max_bet">
							</div>
							<div class="col-lg-3">
								<label>The Game Commission's %:</label>
								<input type="text" class="form-control" placeholder="The Game Commission's %" value="{{$settings->battle_commission}}" name="battle_commission">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="dice" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->dice_min_bet}}" name="dice_min_bet">
							</div>
							<div class="col-lg-6">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->dice_max_bet}}" name="dice_max_bet">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="hilo" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-3">
								<label>Timer:</label>
								<input type="text" class="form-control" placeholder="Timer" value="{{$settings->hilo_timer}}" name="hilo_timer">
							</div>
							<div class="col-lg-3">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->hilo_min_bet}}" name="hilo_min_bet">
							</div>
							<div class="col-lg-3">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->hilo_max_bet}}" name="hilo_max_bet">
							</div>
							<div class="col-lg-3">
								<label>Number of bets for 1 player:</label>
								<input type="text" class="form-control" placeholder="Number of bets" value="{{$settings->hilo_bets}}" name="hilo_bets">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tower" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-3">
								<label>Minimum bet amount:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount" value="{{$settings->tower_min_bet}}" name="tower_min_bet">
							</div>
							<div class="col-lg-3">
								<label>Maximum bet amount:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount" value="{{$settings->tower_max_bet}}" name="tower_max_bet">
							</div>
						</div>
					</div>
					<div class="tab-pane" id="fake" role="tabpanel">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Minimum bet amount for a fake:</label>
								<input type="text" class="form-control" placeholder="Minimum bet amount for a fake" value="{{$settings->fake_min_bet}}" name="fake_min_bet">
							</div>
							<div class="col-lg-6">
								<label>Maximum bet amount for a fake:</label>
								<input type="text" class="form-control" placeholder="Maximum bet amount for a fake" value="{{$settings->fake_max_bet}}" name="fake_max_bet">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__foot">
				<div class="kt-form__actions">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="reset" class="btn btn-secondary">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
