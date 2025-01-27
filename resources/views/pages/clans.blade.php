@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/profileHistory.css">
<link rel="stylesheet" href="/css/free.css">
<link rel="stylesheet" href="/css/tournament.css?v={{time()}}">
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
	            <div class="history_wrapper with">
	                <div class="withPager">
	                    <div class="">
	                    	<div class="history_scroll">
								<table class="history_table" style="text-align: center;">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Members</th>
											<th>Points</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody style="text-align: center;">
										@foreach($clans as $clan)
										<tr>
											<td>@if($clan['position'] > 3) {{$clan['position']}} @else <img src="/img/place-{{$clan['position']}}.svg" style="width:24px"> @endif</td>
											<td>
											  <div class="tournament-table__col tournament-table__col_user">
											    <div class="user-info">
											      <div class="user-info__avatar">
											        <div class="user-info__avatar-image">
											          <img src="{{$clan['avatar']}}" alt="{{$clan['name']}}" style="max-width:20px;min-width:20px;max-height:20px;min-height:20px;">
											        </div>
											        <!---->
											      </div>
											      <div class="user-info__name" style="cursor: pointer;">{{$clan['name']}}</div>
											    </div>
											  </div>
											</td>
											<td>{{$clan['members']}} / 100</td>
											<td>{{$clan['points']}}</td>
                                            <td><button type="button" class="btn" onclick="location.href='/clan/{{$clan['id']}}';">Go to</button></td>
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