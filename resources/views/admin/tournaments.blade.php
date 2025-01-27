@extends('admin')

@section('content')
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Tournaments</h3>
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
				Tournament list
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
						<td>Title</td>
						<td>Reward</td>
						<td>Prizes</td>
						<td>Participants</td>
						<td>Closing date</td>
						<td>Status</td>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tournaments as $tournament)
					<tr>
						<td>{{$tournament['id']}}</td>
						<td>{{$tournament['title']}}</td>
						<td>{{$tournament['reward']}}</td>
						<td>{{$tournament['members']}}</td>
						<td>{{$tournament['count']}}</td>
						<td>{{date('d-m-Y H:i:s', $tournament['end'])}}</td>
						<td>
							@if(time() >= $tournament['end'] && $tournament['status'] != 2)
							Waiting for prizes to be distributed
							@else 
								@if($tournament['status'] == 1) 
								Active 
								@else 
								Completed 
								@endif 
							@endif
						</td>
						<td>
							@if(time() < $tournament['end'] || $tournament['status'] == 2)
							<a href="/admin/tournaments/delete/{{$tournament['id']}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a>
							@endif
							@if(time() >= $tournament['end'] && $tournament['status'] != 2)
							<a href="/admin/tournaments/send/{{$tournament['id']}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Give out prizes"><i class="la la-check"></i></a>
							@endif
						</td>
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
                <h5 class="modal-title" id="exampleModalLongTitle">New tournament</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
				<div class="modal-body">
          		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
         		 <div class="form-row">
					<div class="form-group col-6">
						<label for="name">Title:</label>
						<input type="text" class="form-control" placeholder="Tournament" name="title" id="title">
					</div>
					<div class="form-group col-6">
						<label for="name">Prizes:</label>
						<input type="text" class="form-control color-pro" name="members" id="members" placeholder="10">
					</div>
					<div class="form-group col-6">
						<label for="name">Reward:</label>
						<input type="text" class="form-control color-pro" name="reward" id="reward" placeholder="10">
					</div>
					<div class="form-group col-6">
						<label for="name">Closing date:</label>
						<input type="text" class="form-control color-pro" name="endTime" id="endTime" placeholder="31.12.2021 23:59">
					</div>
				 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary btn-add" onclick="addRank();">Add.</button>
				</div>
        </div>
    </div>
</div>
<script>
function addRank() {
	$.post('/admin/createTournament', {
		title: $('#title').val(),
		members: $('#members').val(),
		reward: $('#reward').val(),
		endTime: $('#endTime').val()
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
@endsection