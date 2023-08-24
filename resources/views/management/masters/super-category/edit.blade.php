@extends('layouts.admin-template')



@section('title')

    Update Department

@endsection



@section('page-heading')

    <h2>Update Department</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Department Details</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.super-categories.index') }}">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>



    <div class="content-area">



        @include('partials.common.alerts')

        

        <div class="row">

            

            <form class="col-12" action="{{ route('management.super-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">

               

                @include('partials.management.masters.super-category')

            

            </form>

        

        </div>



    </div>



@endsection