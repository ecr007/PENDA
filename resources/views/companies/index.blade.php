@extends('layouts/app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">{{$title}}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group">
				<a href="{{route('create-companies')}}" class="btn btn-outline-success">
					<i class="fa fa-plus" aria-hidden="true"></i>
					{{__('msj.str_add')}}
				</a>
			</div>
		</div>
	</div>

	<div class="mt-3">
		@if(!is_null($records) && count($records) > 0)
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th>{{__('msj.str_name')}}</th>
							<th>{{__('msj.str_status')}}</th>
							<th>{{__('msj.str_logo')}}</th>
							<th>{{__('msj.str_actions')}}</th>
						</tr>
					</thead>

					<tbody>
						@foreach($records as $key)
							<tr>
								<td><a href="{{route('edit-companies',[$key->id])}}" class="primary-link">{{$key->name}}</a></td>
								
								<td>
									@if($key->status == 1)
										<span class="badge badge-pill badge-success">{{__('msj.str_activated')}}</span>
									@else
										<span class="badge badge-pill badge-danger">{{__('msj.str_disabled')}}</span>
									@endif
								</td>

								<td>
									<a href="#" class="btn btn-sm btn-outline-primary gathr-open-modal" data-title="{{$key->name}}" data-img="{{$key->logo}}">
										{{__('msj.str_view_image')}}
									</a>
								</td>

								<td>
									<a href="{{route('edit-companies',[$key->id])}}" class="btn btn-sm btn-outline-warning">
										{{__('msj.str_edit')}}
									</a>

									<a href="{{route('destroy-companies',[$key->id])}}" class="btn btn-sm btn-outline-danger">
										{{__('msj.str_delete')}}
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			{{$records->links()}}
		@else
			@include('layouts/empty-records')
		@endif
	</div>

@endsection