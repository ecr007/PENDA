@extends('layouts/app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">{{$title}}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group">
				<a href="{{route('skins')}}" class="btn btn-outline-warning">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
					{{__('msj.str_goback')}}
				</a>
			</div>
		</div>
	</div>

	<div class="mt-3">
		<form method="post" enctype="multipart/form-data" action="{{ route('store-skins') }}">
			@csrf

			<div class="form-group row">
				<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('msj.str_name') }}</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			
			<div class="form-group row">
				<label for="name" class="col-md-4 col-form-label text-md-right">Gathr identifier</label>

				<div class="col-md-6">
					<input id="gathr_identifier" type="text" class="form-control @error('gathr_identifier') is-invalid @enderror" name="gathr_identifier" value="{{ old('gathr_identifier') }}" required autocomplete="gathr_identifier">

					@error('gathr_identifier')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label for="" class="col-md-4 col-form-label text-md-right">Image</label>

				<div class="col-md-6 ">
					<div class="custom-file">
						<input id="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" value="" required>

						<label class="custom-file-label" id="" for="image">Choose file</label>

						@error('image')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
			</div>
			
			<div class="form-group row ">
				<label for="" class="col-md-4 col-form-label text-md-right">Preview Image</label>

				<div class="col-md-6 ">
					<div class="custom-file">
						<input id="preview_image" type="file" class="custom-file-input @error('preview_image') is-invalid @enderror" name="preview_image" value="" required>

						<label class="custom-file-label" id="" for="preview_image">Choose file</label>

						@error('preview_image')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label for="default" class="col-md-4 col-form-label text-md-right">Default skin?</label>

				<div class="col-md-6">
					<input id="default" type="checkbox" class=" @error('default') is-invalid @enderror" name="default" value="1" @if(old('default')) checked="" @endif >

					@error('default')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ __('msj.str_send') }}
					</button>
				</div>
			</div>
		</form>
	</div>

@endsection