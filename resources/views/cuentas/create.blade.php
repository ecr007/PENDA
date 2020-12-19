@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('store-cuentas') }}">
				@csrf

				<div class="form-body">
					<div class="form-group">
						<label for="socio" class="control-label">Seleccionar socio:</label>

						<div class="">
							<select name="socio" id="socio" class="form-control" required>
								<option value="">Seleccionar...</option>

								@foreach($socios as $key)
									<option value="{{$key->id}}">{{$key->nombre}} | Cédula: {{$key->cedula}}</option>
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
						<label for="balance" class="control-label">Balance inicial:</label>

						<div class="">
							<input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ old('balance') }}" required autocomplete="balance" autofocus>

							@error('apellido')
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
					<a href="{{route('cuentas')}}" class="btn btn-sm btn-warning">Atras</a>
				</div>
			</form>
		</div>
	</div>
@endsection