@extends('layouts.auth')

@section('title')
    Provisional Registration
@endsection

@section('auth-content')

    <div class="auth-page pro-reg">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 my-3">
                    <a class="go-back-link" href="{{ url('/') }}">
                        <i data-feather="arrow-left"></i>
                        Back to Home
                    </a>
                </div>
            </div>
            <div class="row m-0">
                <div class="jumbotron">
                    <h3>Hello, {{ $name }}!</h3>
                    <p class="lead">Thank you for submitting your details for verification with Western Railway Complaint Management System.</p>
                    <hr class="my-4">
                    <p>Your registration details are submitted to SSE for approval and data verification. Once the details are verified you will get an automated messsage on your registered mobile number with login details.</p>
                    <p class="mb-0">For any clarification please get in touch with concerned SSE.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Mobile Number Verification</h5>
                        <div class="card-body">
                            <h5 class="card-title">
                                @if(session('verified'))
                                    <div class="alert alert-success" role="alert">
                                        Your mobile number ******{{ substr($mobile, -4) }} is <strong>verified.</strong>
                                    </div>
                                @else
                                    <div class="alert alert-info" role="alert">
                                        Your mobile number ******{{ substr($mobile, -4) }} is <strong>not verified.</strong>
                                    </div>
                                @endisset
                            </h5>

                            @if(session('verified'))
                                <a class="btn blue-btn" href="{{ route('login') }}">
                                    <i data-feather="key"></i> Back to Login
                                </a>
                            @else
                                <p class="card-text">Kindly enter OTP received on your mobile number below.</p>
                                
                                @include('partials.common.alerts')

                                <div class="row">
                                    <form class="otp-form col-md-4 p-0" method="POST" action="{{ route('verify-mobile-number') }}" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="mobileno" value="{{ $mobile }}">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="otp">Enter OTP</label>
                                                <input id="otp" type="text" name="otp">
                                            
                                                @error('otp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn green-btn">
                                                Verify <i data-feather="check-circle"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection