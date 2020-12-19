@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>Lista de {{strtolower($title)}}
			</div>

			
		</div>

		<div class="portlet-body">

			<a href="{{route('create-tipos-transacciones')}}" class="btn btn-sm btn-success margin-bottom-20">
				<i class="fa fa-plus" aria-hidden="true"></i>
				{{__('msj.str_add')}}
			</a>

			@if(!is_null($records) && count($records) > 0)
				<div class="table-responsive">
					<table class="table table-bordered" id="ecr-table">
						<thead class="thead-light">
							<tr class="active">
								
								<th>Nombre</th>
								<th>Operación</th>
								<th>{{__('msj.str_actions')}}</th>
							</tr>
						</thead>

						<tbody>
							@foreach($records as $key)
								<tr>
									<td><a href="{{route('edit-tipos-transacciones',[$key->id])}}">{{$key->nombre}}</a></td>
									
									<td>
										@if($key->operacion == "-")
											Resta
										@else
											Suma
										@endif
									</td>
									
									<td>
										<a href="{{route('edit-tipos-transacciones',[$key->id])}}" class="btn btn-xs btn-warning">
											{{__('msj.str_edit')}}
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{-- $records->links() --}}
			@else
				@include('layouts/empty-records')
			@endif
		</div>
	</div>

@endsection