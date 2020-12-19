@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>Lista de {{strtolower($title)}}
			</div>

			
		</div>

		<div class="portlet-body">

			<a href="{{route('create-prestamos')}}" class="btn btn-sm btn-success margin-bottom-20">
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
								<th>Tasa</th>
								<th>Sin interes</th>
								<th>Balance</th>
								<th>Cuota restantes</th>
								<th>Cuota mensual</th>
								<th>Fecha de apertura</th>
								<th>Estatus</th>
								<th>{{__('msj.str_actions')}}</th>
							</tr>
						</thead>

						<tbody>
							@foreach($records as $key)
								<tr>
									<td>
										@if($key->status == 0)
											{{$key->socio->nombre}} {{$key->socio->apellido}}
										@else
											<a href="{{route('show-prestamos',[$key->id])}}">
												{{$key->socio->nombre}} {{$key->socio->apellido}}
											</a>
										@endif
									</td>
									
									<td>{{$key->numero}}</td>

									<td>{{$key->tasa}}%</td>

									<td>RD${{number_format($key->balance_sin_intereses,2,".",",")}}</td>

									<td>RD${{number_format($key->balance,2,".",",")}}</td>

									<td>
										@if($key->cuotas_restantes == 0)
											<span class="badge badge-success">FINALIZADO</span>
										@else
											<span class="badge badge-warning">{{$key->cuotas_restantes}}</span>
										@endif
									</td>

									<td>RD${{number_format($key->monto_cuota,2,".",",")}}</td>
									
									<td>{{date("d/m/Y",strtotime($key->created_at))}}</td>

									<td>
										@if($key->status == 0)
											<span class="badge badge-danger">No aprobado</span>
										@else
											<span class="badge badge-success">Aprobado</span>
										@endif
									</td>
									
									<td>
										@if($key->status == 0)
											<a href="{{route('aprobar-prestamos',[$key->id])}}" class="btn btn-xs btn-success">
												Aprobar
											</a>
											
											&nbsp;&nbsp;&nbsp;
											
											<a href="{{route('edit-prestamos',[$key->id])}}" class="btn btn-xs btn-warning">
												{{__('msj.str_edit')}}
											</a>

											&nbsp;&nbsp;&nbsp;
											<a href="{{route('destroy-prestamos',[$key->id])}}" class="btn btn-xs btn-danger">
												{{__('msj.str_delete')}}
											</a>
										@else
											<a href="{{route('show-prestamos',[$key->id])}}" class="btn btn-xs btn-warning">
												Ver
											</a>
										@endif
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