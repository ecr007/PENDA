@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>Lista de {{strtolower($title)}}
			</div>

			
		</div>

		<div class="portlet-body">

			<a href="{{route('create-cuentas')}}" class="btn btn-sm btn-success margin-bottom-20">
				<i class="fa fa-plus" aria-hidden="true"></i>
				{{__('msj.str_add')}}
			</a>

			@if(!is_null($records) && count($records) > 0)
				<div class="table-responsive">
					<table class="table table-bordered" id="ecr-table-fecha">
						<thead class="thead-light">
							<tr class="active">
								
								<th>Cliente</th>
								<th>Numero</th>
								<th>Balance</th>
								<th>Fecha de apertura</th>
								<th>{{__('msj.str_actions')}}</th>
							</tr>
						</thead>

						<tbody>
							@foreach($records as $key)
								<tr>
									<td>
										<a href="{{route('show-cuentas',[$key->id])}}">
											{{$key->socio->nombre}} {{$key->socio->apellido}}
										</a>
									</td>
									
									<td>{{$key->numero}}</td>
									<td>RD${{number_format($key->balance,2,".",",")}}</td>
									<td>{{date("d/m/Y",strtotime($key->created_at))}}</td>
									
									<td>
										<a href="{{route('show-cuentas',[$key->id])}}" class="btn btn-xs btn-warning">
											Ver
										</a>


										<a href="{{route('destroy-cuentas',[$key->id])}}" class="btn btn-xs btn-danger">
											{{__('msj.str_delete')}}
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