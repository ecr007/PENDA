<div class="alert alert-danger ecr-main-alert ecr-js-alert display-none">
	<span>{!! session('error') !!}</span>
</div>

@if(session('error'))
	<div class="alert alert-danger ecr-main-alert">
		<span>{!! session('error') !!}</span>
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success ecr-main-alert">
		<span>{!! session('success') !!}</span>
	</div>
@endif

@if(isset($success))
	<div class="alert alert-success ecr-main-alert">
		<span>{!! $success !!}</span>
	</div>
@endif

@if (session()->has('errorsAry'))
	<div class="alert alert-danger ecr-main-alert">
		@foreach (session('errorsAry')->toArray() as $key => $value)
			@foreach ($value as $keyCh => $valueCh)
		    	<span>{{ $valueCh }}</span><br>
			@endforeach
		@endforeach
	</div>
@endif