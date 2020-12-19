@extends('layouts/app')

@section('content')

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>{{$title}}
			</div>
		</div>

		<div class="portlet-body">
			<form method="post" enctype="multipart/form-data" action="{{ route('update-tipos-transacciones',[$record->id]) }}">
				@csrf

				
				<div class="form-body">
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
						<label for="operacion" class="control-label">Operación aritmética</label>

						<div class="">
							<select name="operacion" id="operacion" class="form-control">
								<option value="">Seleccionar...</option>
								<option value="+" @if($record->operacion == '+') selected @endif >Suma</option>
								<option value="-" @if($record->operacion == '-') selected @endif >Resta</option>
							</select>

							@error('operacion')
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
					<a href="{{route('tipos-transacciones')}}" class="btn btn-sm btn-warning">Atras</a>
				</div>
			</form>
		</div>
	</div>
@endsection