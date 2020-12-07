@extends('layouts.app-login')

@section('content')

<h3 class="form-title">{{ __('Reset Password') }}</h3>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group">
            
        <div class="input-icon">
            <i class="fa fa-user"></i>

            <input id="email" type="email" class="form-control placeholder-no-fix @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
        </div>

        @error('email')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            {{ __('Send Password Reset Link') }}
        </button>

        <br>
        <br>

        <a href="{{route('login')}}" class="btn btn-warning">
            <i class="fa fa-chevron-left"></i>
            Back
        </a>
    </div>
</form>
@endsection
