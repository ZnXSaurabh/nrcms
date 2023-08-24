@extends('layouts.auth')

@section('title')
    Register on NRCMS
@endsection

@section('auth-content')

    <div class="container-fluid auth-page register-page">
        <div class="row">
            <div class="col-12 page-links">
                <div class="d-flex align-items-center justify-content-between">
                    @desktop
                    <a class="go-back-link" href="{{ url('/') }}">
                        <i data-feather="arrow-left"></i>
                        Back to Home
                    </a>
                    @enddesktop
                    <a class="go-back-link" href="{{ route('login') }}">
                        Login
                        <i data-feather="unlock"></i>
                    </a>
                </div>
            </div>
                
            <div class="col-md-8 offset-md-2 login-form mt-5 mb-4 mb-md-0 pt-5">
                <h3>New Registration</h3>
                <span class="tag">Register on NRCMS to sumbit your complaints</span>
                
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="name">{{ __('Full Name') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
                        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="text" name="email" value="{{ old('email') }}">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="mobileno">{{ __('Mobile Number') }}</label>
                        <input id="mobileno" type="text" name="mobileno" value="{{ old('mobileno') }}">
                        
                        @error('mobileno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="location_id">Location</label>
                        <select name="location_id" id="location_id">
                            <option value="">Select Location...</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"{{-- old('location_id') == $location->id ? " selected" : "" --}}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('location_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="housetype_id">Housetype</label>
                        <select name="housetype_id" id="housetype_id" disabled>
                            <option value="">Select Location First...</option>
                        </select>

                        @error('housetype_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="block_id">Block</label>
                        <select name="block_id" id="block_id" disabled>
                            <option value="">Select Housetype First...</option>
                        </select>

                        @error('block_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="qtrno">Quarter Number</label>
                        <select name="qtrno" id="qtrno" disabled>
                            <option value="">Select Block First...</option>
                        </select>
                        
                        @error('qtrno')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn white-btn">
                        {{ __('Register') }}
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

@section('script')
    <script>
        $('#location_id').on('change', function(e) {
            var location_id = e.target.value;
            if (location_id) {
                $.get('/housetypes-of-a-location/' + location_id, function(data) {
                    $('#housetype_id').empty().removeAttr('disabled');
                    $('#housetype_id').append('<option value="">Select Housetype...</option>');
                    $.each(data, function(index, housetype){
                        $('#housetype_id').append('<option value="'+ housetype.id +'">'+ housetype.name +'</option>');
                    });
                });
            } else {
                $('#housetype_id').empty().attr('disabled', 'disabled');
                $('#housetype_id').append('<option value="">Select Location First...</option>');
            }
        });

        $('#housetype_id').on('change', function(e) {
            var housetype_id = e.target.value;
            if (housetype_id) {
                $.get('/blocks-of-a-housetype/' + housetype_id, function(data) {
                    $('#block_id').empty().removeAttr('disabled');
                    $('#block_id').append('<option value="">Select Block...</option>');
                    $.each(data, function(index, block){
                        $('#block_id').append('<option value="'+ block.id +'">'+ block.name +'</option>');
                    });
                });
            } else {
                $('#block_id').empty().attr('disabled', 'disabled');
                $('#block_id').append('<option value="">Select Housetype First...</option>');
            }
        });

        $('#block_id').on('change', function(e) {
            var block_id = e.target.value;
            if (block_id) {
                $.get('/quarters-of-a-block/' + block_id, function(data) {
                    $('#qtrno').empty().removeAttr('disabled');
                    $('#qtrno').append('<option value="">Select Quarter Number...</option>');
                    $.each(data, function(index, qtrno){
                        $('#qtrno').append('<option value="'+ qtrno.id +'">'+ qtrno.qtrno +'</option>');
                    });
                });
            } else {
                $('#qtrno').empty().attr('disabled', 'disabled');
                $('#qtrno').append('<option value="">Select Block First...</option>');
            }
        });
    </script>
@endsection
