@extends('panel')

@section('content')
<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Promo codes</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-menu-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
				List of promo codes
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
						<th>Type</th>
						<th>Code</th>
						<th>Limit</th>
						<th>Amount</th>
						<th>Packs</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($promos as $code)
					<tr>
						<td>{{$code->id}}</td>
						<td>{{$code->type == 'balance' ? 'Balance' : 'Bonus'}}</td>
						<td>{{$code->code}}</td>
						<td>{{$code->limit ? 'By number' : 'No limit'}}</td>
						<td>{{$code->amount}}р.</td>
						<td>{{$code->count_use}}</td>
						<td><a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Редактировать" data-toggle="modal" href="#edit_{{$code->id}}"><i class="la la-edit"></i></a><a href="/panel/promo/delete/{{$code->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a></td>
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
                <h5 class="modal-title" id="exampleModalLongTitle">New promo code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/panel/promo/new">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Code (English characters only):</label>
						<input type="text" class="form-control" placeholder="Код" name="code">
					</div>
					<div class="form-group">
						<label for="name">Type:</label>
						<select class="form-control" name="type">
							<option value="balance">Balance</option>
							<option value="bonus">Bonus</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Limit:</label>
						<select class="form-control" name="limit">
							<option value="0">No limit</option>
							<option value="1">By number</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Amount:</label>
						<input type="text" class="form-control" placeholder="Amount" name="amount">
					</div>
					<div class="form-group">
						<label for="name">Number of activations (With limit enabled):</label>
						<input type="text" class="form-control" placeholder="Кол-во" name="count_use">
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
@foreach($promos as $code)
<div class="modal fade" id="edit_{{$code->id}}" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit a promo code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" action="/panel/promo/save">
				<input type="hidden" value="{{$code->id}}" name="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Code (English characters only):</label>
						<input type="text" class="form-control" placeholder="Код" name="code" value="{{$code->code}}">
					</div>
					<div class="form-group">
						<label for="name">Type:</label>
						<select class="form-control" name="type">
							<option value="balance" {{$code->type == 'balance' ? 'selected' : ''}}>Balance</option>
							<option value="bonus" {{$code->type == 'bonus' ? 'selected' : ''}}>Bonus</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Лимит:</label>
						<select class="form-control" name="limit">
							<option value="0" {{$code->limit == 0 ? 'selected' : ''}}>No limit</option>
							<option value="1" {{$code->limit == 1 ? 'selected' : ''}}>By number</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Amount:</label>
						<input type="text" class="form-control" placeholder="Amount" name="amount" value="{{$code->amount}}">
					</div>
					<div class="form-group">
						<label for="name">Number of activations (With limit enabled):</label>
						<input type="text" class="form-control" placeholder="Packs" name="count_use" value="{{$code->count_use}}">
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
@endforeach
@endsection