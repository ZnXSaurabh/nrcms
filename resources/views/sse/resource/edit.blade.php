@extends('layouts.admin-template')

@section('title')
    Edit Resource
@endsection

@section('page-heading')
    <h2>Edit Resource</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Resource Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('sse.resources.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('sse.resources.update', $resource->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
               
                @include('partials.sse.resource')    
            
            </form>
        
        </div>

    </div>

@endsection