<?php $__env->startSection('content'); ?>
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Styles</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-user"></i>
				</span>
				<h3 class="kt-portlet__head-title">
				Style list
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
						<th>Title</th>
						<th>Style</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $styles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($style['id']); ?></td>
						<td><?php echo e($style['title']); ?></td>
						<td style="<?php echo e($style['css']); ?>">TEST</td>
						<td><a href="/admin/styles/delete/<?php echo e($style['id']); ?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
<style>
.demo {
	text-shadow: 2px 2px 0 #f0f, 0 0 2px #0ff, 0 0 3px #0095ff, 0 0 4px #00f, 0 0 5px #8500ff, 0 0 6px #d800ff, 0 0 7px #f0f, 0 0 8px #c0f, 0 0 9px #00a1ff, 0 0 9px #00f;
	font-family: Open Sans,sans-serif;    
	cursor: pointer;
    font-weight: 700;
    color:#fff;
    font-size: 15px;
    letter-spacing: 0.7px;
} 
</style>
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Style</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
				<div class="modal-body">
          		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
         		 <div class="form-row">
					<div class="form-group col-12">
						<label for="name">Title:</label>
						<input type="text" class="form-control" placeholder="Unique style" name="prefix" id="style_title">
					</div>
					<div class="form-group col-12">
						<label for="name">CSS:</label>
						<input type="text" class="form-control color-pro" name="color_3" id="style_css" placeholder="background: ...">
					</div>
				 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary btn-add" onclick="addStyle();">Add.</button>
				</div>
        </div>
    </div>
</div>
<script>
function addStyle() {
	$.post('/admin/createStyle', {
		title: $('#style_title').val(),
		css: $('#style_css').val()
	}).then(e => {
		if(e.error) return $.notify({ type: 'error', message: e.msg });
		$('.btn-add').attr('disabled', true);
		setTimeout(()=>location.reload(true), 1500);
		return $.notify({ type: 'success', message: e.msg });
	}).fail(e => {
		//setTimeout(()=>location.reload(true), 1500);
		return $.notify({ type: 'error', message: 'Server-side error' });
	});
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/admin/styles.blade.php */ ?>