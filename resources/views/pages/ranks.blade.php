@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/profileHistory.css">
<link rel="stylesheet" href="/css/free.css">
<script type="text/javascript" src="/js/profileHistory.js"></script>
<div class="section">
    <div class="wallet_container">
        <div class="wallet_component">
        	<style>
				.history_table td, .history_table th {
				    text-align: center;
				    border: none;
				}
				.history_table td {
					padding-top: 10px;
					padding-bottom:10px
				}
				.history_table td > .btn {
					padding: 11.5px;
				}
				.ranks__item-rank-image img {
				    display: block;
				    width: 34px;
				}
				.ranks__item-rank {
				    display: flex;
				    align-items: center;
				    justify-content: flex-start;
				}
				.ranks__item-rank-name {
				    margin-left: 10px;
				    white-space: nowrap;
				    overflow: hidden;
				    text-overflow: ellipsis;
				}
				.ranks__item {
					display: flex;
				    align-items: center;
				    justify-content: center;
				    margin-right: 30px;
				}
        	</style>
        <div class="dailyFree_dailyFree">
        <div class="quest-banner daily">
            <div class="caption">
                <h1><span>List of ranks</span></h1></div>
            <div class="info"><span>You have <b>{{number_format(floor(Auth::User()->bsum / 10), 2, '.', '')}} points</span></div>
        </div>
	            <div class="history_wrapper with">
	                <div class="withPager">
	                    <div class="">
	                    	<div class="history_scroll">
								<table class="history_table" style="text-align: center;">
									<thead>
										<tr>
											<th style="text-align:left;">Rank</th>
											<th>Glasses</th>
											<th>Bonus</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody style="text-align: center;">
										@foreach($ranks as $rank)
										<tr>
											<td>
												<div class="col-sm-4 col-lg-3 text-left col-4 ranks__item" style="justify-content: left;">
													<div class="ranks__item-rank">
														<div class="ranks__item-rank-image">
															<img src="{{$rank['icon']}}" alt="{{$rank['title']}}">
														</div> 
													<div class="ranks__item-rank-name">{{$rank['title']}}</div>
													</div>
												</div>
											</td>
											<td style="font-weight: 600;">{{$rank['points']}}</td>
											<td>{{$rank['bonus']}} <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></td>
											@if(Auth::User())
											@if(in_array(Auth::User()->id, $rank['ids']))
												<td>@if(Auth::User()->rank == $rank['id']) Selected @else
													<button type="button" class="btn" onclick="location.href=`/rank/select/{{$rank['id']}}`;">Select</button>
													@endif
												</td>
											@else
												@if(floor(Auth::User()->bsum / 10) >= $rank['points'])
												<td><button type="button" class="btn" onclick="location.href=`/rank/claim/{{$rank['id']}}`;">Get</button></td>
												@else
												<td>Not enough points</td>
												@endif
											@endif
											@else
											<td>Авторизуйтесь</td>
											@endif
										</tr>
										@endforeach
									</tbody>
								</table>
	                        </div>
	                    </div>
	                </div>
            	</div>
    		</div>
        </div>
    </div>
</div>
@endsection