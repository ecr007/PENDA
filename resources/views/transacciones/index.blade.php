@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>Lista de {{strtolower($title)}}
			</div>

			
		</div>

		<div class="portlet-body">

			@if(!is_null($records) && count($records) > 0)
				<div class="table-responsive">
					<table class="table table-bordered" id="ecr-table">
						<thead class="thead-light">
							<tr class="active">
								
								<th>Tipo</th>
								<th>Cuenta</th>
								<th>Prestamo</th>
								<th>Monto</th>
								<th>Fecha</th>
							</tr>
						</thead>

						<tbody>
							@foreach($records as $key)
								<tr>
									<td>{{$key->tipo->nombre}}</td>
									
									<td>
										@if(is_null($key->cuenta_id))
											<span class="badge badge-danger">No</span>
										@else
											{{$key->cuenta->numero}}
										@endif
									</td>

									<td>
										@if(is_null($key->prestamo_id))
											<span class="badge badge-danger">No</span>
										@else
											{{$key->prestamo->numero}}
										@endif
									</td>

									<td>{{$key->tipo->operacion}} RD${{number_format($key->monto,2,".",",")}}</td>
									
									<td>{{date("d/m/Y H:i:s",strtotime($key->created_at))}}</td>
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