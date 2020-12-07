@extends('layouts/app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">{{$title}}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group">
				@if($trashed)
					<a href="{{route('users')}}" class="btn btn-outline-warning">
						<i class="fa fa-filter" aria-hidden="true"></i>
						Clear filter
					</a>
				@else
					<a href="{{route('users',['deleted_at'=>'ok'])}}" class="btn btn-outline-warning">
						<i class="fa fa-filter" aria-hidden="true"></i>
						View hide users
					</a>
				@endif
			</div>
		</div>
	</div>

	<div class="mt-3 mb-5">
		<div class="table-responsive">
			<table class="table table-bordered" id="gathr-dt-general" style="width: 100%">
				<thead class="thead-light">
					<tr>
						<th>Fullname</th>
						<th>Email</th>
						<th>Country</th>
						<th>Phone</th>
						<th>Status</th>
						<th>Events</th>
						<th>Profile pic</th>
						<th>{{__('msj.str_actions')}}</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

	@push('scripts')
		<script>
			window.DT = $('#gathr-dt-general').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "{{$link}}",
					"type": "GET",
					//"pageLength": 20,
					/*"data": function ( d ) {
		        		d.iso = $('.ecr-select-country').val();
		        		d.store_id = $('.ecr-select-store').val();
		        		d.device = $('.ecr-device').val();
		    		}*/
				},
				"columns": [
					{ "data": "fullname" },
					{ "data": "email" },
					{ "data": "flag" },
					{ "data": "phone" },
					{ "data": "badge_status" },
					{ "data": "event_count" },
					{ "data": "profile_pic" },
					{ "data": "delete", orderable: false, searchable: false },
					{ "data": "id", visible: false, searchable: true }
				],
				"order": [[ 8, "desc" ]],
				/*"drawCallback": function( settings ) {

					$('.ecr-btn-submit').prop('disabled',false);
					$('.ecr-btn-reset').prop('disabled',false);

					$.fn.tooltip && $('[rel="tooltip"]').tooltip();
				},*/
				"lengthMenu": [[25, 50, 75, 100, 150, 200], [25, 50, 75, 100, 150, 200]],
				"pageLength": 25
			});

			/*$(document).on( 'preXhr.dt', function (e, settings, data) {
				$('.loading-general').fadeIn();
			});

			$(document).on( 'xhr.dt', function ( e, settings, json, xhr ) {
				$('.loading-general').fadeOut();
			});*/
		</script>
	@endpush

@endsection