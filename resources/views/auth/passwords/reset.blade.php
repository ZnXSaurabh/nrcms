@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('auth-content')
    <div class="container-fluid auth-page">
        <div class="row h-100">
            <div class="col-12 page-links">
                <div class="d-flex align-items-center justify-content-between">
                    <a class="go-back-link" href="{{ url('/') }}">
                        <i data-feather="arrow-left"></i>
                        Back to Home
                    </a>
    
                    <a class="go-back-link" href="{{ route('login') }}">
                        Login
                        <i data-feather="unlock"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 login-form">
                <h3>Reset Password</h3>
                <span class="tag">Enter new password</span>

                @include('partials.common.alerts')

                <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group mb-4">
                        <label for="mobileno">{{ __('Mobile Number') }}</label>
                        <input id="mobileno" type="text" name="mobileno" value="{{ old('mobileno') }}" autofocus>
                        <i data-feather="smartphone"></i>
                        
                        @error('mobileno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password">
                        <i data-feather="key"></i>
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation">
                        <i data-feather="key"></i>
                    </div>

                    <button type="submit" class="btn white-btn">
                        {{ __('Reset Password') }}
                        <svg viewBox="0 0 476.213 476.213" widht="25px" height="25px">
                            <polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 
                            345.606,368.713 476.213,238.106 "/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection