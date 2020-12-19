@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('store-prestamo-transacciones') }}">
				@csrf

				<div class="form-body">
					<div class="form-group">
						<label for="tipo_transaccion" class="control-label">Seleccionar tipo de transaccion:</label>

						<div class="">
							<select name="tipo_transaccion" id="tipo_transaccion" class="form-control" required>
								<option value="">Seleccionar...</option>

								@foreach($tipos as $key)
									@if($key->nombre == "pago" || $key->nombre == "Pago")
										<option value="{{$key->id}}">{{$key->nombre}}</option>
									@endif
								@endforeach
							</select>

							@error('tipo_transaccion')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="monto" class="control-label">Monto:</label>

						<div class="">
							<input id="monto" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" value="{{ $prestamo->monto_cuota }}" required readonly autocomplete="monto" autofocus>

							@error('monto')
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
					<a href="javascript:history.back();" class="btn btn-sm btn-warning">Atras</a>
				</div>

				<input type="hidden" name="prestamo_id" value="{{$prestamo->id}}">
			</form>
		</div>
	</div>
@endsection