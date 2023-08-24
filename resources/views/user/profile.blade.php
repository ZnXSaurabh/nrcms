@extends('layouts.admin-template')

@section('title')
    User Profile
@endsection

@section('page-heading')
    <h2>User Profile</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">{{ $user->name }}'s Profile</h3>
        <a class="btn sm-btn green-btn" href="{{ route('user.dashboard') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">
        <div class="col-12">
            <div class="row">
                <div class="col-md-5">
                    <figure class="mb-5">
                        @if($user->profile->photo)
                            <img class="img-fluid" src="{{ asset(Illuminate\Support\Facades\Storage::url('users/'.$user->id.'/'.$user->profile->photo)) }}" alt="{{ $user->name }}">
                        @else
                            <img class="img-fluid" src="{{ asset('images/no-pic.png') }}" alt="{{ $user->name }}">
                        @endif
                    </figure>

                    <div class="card">
                        <div class="card-header">
                            Personal Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name</h5>
                            <p class="card-text">{{ $user->name }}</p>

                            <h5 class="card-title">Email</h5>
                            <p class="card-text">{{ $user->email ?? 'NA' }}</p>

                            <h5 class="card-title">Mobile Number</h5>
                            <p class="card-text">{{ $user->mobileno }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            Official Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Department</h5>
                            <p class="card-text">{{ $user->profile->department ?? 'NA' }}</p>

                            <h5 class="card-title">Designation</h5>
                            <p class="card-text">{{ $user->profile->designation ?? 'NA' }}</p>

                            <h5 class="card-title">Location</h5>
                            <p class="card-text">{{ $user->profile->location->name ?? 'NA' }}</p>

                            <h5 class="card-title">Area</h5>
                            <p class="card-text">{{ $user->profile->area->name ?? 'NA' }}</p>

                            <h5 class="card-title">Housetype</h5>
                            <p class="card-text">{{ $user->profile->housetype->name ?? 'NA' }}</p>

                            <h5 class="card-title">Block</h5>
                            <p class="card-text">{{ $user->profile->block->name ?? 'NA' }}</p>

                            <h5 class="card-title">Quarter Number</h5>
                            <p class="card-text">{{ $user->profile->qtrno ?? 'NA' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
@endsection