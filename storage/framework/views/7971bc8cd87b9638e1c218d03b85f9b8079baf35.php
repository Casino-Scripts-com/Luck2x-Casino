

<?php $__env->startSection('content'); ?>
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
            <div class="info"><span>You have <b><?php echo e(number_format(floor(Auth::User()->bsum / 10), 2, '.', '')); ?> points</span></div>
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
										<?php $__currentLoopData = $ranks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td>
												<div class="col-sm-4 col-lg-3 text-left col-4 ranks__item" style="justify-content: left;">
													<div class="ranks__item-rank">
														<div class="ranks__item-rank-image">
															<img src="<?php echo e($rank['icon']); ?>" alt="<?php echo e($rank['title']); ?>">
														</div> 
													<div class="ranks__item-rank-name"><?php echo e($rank['title']); ?></div>
													</div>
												</div>
											</td>
											<td style="font-weight: 600;"><?php echo e($rank['points']); ?></td>
											<td><?php echo e($rank['bonus']); ?> <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></td>
											<?php if(Auth::User()): ?>
											<?php if(in_array(Auth::User()->id, $rank['ids'])): ?>
												<td><?php if(Auth::User()->rank == $rank['id']): ?> Selected <?php else: ?>
													<button type="button" class="btn" onclick="location.href=`/rank/select/<?php echo e($rank['id']); ?>`;">Select</button>
													<?php endif; ?>
												</td>
											<?php else: ?>
												<?php if(floor(Auth::User()->bsum / 10) >= $rank['points']): ?>
												<td><button type="button" class="btn" onclick="location.href=`/rank/claim/<?php echo e($rank['id']); ?>`;">Get</button></td>
												<?php else: ?>
												<td>Not enough points</td>
												<?php endif; ?>
											<?php endif; ?>
											<?php else: ?>
											<td>Authorise</td>
											<?php endif; ?>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/ranks.blade.php */ ?>