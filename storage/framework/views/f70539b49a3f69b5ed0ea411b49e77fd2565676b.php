

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/profileHistory.css">
<link rel="stylesheet" href="/css/free.css">
<link rel="stylesheet" href="/css/tournament.css?v=<?php echo e(time()); ?>">
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
				.user-info {
					justify-content: flex-start;
				}
        	</style>
		      	<div class="dailyFree_dailyFree">
			        <div class="quest-banner daily" style="border-bottom: 4px solid #8baf51;">
			        	<div class="tour__title">
			        		<div class="description">
			        			<div class="tour__logo">
			        				<img src="/img/cup.png">
			        				<span class="title">Tournament</span>
			        			</div>
			        		</div>
			        		<span class="sm_desc">
			        			<p>Place your bets to enter the tournament!</p>
			        			<p>The first <?php echo e($winners); ?> will share a prize pool of <?php echo e($reward); ?>€</p>
			        		</span>
			        		<div class="reward">
			        			<span class="prize"><?php echo e($reward); ?>€</span>
			        			<span class="description">Prize pool</span>
			        		</div>
			        	</div>
			        </div>
			    <div class="tournament-info__settings">
			    <?php if($is_active == 1): ?>
			  	
				  <div class="tournament-info__settings-item tournament-info__settings-item_places">
				    <div class="tournament-info__settings-item-value">
				      <span><?php echo e($reward); ?>€</span>
				    </div>
				    <div class="tournament-info__settings-item-text">Prize pool</div>
				  </div>
				  <div class="tournament-info__settings-item tournament-info__settings-item_users">
				    <div class="tournament-info__settings-item-value">
				      <span><?php echo e($winners); ?></span>
				    </div>
				    <div class="tournament-info__settings-item-text">Winners</div>
				  </div>
				  <div class="tournament-info__settings-item tournament-info__settings-item_users">
				    <div class="tournament-info__settings-item-value">
				      <span><?php echo e($duration); ?></span>
				    </div>
				    <div class="tournament-info__settings-item-text">Duration</div>
				  </div>
				  <div class="tournament-info__settings-item tournament-info__settings-item_users">
				    <div class="tournament-info__settings-item-value">
				      <span><?php echo e($endIn); ?></span>
				    </div>
				    <div class="tournament-info__settings-item-text">Ending in</div>
				  </div>
				<?php else: ?>
				  <div class="tournament-info__settings-item tournament-info__settings-item_users">
				    <div class="tournament-info__settings-item-value">
				      <span style="font-size:12px">Stand by for news on the next tournament!</span>
				    </div>
				    <div class="tournament-info__settings-item-text">The tournament is over!</div>
				  </div>
				<?php endif; ?>
				</div>
				<?php if($is_active == 1): ?>
	            <div class="history_wrapper with">
	                <div class="withPager">
	                    <div class="">
	                    	<div class="history_scroll">
								<table class="history_table" style="text-align: center;">
									<thead>
										<tr>
											<th>#</th>
											<th style="text-align: left;">Player</th>
											<th>Amount of bets</th>
											<th>Prize</th>
										</tr>
									</thead>
									<tbody style="text-align: center;">
										<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php if($us['position'] > 3): ?> <?php echo e($us['position']); ?> <?php else: ?> <img src="/img/place-<?php echo e($us['position']); ?>.svg" style="width:24px"> <?php endif; ?></td>
											<td>
											  <div class="tournament-table__col tournament-table__col_user">
											    <div class="user-info">
											      <div class="user-info__avatar">
											        <div class="user-info__avatar-image">
											          <img src="<?php echo e($us['avatar']); ?>" alt="<?php echo e($us['username']); ?>">
											        </div>
											        <!---->
											      </div>
											      <div class="user-info__name user-link" data-id="<?php echo e($us['unique_id']); ?>" style="cursor: pointer;<?php echo e($us['style']); ?>"><?php echo e($us['username']); ?></div>
											    </div>
											  </div>
											</td>
											<td><?php echo e($us['bets']); ?>€</td>
											<td><?php echo e($us['reward']); ?>€</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
	                        </div>
	                    </div>
	                </div>
            	</div>
            	<?php endif; ?>
    		</div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/tournament.blade.php */ ?>