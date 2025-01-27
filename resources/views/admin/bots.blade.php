@extends('admin')

@section('content')
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Bots</h3>
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
				Bot list
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a data-toggle="modal" href="#new" class="btn btn-success btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add
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
						<th>User</th>
						<th>Betting time</th>
						<th>VK profile</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($bots as $bot)
					<tr>
						<td>{{$bot->id}}</td>
						<td><img src="{{$bot->avatar}}" style="width:26px;border-radius:50%;margin-right:10px;vertical-align:middle;">{{$bot->username}}</td>
						<td>{{ $bot->time == 0 ? 'All the time.' : '' }}{{ $bot->time == 1 ? 'In the morning (from 6am to 12am)' : '' }}{{ $bot->time == 2 ? 'In the afternoon (from 12pm to 18pm)' : '' }}{{ $bot->time == 3 ? 'In the evening (from 18pm to 00pm)' : '' }}{{ $bot->time == 4 ? 'At night (00am to 6am)' : '' }}</td>
						<td><a href="https://vk.com/id{{$bot->user_id}}" target="_blank">Go to</a></td>
						<td><a href="/admin/user/{{$bot->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit"></i></a><a href="/admin/bots/delete/{{$bot->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a></td>
					</tr>
					@endforeach
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
                <h5 class="modal-title" id="exampleModalLongTitle">Adding a bot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/admin/fakeSave" id="save">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Link to VK page</label>
						<input type="text" class="form-control" placeholder="https://vk.com/id..." name="name" id="url">
					</div>
					<div class="form-group">
						<label for="name">Betting time</label>
						<select class="form-control" name="time">
							<option value="1">In the morning (6am to 12am)</option>
							<option value="2">In the afternoon (from 12pm to 18pm)</option>
							<option value="3">In the evening (from 18pm to 00pm)</option>
							<option value="4">At night (00pm to 6pm)</option>
							<option value="0">All the time.</option>
						</select>
					</div>
					<div class="row" id="prof" style="display: none;">
						<div class="col-xl-12">
							<div class="kt-section__body">
								<input type="hidden" value="" name="vkId" id="vkId">
								<input type="hidden" value="" name="avatar" id="avatar">
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
									<div class="col-lg-9 col-xl-6">
										<div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
											<img class="kt-avatar__holder" id="ava" src=""/>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label">First Name Last Name</label>
									<div class="col-lg-9 col-xl-9">
										<input class="form-control" type="text" value="" name="name" id="name" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
            </form>
        </div>
    </div>
</div>
@endsection