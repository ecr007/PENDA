@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>{{$title}}
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('update-cuentas',[$record->id]) }}">
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
						<label for="nombre" class="control-label">Nombre:</label>

						<div class="">
							<input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $record->nombre }}" required autocomplete="nombre" autofocus>

							@error('nombre')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="apellido" class="control-label">Apellido:</label>

						<div class="">
							<input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $record->apellido }}" required autocomplete="apellido" autofocus>

							@error('apellido')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="cedula" class="control-label">Cédula:</label>

						<div class="">
							<input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ $record->cedula }}" required autocomplete="cedula" autofocus>

							@error('cedula')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="telefono" class="control-label">Teléfono:</label>

						<div class="">
							<input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $record->telefono }}" required autocomplete="telefono" autofocus>

							@error('telefono')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="celular" class="control-label">Celular:</label>

						<div class="">
							<input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ $record->celular }}" required autocomplete="celular" autofocus>

							@error('celular')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="provincia" class="control-label">Provincia</label>

						<div class="">
							<select name="provincia" id="provincia" class="form-control get-data" required data-route="{{route('municipios')}}" data-des="municipio">
								<option value="">Seleccionar...</option>

								@foreach($provincias as $key)
									<option value="{{$key->id}}" @if($record->provincia == $key->id) selected @endif >{{$key->nombre}}</option>
								@endforeach
							</select>

							@error('provincia')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="municipio" class="control-label">Municipio</label>

						<div class="">
							<select name="municipio" id="municipio" class="form-control" required>
								<option value="">Seleccionar...</option>

								@foreach($municipios as $key)
									<option value="{{$key->id}}" @if($record->municipio == $key->id) selected @endif >{{$key->nombre}}</option>
								@endforeach
							</select>

							@error('municipio')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="direccion" class="control-label">Direccion:</label>

						<div class="">
							<textarea name="direccion" id="direccion" class="form-control">{{ $record->direccion }}</textarea>

							@error('direccion')
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
					<a href="{{route('cuentas')}}" class="btn btn-sm btn-warning">Atras</a>
				</div>
			</form>
		</div>
	</div>
@endsection