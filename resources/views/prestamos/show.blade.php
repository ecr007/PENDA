@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-view"></i>
			</div>
		</div>

		<div class="portlet-body">
			<div class="row">
				<div class="col-sm-6">
					<h3>Datos del asociado</h3>
					
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th class="active">Nombre completo:</th>
								<td>{{$record->socio->nombre}} {{$record->socio->apellido}}</td>
							</tr>

							<tr>
								<th class="active">Cédula:</th>
								<td>{{$record->socio->cedula}}</td>
							</tr>

							<tr>
								<th class="active">Teléfono:</th>
								<td>{{$record->socio->telefono}}</td>
							</tr>

							<tr>
								<th class="active">Celular:</th>
								<td>{{$record->socio->celular}}</td>
							</tr>

							<tr>
								<th class="active">Provincia:</th>
								<td>{{$record->socio->provincias->nombre}}</td>
							</tr>

							<tr>
								<th class="active">Municipio:</th>
								<td>{{$record->socio->municipios->nombre}}</td>
							</tr>

							<tr>
								<th class="active">Dirección:</th>
								<td>{{$record->socio->direccion}}</td>
							</tr>
						</tbody>	
					</table>
				</div>

				<div class="col-sm-6">
					<h3>Datos del prestamo</h3>
					
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th class="active">Número:</th>
								<td>{{$record->numero}}</td>
							</tr>

							<tr>
								<th class="active">Balance sin intereses:</th>
								<td>RD${{number_format($record->balance_sin_intereses,2,".",",")}}</td>
							</tr>

							<tr>
								<th class="active">Balance a la fecha:</th>
								<td>RD${{number_format($record->balance,2,".",",")}}</td>
							</tr>

							<tr>
								<th class="active">Balance a inicial:</th>
								<td>RD${{number_format($record->balance_inicial,2,".",",")}}</td>
							</tr>

							<tr>
								<th class="active">Tasa de ineteres anual:</th>
								<td>{{$record->tasa}}%</td>
							</tr>

							<tr>
								<th class="active">Cuotas restantes:</th>
								<td>{{$record->cuotas_restantes}}</td>
							</tr>

							<tr>
								<th class="active">Monto a pagar mensulamente:</th>
								<td>RD${{number_format($record->monto_cuota,2,".",",")}}</td>
							</tr>

							<tr>
								<th class="active">Fecha de apertura:</th>
								<td>{{date("d/m/Y H:i:s",strtotime($record->created_at))}}</td>
							</tr>
						</tbody>	
					</table>
				</div>
			</div>

			<hr>

			<h3>Ultimas transacciones</h3>

			@if($record->cuotas_restantes > 0)
				<a href="{{route('create-prestamo-transacciones',[$record->id])}}" class="btn btn-xs btn-success" style="margin-bottom: 30px;">Nueva transacción</a>
			@endif

			<table class="table table-bordered" id="ecr-table">
				<thead class="thead-light">
					<tr class="active">
						
						<th>Tipo</th>
						<th>Prestamo</th>
						<th>Monto de la transacción</th>
						<th>Fecha</th>
					</tr>
				</thead>

				<tbody>
					@foreach($record->transacciones as $key)
						<tr>
							<td>{{$key->tipo->nombre}}</td>
							
							<td>{{$record->numero}}</td>

							<td>{{$key->tipo->operacion}} RD${{number_format($key->monto,2,".",",")}}</td>
							
							<td>{{date("d/m/Y H:i:s",strtotime($key->created_at))}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="form-actions">
				<a href="{{route('prestamos')}}" class="btn btn-sm btn-warning">Atras</a>
			</div>
		</div>
	</div>
@endsection







