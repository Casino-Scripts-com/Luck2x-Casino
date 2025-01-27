

<?php $__env->startSection('content'); ?>
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Word filter</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-protected"></i>
				</span>
				<h3 class="kt-portlet__head-title">
				Filter list
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
						<th>Filter</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($f->id); ?></td>
						<td><?php echo e($f->word); ?></td>
						<td><a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-toggle="modal" href="#edit_<?php echo e($f->id); ?>"><i class="la la-edit"></i></a><a href="/admin/filter/delete/<?php echo e($f->id); ?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a></td>
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
                <h5 class="modal-title" id="exampleModalLongTitle">New filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/admin/filter/new">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Filter:</label>
						<input type="text" class="form-control" placeholder="Filter" name="word">
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
<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="edit_<?php echo e($f->id); ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editing a filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/admin/filter/save">
				<input type="hidden" value="<?php echo e($f->id); ?>" name="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Filter:</label>
						<input type="text" class="form-control" placeholder="Filter" name="word" value="<?php echo e($f->word); ?>">
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/admin/filter.blade.php */ ?>