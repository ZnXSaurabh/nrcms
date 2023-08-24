@extends('layouts.admin-template')



@section('title')

    Add New Sub Category

@endsection



@section('page-heading')

    <h2>Add New Sub Category</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Sub Category Details</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.sub-categories.index') }}">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>



    <div class="content-area">



        @include('partials.common.alerts')

        

        <div class="row">

            

            <form class="col-12" action="{{ route('management.sub-categories.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">

               

                @include('partials.management.masters.sub-category')

            

            </form>

        

        </div>



    </div>



@endsection