@extends('layouts/app-login')

@section('content')

	@push('styles')
   		<link href="{{ asset('dist/ecr-box-upload-1.0/css/ecr.box.upload.css') }}?ver=1.0" rel="stylesheet">
	@endpush

	{{-- (function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0); --}}
	
	@push('scripts')
		<script src="{{ asset('dist/ecr-box-upload-1.0/js/ecr.box.upload.js') }}?ver=1.1" data-cf-settings="253a283d5c96584adefec577-|49" defer=""></script>
	@endpush

	<div class="gathr-general-content gathr-general-photo-section js">
	
		<img class="mb-5" src="{{ asset('images/gathr-logo-gr-88h@2x.png') }}" alt="{{ config('app.name') }} Logo" height="60">
   		
   		@include('layouts/alert')
   		
		<h1 class="h3 mt-0 mb-4 font-weight-normal">
			@if(isset($event_id) && isset($skin))
				Upload your picture and select your in-world avatar.
			@endif
			
			@if(!isset($event_id))
				Please upload your picture
			@endif
		</h1>
		
		<hr class="mb-3">

		<div class="row gathr-content-crop @if(empty(Auth::user()->profile_pic_url)) display-none @else display-block @endif ">
			<div class="col-sm-12">
				<div class="form-group">

					<img src="{{Auth::user()->getPhoto()}}" alt="Upload avatar" class="img-thumbnail img-fluid gathr-avatar mb-1 gathr-preview-img-content gathr-view-crop">
					
					<div class="alert alert-primary d-inline-block" style="width: 480px;">
						The image will be cut to 260px x 370px. <br> You can move it or zoom in and out.
					</div>
				</div>	
			</div>	
		</div>	
		
		<form action="{{route('upload-photo-user')}}" method="post" enctype="multipart/form-data" class="box gathr-content-upload @if(empty(Auth::user()->profile_pic_url)) display-block @else display-none @endif" id="gathr-form-up-photo">
			
			@csrf
			
			<div class="box__input">
				<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z" /></svg>
				
				<input type="file" id="file" class="box__file" data-multiple-caption="{count} files selected" name="profile_pic_url" value="" @if(empty(Auth::user()->profile_pic_url)) required @endif   />
				
				<label for="file">
					<strong>Choose a image</strong>
					<span class="box__dragndrop"> or drag it here</span>.
				</label>
				
				<button type="submit" class="box__button">Upload</button>
			</div>

			<input type="hidden" name="x1" value="0">
			<input type="hidden" name="y1" value="0">
			<input type="hidden" name="x2" value="0">
			<input type="hidden" name="y2" value="0">
		</form>

		<div class="form-group">
			<hr>

			<button type="button" class="btn-lg btn btn-warning gathr-view-form-up-photo">
				Change image
			</button>&nbsp;&nbsp;&nbsp;

			<button type="submit" class="btn-lg btn btn-primary" form="gathr-form-up-photo">
				Save
			</button>
		</div>
	</div>
@endsection
