

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
										<?php $__currentLoopData = $clans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php if($clan['position'] > 3): ?> <?php echo e($clan['position']); ?> <?php else: ?> <img src="/img/place-<?php echo e($clan['position']); ?>.svg" style="width:24px"> <?php endif; ?></td>
											<td>
											  <div class="tournament-table__col tournament-table__col_user">
											    <div class="user-info">
											      <div class="user-info__avatar">
											        <div class="user-info__avatar-image">
											          <img src="<?php echo e($clan['avatar']); ?>" alt="<?php echo e($clan['name']); ?>" style="max-width:20px;min-width:20px;max-height:20px;min-height:20px;">
											        </div>
											        <!---->
											      </div>
											      <div class="user-info__name" style="cursor: pointer;"><?php echo e($clan['name']); ?></div>
											    </div>
											  </div>
											</td>
											<td><?php echo e($clan['members']); ?> / 100</td>
											<td><?php echo e($clan['points']); ?></td>
                                            <td><button type="button" class="btn" onclick="location.href='/clan/<?php echo e($clan['id']); ?>';">Go to</button></td>
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
<?php /* /var/www/html/resources/views/pages/clans.blade.php */ ?>