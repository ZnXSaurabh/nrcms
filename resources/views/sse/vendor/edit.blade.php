@extends('layouts.admin-template')

@section('title')
    Edit Vendor
@endsection

@section('page-heading')
    <h2>Edit Vendor</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Vendor Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('sse.vendors.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('sse.vendors.update', $vendor->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
               
                @include('partials.sse.vendor')    
            
            </form>
        
        </div>

    </div>

@endsection