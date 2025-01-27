@extends('layout')

@section('content')
<div class="sendmoney">
<div class="head-game">
</div>
<div class="cont-b">
	<div class="ref">
		<div class="info">
			<h3 class="title">You want to ask your friends for coins?</h3>
			<div class="desc">Copy your ID and send it to your friend!</div>
		</div>
		<div class="code">
			<div class="code-title">Your unique ID:</div>
			<div class="value">
				<input type="text" value="{{$u->user_id}}" id="userID" readonly="" style="text-align: center;border-color: #fff;height: 32px;background-color: #e8e8e8;border-radius: 25px;padding: 15px;outline: none;margin-bottom: 16px;border: 2px solid transparent;">
				<i class="fas fa-copy tooltip tooltipstered" onclick="copyToClipboard('#userID')"></i>
			</div>
		</div>
		<div class="info">
			<h3 class="title">Coin transferh3>
			<div class="desc">To transfer coins to a player you only need to know his unique ID</div>
		</div>
		<div class="code">
			<div class="code-title">Enter the recipient ID:</div>
			<div class="value">
				<input type="text" placeholder="Уникальный идентификатор" class="targetID" style="text-align: center;border-color: #fff;height: 32px;background-color: #e8e8e8;border-radius: 25px;padding: 15px;outline: none;margin-bottom: 16px;border: 2px solid transparent;">
			</div>
		</div>
		<div class="code">
			<div class="code-title">Transfer amount:</div>
			<div class="value">
				<input type="text" placeholder="Желаемая сумма" class="sum" id="sumToSend" style="text-align: center;border-color: #fff;height: 32px;background-color: #e8e8e8;border-radius: 25px;padding: 15px;outline: none;margin-bottom: 16px;border: 2px solid transparent;">
			</div>
		</div>
		<div class="info">
			<h3 class="title">To be written off: <span id="minusSum">0</span> <i class="fas fa-coins"></i></h3>
			<h3 class="title" style="font-size: 12px; color: #949494;">(commission 5%)</h3>
		</div>
		<div class="info">
			<div class="desc">
			Minimum transfer amount is 20 coins<br>
				To perform the transfer you need to make a withdrawal of at least 250 rubles
			</div>
		</div>
		<a class="btn sendButton" style="margin-top: 10px;">TRANSFER</a>
	</div>
</div>
</div>
@endsection