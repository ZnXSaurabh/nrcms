@extends('layouts.auth')

@section('title')
    Login to NRCMS    
@endsection

@section('auth-content')
    <div class="contianer-fluid login-page">
        <div class="row h-100">
            @desktop
            <div class="col-12">
                <a class="go-back-link" href="{{ url('/') }}">
                    <i data-feather="arrow-left"></i>
                    Back to Home
                </a>
            </div>
            @enddesktop
            <div class="col-md-6 info-area d-none d-md-flex">
                <div class="text-center">
                    <h1 class="mt-0 mb-4">
                        <a class="navbar-brand" href="/">
                            <img class="img-fluid" src="{{ asset('images/blue-logo.png') }}" alt="NR Complaint Management System">
                        </a>
                    </h1>
                    <p>Welcome to NRCMS</p>
                </div>
                <small>Application v2.0</small>

                <div class="registration-link mt-5">
                    <a class="green-ghost-btn" href="{{ route('register') }}">New here? Click to Register</a>
                </div>
            </div>

            <div class="col-md-6 login-form pt-3">
                @mobile
                <div class="info-area d-md-flex">
                    <h1 class="text-center mt-0 mb-5">
                        <a class="navbar-brand" href="javascript:void(0)">
                            <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="NR Complaint Management System">
                        </a>
                    </h1>
                </div>
                @endmobile
                @desktop
                    <h3>Sign In</h3>
                    <span class="tag">Hello! Let's get started</span>
                @enddesktop
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="mobileno">{{ __('Mobile Number') }}</label>
                        @mobile
                        <input id="mobileno" type="number" name="mobileno" value="{{ old('mobileno') }}" autofocus>
                        @elsemobile
                        <input id="mobileno" type="text" name="mobileno" value="{{ old('mobileno') }}" autofocus>
                        @endmobile
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

                    <div class="form-group row my-md-5">
                        <div class="col-6 text-center">
                            <div class="form-check pl-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link mb-3 mb-md-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0 d-flex align-items-center justify-content-center">
                        <div class="col-md-6">
                            <button type="submit" class="btn white-btn">
                                {{ __('Login') }}
                                <svg viewBox="0 0 476.213 476.213" widht="25px" height="25px">
                                    <polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 
                                    345.606,368.713 476.213,238.106 "/>
                                </svg>
                            </button>
                        </div>
                        @mobile
                        <div class="col-md-6">
                            <a href="{{ route('register') }}" class="btn white-btn">
                                {{ __('Signup') }}
                                <svg viewBox="0 0 476.213 476.213" widht="25px" height="25px">
                                    <polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 
                                    345.606,368.713 476.213,238.106 "/>
                                </svg>
                            </a>
                        </div>
                        @endmobile
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection