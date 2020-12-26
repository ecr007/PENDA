@extends('layouts.app-login')

@section('content')

<h3 class="form-title">Cambiar contraseña</h3>

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

            <input id="email" type="email" class="form-control placeholder-no-fix @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nombre de usuario">
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

            <input id="password" type="password" class="form-control placeholder-no-fix @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña antigua">
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

            <input id="password" type="password" class="form-control placeholder-no-fix @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Nueva contraseña">
        </div>

        @error('password')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Cambiar contraseña
        </button>

        <br>
        <br>

        <a href="{{route('login')}}" class="btn btn-warning">
            <i class="fa fa-chevron-left"></i>
            Ir atras
        </a>
    </div>
</form>
@endsection
