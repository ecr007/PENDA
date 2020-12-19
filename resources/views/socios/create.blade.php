@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('store-socios') }}">
				@csrf

				<div class="form-body">
					<div class="form-group">
						<label for="nombre" class="control-label">Nombre:</label>

						<div class="">
							<input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

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
							<input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

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
							<input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

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
							<input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

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
							<input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus>

							@error('celular')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="provincia" class="control-label">Provincia:</label>

						<div class="">
							<select name="provincia" id="provincia" class="form-control get-data" required data-route="{{route('municipios')}}" data-des="municipio">
								<option value="">Seleccionar...</option>

								@foreach($provincias as $key)
									<option value="{{$key->id}}">{{$key->nombre}}</option>
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
						<label for="municipio" class="control-label">Municipio:</label>

						<div class="">
							<select name="municipio" id="municipio" class="form-control" required>
								<option value="">Seleccionar primero el municipio</option>
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
							<textarea name="direccion" id="direccion" class="form-control">{{ old('direccion') }}</textarea>

							@error('direccion')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-sm btn-primary">{{ __('msj.str_send') }}</button>
					&nbsp;&nbsp;&nbsp;
					<a href="{{route('socios')}}" class="btn btn-sm btn-warning">Atras</a>
				</div>
			</form>
		</div>
	</div>
@endsection