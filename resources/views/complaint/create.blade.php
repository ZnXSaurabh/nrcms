@extends('layouts.admin-template')

@section('title')
    Create Complaint
@endsection

@section('page-heading')
    <h2>Create Complaint</h2>
@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Complaint Details</h3>

        <a class="btn sm-btn green-btn" href="{{ route('complaints.index') }}">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>

    <div class="content-area">

        @include('partials.common.alerts')

        <form action="{{ route('complaints.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">            

            @include('partials.complaint')  

        </form>

    </div>
    
@endsection