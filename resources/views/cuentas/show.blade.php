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
					<h3>Datos de la cuenta</h3>
					
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th class="active">Balance a la fecha:</th>
								<td>RD${{number_format($record->balance,2,".",",")}}</td>
							</tr>

							<tr>
								<th class="active">Número:</th>
								<td>{{$record->numero}}</td>
							</tr>
						</tbody>	
					</table>
				</div>
			</div>

			<hr>

			<h3>Ultimas transacciones</h3>

			<a href="{{route('create-cuenta-transacciones',[$record->id])}}" class="btn btn-xs btn-success" style="margin-bottom: 30px;">Nueva transacción</a>

			<table class="table table-bordered" id="ecr-table">
				<thead class="thead-light">
					<tr class="active">
						
						<th>Tipo</th>
						<th>Cuenta</th>
						<th>Monto de la transacción</th>
						<th>Fecha</th>
					</tr>
				</thead>

				<tbody>
					@foreach($record->transacciones()->orderBy('created_at','desc')->get() as $key)
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
				<a href="{{route('cuentas')}}" class="btn btn-sm btn-warning">Atras</a>
			</div>
		</div>
	</div>
@endsection







