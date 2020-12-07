@extends('layouts.app-login')

@section('content')

    <h3 class="form-title">Administration Panel</h3>
    
    <form method="POST" action="{{ route('login') }}" class="login-form">
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

        <div class="form-group">
            <div class="input-icon">

                <i class="fa fa-lock"></i>

                <input id="password" type="password" class="form-control placeholder-no-fix @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
            </div>

            @error('password')
                <span class="small text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Login</button>
            
            <label class="" style="margin-left: 16px;">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forget-password">Forgot Password?</a>
            @endif
        </div>
    </form>
@endsection
