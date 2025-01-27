

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/profileNew.css?v=<?php echo e(time()); ?>">
<div class="section">
	<div class="profile d-flex align-start flex-wrap">
	  <div class="profile__user d-flex flex-column align-center justify-center">
	    <div class="profile__top d-flex align-center justify-space-between">
	      <b>Profile</b>
		  <!--
	      <a href="https://vk.com/id<?php echo e($user->user_id); ?>" target="_blank" class="d-flex align-center">
	        <svg class="icon small">
	          <use xlink:href="/img/symbols.svg#icon-vkontakte"></use>
	        </svg>
	        <span>VKontakte</span>
	      </a>-->
	    </div>
	    <div class="profile__avatar d-flex justify-center align-center">
	      <div class="profile__avatar-ellipse d-flex justify-center align-center">
	        <div class="profile__avatar-img" style="background: url(<?php echo e($user->avatar); ?>) no-repeat center center / cover;"></div>
	      </div>
	    </div>
	    <div class="profile__username d-flex flex-column align-center justify-center">
	      <b style="<?php if($user->style > 0): ?> <?php echo e(\App\Styles::where('id', $user->style)->first()->css); ?> <?php endif; ?>">
	      	<?php echo e($user->username); ?>

	      </b>
	      <span>Id: <?php echo e($user->id); ?></span>
	    </div>

	  </div>
	  <div class="profile__stats">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Rank</b>
	      <span id="rank">?</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>(%) wins</b>
	      <span id="winrate">0 %</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Betting amount</b>
	      <span id="betsum">0.00</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span id="allbets">0</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total wins</b>
	      <span id="count_win">0</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total losses</b>
	      <span id="count_lose">0</span>
	    </div>
	  </div>
	</div>
	<div class="profile__stats history__mod" data-mod="jackpot">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Jackpot</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\JackpotBets::where('user_id', $user->id)->distinct('game_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\Jackpot::where(['winner_id' => $user->id])->where('status', 3)->max('winner_balance') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span>&mdash;</span>
	    </div>
	  </div>
	<div class="profile__stats history__mod" data-mod="Wheel">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Wheel</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\WheelBets::where('user_id', $user->id)->distinct('game_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\WheelBets::where('user_id', $user->id)->max('win_sum') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span>&mdash;</span>
	    </div>
	  </div>
	<div class="profile__stats history__mod" data-mod="Crash">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Crash</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\CrashBets::where('user_id', $user->id)->distinct('round_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\CrashBets::where('user_id', $user->id)->where('status', 1)->max('won') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span><?php echo e(\App\CrashBets::where('user_id', $user->id)->where('status', 1)->max('withdraw') ?? 0); ?>x</span>
	    </div>
	  </div>
	<div class="profile__stats history__mod" data-mod="Battle">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Battle</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\BattleBets::where('user_id', $user->id)->distinct('game_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\BattleBets::where('user_id', $user->id)->where('win', 1)->max('win_sum') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span>&mdash;</span>
	    </div>
	  </div>
	<div class="profile__stats history__mod" data-mod="Dice">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Dice</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\Dice::where('user_id', $user->id)->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\Dice::where('user_id', $user->id)->max('win_sum') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span>&mdash;</span>
	    </div>
	  </div>
	<div class="profile__stats history__mod" data-mod="Hilo">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>HiLo</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\HiloBets::where('user_id', $user->id)->distinct('game_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\HiloBets::where('user_id', $user->id)->max('win_sum') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span><?php echo e(\App\HiloBets::where('user_id', $user->id)->where('win', 1)->max('bet_x') ?? 0); ?>x</span>
	    </div>
	  </div>
	  	<div class="profile__stats history__mod" data-mod="Tower">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Tower</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\Tower::where('user_id', $user->id)->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span>&mdash;</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span><?php echo e(\App\Tower::where('user_id', $user->id)->where('status', 1)->max('coeff') ?? 0); ?>x</span>
	    </div>
	  </div>
	  	<div class="profile__stats history__mod" data-mod="King">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>King</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\KingBets::where('user_id', $user->id)->distinct('game_id')->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\King::where('winner_id', $user->id)->max('bank') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span>&mdash;</span>
	    </div>
	  </div>
	  	<div class="profile__stats history__mod" data-mod="Mines">
	  	<div class="profile__stat-item d-flex flex-column">
	      <b>Mode</b>
	      <span>Mines</span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Total games</b>
	      <span><?php echo e(\App\Mines::where('id_users', $user->id)->count()); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Bests win</b>
	      <span><?php echo e(\App\Mines::where('id_users', $user->id)->max('result') ?? 0); ?></span>
	    </div>
	    <div class="profile__stat-item d-flex flex-column">
	      <b>Best coefficient.</b>
	      <span><?php echo e(\App\Mines::where('id_users', $user->id)->max('total') ?? 0); ?>x</span>
	    </div>
	  </div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.profile__stats:not(.history__mod) > .profile__stat-item span').html('<div class="loader">Loading...</div>');
			$.post('/getUser', {
				id: "<?php echo e($user->unique_id); ?>"
			})
			.then(res => {
				$('#rank').html((res['info'].rank == 'Отсутствует') ? 'Отсутствует' : '<img style="height: 25px; margin: 0 3px 0 0;" data-toggle="tooltip" data-placement="top" src="'+ res['info'].rank +'" data-original-title="'+ res['info']['rank_title'] +'">')
				$('#winrate').html(Number(res['info'].wins / res['info'].totalGames * 100).toFixed(2)+' %')
				$('#betsum').html(res['info'].betAmount+' <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg>')
				$('#allbets').html(res['info'].totalGames)
				$('#count_win').html(res['info'].wins)
				$('#count_lose').html(res['info'].lose)
			})
			.fail(err => {
		        $.notify({
		            type: 'error',
		            message: "Error during data loading"
		        });
			})
		})
	</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/profile.blade.php */ ?>