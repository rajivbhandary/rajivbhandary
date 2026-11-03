@extends('admin.layouts.app')

@section('title', 'Login | Perks Properties')

@section('form')
    <form class="kt-form" action="{{route('login')}}" method="POST" id="kt_login_form">
        @csrf
        <div class="input-group">
            <input type="text" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}">


            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password"
                   class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
        <div class="row kt-login__extra">
            <div class="col">
                <label class="kt-checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                    <span></span>
                </label>
            </div>
            <div class="col kt-align-right">
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request')}}" class="kt-link kt-login__link-forgot">

                        Forgot Password ?
                    </a>
                @endif
            </div>
        </div>
        <div class="kt-login__actions">
            <button id="kt_login_signin_submit" class="btn btn-brand btn-elevate btn-block">Log In</button>
        </div>
    </form>
@endsection
