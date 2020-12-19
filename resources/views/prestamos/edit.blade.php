@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>{{$title}}
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('update-prestamos',[$record->id]) }}">
				@csrf

				
				<div class="form-body">

					<div class="form-group">
						<label for="socio" class="control-label">Seleccionar socio:</label>

						<div class="">
							<select name="socio" id="socio" class="form-control" required >
								<option value="">Seleccionar...</option>

								@foreach($socios as $key)
									<option value="{{$key->id}}" @if($record->socio_id == $key->id) selected @endif >{{$key->nombre}} | Cedula: {{$key->cedula}}</option>
								@endforeach
							</select>

							@error('socio')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>


					<div class="form-group">
						<label for="balance" class="control-label">Balance a prestar:</label>

						<div class="">
							<input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ $record->balance_sin_intereses }}" required autocomplete="balance" autofocus>

							@error('apellido')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="tasa_interes" class="control-label">Tasa de interes anual:</label>

						<div class="">
							<select name="tasa_interes" id="tasa_interes" class="form-control" required>
								<option value="">Seleccionar...</option>

								@foreach([10,12,18,24,30] as $key)
									<option value="{{$key}}" @if($record->tasa == $key) selected @endif >{{$key}}% anual</option>
								@endforeach
							</select>

							@error('tasa_interes')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="tiempo" class="control-label">Tiempo para pagar:</label>

						<div class="">
							<select name="tiempo" id="tiempo" class="form-control" required>
								<option value="">Seleccionar...</option>

								@foreach([1,2,3,4,5] as $key)
									<option value="{{$key}}" @if( ($record->cuotas_restantes/12) == $key) selected @endif >{{$key}} años</option>
								@endforeach
							</select>

							@error('tiempo')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-sm btn-primary">Guardar</button>

					&nbsp;&nbsp;&nbsp;
					<a href="{{route('prestamos')}}" class="btn btn-sm btn-warning">Atras</a>
				</div>
			</form>
		</div>
	</div>
@endsection