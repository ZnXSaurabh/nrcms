@extends('layouts.admin-template')

@section('title')
    Update Location
@endsection

@section('page-heading')
    <h2>Update Location</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Location Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('management.locations.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('management.locations.update', $location->id) }}" method="POST" autocomplete="off">
               
                @include('partials.management.masters.location')
            
            </form>
        
        </div>

    </div>

@endsection