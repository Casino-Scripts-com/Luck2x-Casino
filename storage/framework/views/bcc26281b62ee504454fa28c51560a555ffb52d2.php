

<?php $__env->startSection('content'); ?>
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Giveaways</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-hourglass-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
				Handout list
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a data-toggle="modal" href="#new" class="btn btn-success btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add.
						</a>
					</div>	
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="dtable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Amount</th>
						<th>End time</th>
						<th>Winner</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $giveaway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($gv->id); ?></td>
						<td><?php echo e($gv->sum); ?>€. (invoice: <?php echo e($gv->type == 'balance' ? 'Real' : 'Bonus'); ?>)</td>
						<td><?php echo e(\Carbon\Carbon::parse($gv->time_to)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s')); ?></td>
						<td><?php if($gv->winner_id): ?><a href="/admin/user/<?php echo e($gv->winner_id); ?>"><?php endif; ?><?php echo e(($gv->winner_id ? \App\User::getUser($gv->winner_id)->username : 'Unspecified')); ?><?php if($gv->winner_id): ?></a><?php endif; ?></td>
						<td><a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-toggle="modal" href="#edit_<?php echo e($gv->id); ?>"><i class="la la-edit"></i></a><a href="/admin/giveaway/delete/<?php echo e($gv->id); ?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New giveaway</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/admin/giveaway/new">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Giveaway amount:</label>
						<input type="text" class="form-control" placeholder="Amount" name="sum">
					</div>
					<div class="form-group">
						<label for="name">Balance type:</label>
						<select class="form-control" name="type">
							<option value="balance">Real</option>
							<option value="bonus">Bonus</option>
						</select>
					</div>
					<div class="form-group">
						<label>Checks:</label>
						<div class="kt-checkbox-inline">
							<label class="kt-checkbox">
								<input type="checkbox" name="group_sub"> Check group subscriptions
								<span></span>
							</label>
							<label class="kt-checkbox">
								<input type="checkbox" class="minCheck"> Check the current day's replenishment amount
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group checkedDep" style="display: none;">
						<label for="name">Minimum replenishment amount for the current day:</label>
						<input type="text" class="form-control" placeholder="Amount" name="min_dep">
					</div>
					<div class="form-group">
						<label>End time:</label>
						<input type="text" class="form-control kt_datetimepicker" readonly data-z-index="1100" placeholder="Select date and time" name="time_to" />
					</div>
					<div class="form-group">
						<label for="name">Winner's choice:</label>
						<select class="form-control" name="winner_id">
							<option value="null">No</option>
							<option disabled style="background: #5867dd; color: #fff;">--- Fakes ---</option>
							<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($fk->id); ?>"><?php echo e($fk->username); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add.</button>
				</div>
            </form>
        </div>
    </div>
</div>
<?php $__currentLoopData = $giveaway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="edit_<?php echo e($gv->id); ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editing a giveaway</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/admin/giveaway/save">
				<input type="hidden" value="<?php echo e($gv->id); ?>" name="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Giveaway amount:</label>
						<input type="text" class="form-control" placeholder="Amount" name="sum" value="<?php echo e($gv->sum); ?>">
					</div>
					<div class="form-group">
						<label for="name">Balance type:</label>
						<select class="form-control" name="type">
							<option value="balance" <?php echo e($gv->type == 'balance' ? 'selected' : ''); ?>>Real</option>
							<option value="bonus" <?php echo e($gv->type == 'bonus' ? 'selected' : ''); ?>>Bonus</option>
						</select>
					</div>
					<div class="form-group">
						<label>Checks:</label>
						<div class="kt-checkbox-inline">
							<label class="kt-checkbox">
								<input type="checkbox" name="group_sub" <?php echo e($gv->group_sub ? 'checked' : ''); ?>> Check group subscriptions
								<span></span>
							</label>
							<label class="kt-checkbox">
								<input type="checkbox" class="minCheck" <?php echo e($gv->min_dep > 0 ? 'checked' : ''); ?>> Check the current day's replenishment amount
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group checkedDep" style="display: <?php echo e($gv->min_dep > 0 ? 'block' : 'none'); ?>;">
						<label for="name">Minimum replenishment amount for the current day:</label>
						<input type="text" class="form-control" placeholder="Amount" value="<?php echo e($gv->min_dep); ?>" name="min_dep">
					</div>
					<div class="form-group">
						<label>End time:</label>
						<input type="text" class="form-control kt_datetimepicker" value="<?php echo e(\Carbon\Carbon::parse($gv->time_to)->setTimezone('Europe/Moscow')->format('d.m.Y H:i')); ?>" readonly data-z-index="1100" placeholder="Select date and time" name="time_to" />
					</div>
					<div class="form-group">
						<label for="name">Winner's choice:</label>
						<select class="form-control" name="winner_id">
							<option value="null">No</option>
							<option disabled style="background: #5867dd; color: #fff;">--- Members ---</option>
							<?php $__currentLoopData = \App\GiveawayUsers::where('giveaway_id', $gv->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gvu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($gvu->user_id); ?>" <?php echo e($gv->winner_id == $gvu->user_id ? 'selected' : ''); ?>><?php echo e(\App\User::getUser($gvu->user_id)->username); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<option disabled style="background: #5867dd; color: #fff;">--- Fakes ---</option>
							<?php $__currentLoopData = $fake; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($fk->id); ?>" <?php echo e($gv->winner_id == $fk->id ? 'selected' : ''); ?>><?php echo e($fk->username); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#edit_<?php echo e($gv->id); ?> .minCheck').click(function() {
        if($(this).prop('checked') == true){
            $('#edit_<?php echo e($gv->id); ?> .minCheck').parent().parent().parent().parent().find('.checkedDep').slideDown();
        } else {
            $('#edit_<?php echo e($gv->id); ?> .minCheck').parent().parent().parent().parent().find('.checkedDep').slideUp();
        }
    });
});
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/admin/giveaway.blade.php */ ?>