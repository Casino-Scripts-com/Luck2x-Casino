@extends('layout')

@section('content')
<div class="head-game">
	<span class="game-name">Account history</span>
</div>
<div class="cont-b">
	<div class="second-title"><span>Active enquiries</span></div>
	@if($active != '[]')
	<div class="payHistory">
		<table class="list">
			<thead>
				<tr>
					<th>Number</th>
					<th>System<br>Wallet</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($active as $a)
				<tr>
					<td><div class="id">{{$a->id}}</div></td>
					<td><div class="system">{{$a->wallet}} ({{$a->system}})</div></td>
					<td><div class="sum {{ $a->status ? 'ok' : 'dec' }}">@if($a->status == 2) +{{$a->value}} @else -{{$a->value}} @endif</div></td>
					<td><div class="status"><a class="buttoninzc" href="/withdraw/cancel/{{$a->id}}"><i class="fas fa-times"></i></a></div></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	<div class="second-title"><span>Top-up history</span></div>
	@if($pays != '[]')
	<div class="payHistory">
		<table class="list">
			<thead>
				<tr>
					<th>Number</th>
					<th>Type</th>
					<th>System<br>Wallet</th>
					<th>Amount</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pays as $pay)
				<tr>
					<td><div class="id">{{$pay->id}}</div></td>
					<td><div class="type ok">@if($pay->status == 1) Top-up @elseif($pay->status == 2) Referral code @else Promo code @endif</div></td>
					<td><div class="system">@if($pay->status == 1) Free-kassa @else {{$pay->code}} @endif</div></td>
					<td><div class="sum ok">+{{$pay->price}}</div></td>
					<td><div class="status ok">Done</div></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	<div class="second-title"><span>History of Conclusions</span></div>
	@if($withdraws != '[]')
	<div class="payHistory">
		<table class="list">
			<thead>
				<tr>
					<th>Number</th>
					<th>Type</th>
					<th>System<br>Wallet</th>
					<th>Amount</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($withdraws as $with)
				<tr>
					<td><div class="id">{{$with->id}}</div></td>
					<td><div class="type {{ $with->status ? 'ok' : 'dec' }}">Conclusion</div></td>
					<td><div class="system">{{$with->system}}</div></td>
					<td><div class="sum {{ $with->status ? 'ok' : 'dec' }}">@if($with->status == 2) +{{$with->value}} @else -{{$with->value}} @endif</div></td>
					<td><div class="status {{ $with->status ? 'ok' : 'dec' }}">@if($with->status == 0) On moderation @elseif($with->status == 1) Done @else Refunded @endif</div></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
</div>
@endsection