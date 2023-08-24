@extends('layouts.admin-template')

@section('title')
    Add New Housetype
@endsection

@section('page-heading')
    <h2>Add New Housetype</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Housetype Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('management.housetypes.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('management.housetypes.store') }}" method="POST" autocomplete="off">
               
                @include('partials.management.masters.housetype')    
            
            </form>
        
        </div>

    </div>

@endsection