@extends('layouts/app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">{{$title}}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group">
				<a href="{{route('companies')}}" class="btn btn-outline-warning">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
					{{__('msj.str_goback')}}
				</a>
			</div>
		</div>
	</div>

	<div class="mt-3">
		<form method="post" enctype="multipart/form-data" action="{{ route('update-companies',[$record->id]) }}">
			@csrf

			<div class="form-group row">
				<label for="name" class="col-12 col-lg-4 col-form-label text-lg-right">{{ __('msj.str_name') }}</label>

				<div class="col-12 col-lg-6">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$record->name}}" required autocomplete="name" autofocus>

					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="name" class="col-12 col-lg-4 col-form-label text-lg-right">{{ __('msj.str_status') }}</label>

				<div class="col-12 col-lg-6">

					<select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required="">
						<option value="">{{ __('msj.str_select') }}</option>
						<option value="1" @if($record->status == 1) selected @endif >{{ __('msj.str_activated') }}</option>
						<option value="0" @if($record->status == 0) selected @endif >{{ __('msj.str_disabled') }}</option>
					</select>

					@error('status')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label for="" class="col-12 col-lg-4 col-form-label text-lg-right">{{ __('msj.str_logo') }}</label>

				<div class="col-12 col-lg-6 ">
					<div class="custom-file">
						<input id="logo" type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" value="">

						<label class="custom-file-label" id="" for="logo">Choose file</label>

						@error('logo')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<small class="form-text text-muted">
						Do not load the image if you do not want to change it
					</small>

					<a href="#" class="btn btn-sm btn-outline-primary gathr-open-modal mt-1" data-title="{{$record->name}}" data-img="{{$record->logo}}">
						{{__('msj.str_view_image')}}
					</a>
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-12 col-lg-6 offset-lg-4">
					<button type="submit" class="btn btn-primary">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>

@endsection