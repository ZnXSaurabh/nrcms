@extends('layouts.admin-template')

@section('title')
    Edit Escalation
@endsection

@section('page-heading')
    <h2>Edit Escalation</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Escalation Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('management.escalations.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('management.escalations.update', $escalation->id) }}" method="POST" autocomplete="off">
               
                @include('partials.management.escalation')    
            
            </form>
        
        </div>

    </div>

@endsection