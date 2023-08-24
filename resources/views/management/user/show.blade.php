@extends('layouts.admin-template')

@section('title')
    User Details
@endsection

@section('page-heading')
    <h2>User Details</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">{{ $user->name }}'s Details</h3>
        <div>
            <a class="d-inline-block btn sm-btn green-btn mr-2" href="{{ route('management.users.edit', $user->id) }}">
                <i data-feather="edit-3"></i> Edit Details
            </a>
            <a class="d-inline-block btn sm-btn green-btn" href="{{ route('management.users.index') }}">
                <i data-feather="arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <div class="col-md-4">
                <figure class="mb-0">
                    @if ($user->profile->photo)
                        <img src="{{ asset(Illuminate\Support\Facades\Storage::url('users/'.$user->id.'/'.$user->profile->photo)) }}" alt="{{ $user->name }}" class="img-fluid">
                    @else
                        <img src="{{ asset('images/no-pic.png') }}" alt="{{ $user->name }}">
                    @endif
                </figure>
            </div>
            <div class="col-md-4">
                <span>Name</span>
                <p><strong>{{ $user->name }}</strong></p>

                <span>Email</span>
                <p><strong>{{ $user->email }}</strong></p>

                <span>Mobile Number</span>
                <p><strong>{{ $user->mobileno }}</strong></p>

                <span>Father's Name</span>
                <p><strong>{{ $user->profile->fathername ?? 'NA' }}</strong></p>

                <span>PF Number</span>
                <p><strong>{{ $user->profile->pfno ?? 'NA' }}</strong></p>

                <span>Department</span>
                <p><strong>{{ $user->profile->department ?? 'NA' }}</strong></p>

                <span>Designation</span>
                <p><strong>{{ $user->profile->designation ?? 'NA' }}</strong></p>
            </div>
            <div class="col-md-4">
                <span>Location</span>
                <p><strong>{{ $user->profile->location->name ?? 'NA' }}</strong></p>

                <span>Area</span>
                <p><strong>{{ $user->profile->area->id ?? 'NA' }}</strong></p>

                <span>Housetype</span>
                <p><strong>{{ $user->profile->housetype->name ?? 'NA' }}</strong></p>

                <span>Block</span>
                <p><strong>{{ $user->profile->block->name ?? 'NA' }}</strong></p>

                <span>Quarter Number</span>
                <p><strong>{{ $user->profile->quarter->qtrno ?? 'NA' }}</strong></p>
            </div>
        </div>

    </div>

@endsection