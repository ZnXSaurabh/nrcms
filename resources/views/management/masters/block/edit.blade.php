@extends('layouts.admin-template')

@section('title')
    Edit Block
@endsection

@section('page-heading')
    <h2>Edit Block</h2>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Block Details</h3>
        <a class="btn sm-btn green-btn" href="{{ route('management.blocks.index') }}">
            <i data-feather="arrow-left"></i> Go Back
        </a>
    </div>

    <div class="content-area">

        @include('partials.common.alerts')
        
        <div class="row">
            
            <form class="col-12" action="{{ route('management.blocks.update', $block->id) }}" method="POST" autocomplete="off">
               
                @include('partials.management.masters.block')    
            
            </form>
        
        </div>

    </div>

@endsection