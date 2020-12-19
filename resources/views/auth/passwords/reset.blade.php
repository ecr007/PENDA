@extends('layouts.app-login')

@section('content')

<h3 class="form-title">{{ __('Reset Password') }}</h3>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">

        <div class="input-icon">
            <i class="fa fa-user"></i>

            <input id="email" type="email" class="form-control placeholder-no-fix @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Correo electrónico">
        </div>

        @error('email')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="input-icon">

            <i class="fa fa-lock"></i>

            <input id="password" type="password" class="form-control placeholder-no-fix @error('password') is-invalid @enderror" name="password" required autofocus placeholder="Contraseña">
        </div>

        @error('password')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="input-icon">

            <i class="fa fa-lock"></i>

            <input id="password-confirm" type="password" class="form-control placeholder-no-fix @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Confirmar contraseña">
        </div>

        @error('password')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Recuperar</button>
    </div>
</form>
               
@endsection
