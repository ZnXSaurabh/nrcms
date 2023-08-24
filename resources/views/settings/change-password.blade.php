@extends('layouts.admin-template')



@section('title')

    Change Password

@endsection



@section('page-heading')

    <h2>Change Password</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Change Current Password</h3>

        <a class="btn sm-btn green-btn" href="@role(['user']){{ route('user.dashboard') }}@else{{ route('management.dashboard') }}@endrole">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>



    <div class="content-area">



        @include('partials.common.alerts')

            

        <form action="{{ route('settings.post-change-password') }}" method="POST">

            @csrf



            <div class="row">

                <div class="col-md-7">

                    <div class="form-group">

                        <label for="current_password">Current Password</label>

                        <input type="password" name="current_password" id="current_password" autofocus>

                        

                        @error('current_password')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

                

                <div class="col-md-7">

                    <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" name="password" id="password">



                        @error('password')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

                

                <div class="col-md-7">

                    <div class="form-group">

                        <label for="password_confirmation">Confirm Password</label>

                        <input type="password" name="password_confirmation" id="password_confirmation">



                        @error('password_confirmation')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-7">

                    <button class="btn green-btn" type="submit">

                        <i class="mr-1" data-feather="key"></i> Change Password

                    </button>

                </div>

            </div>

        

        </form>



    </div>

@endsection