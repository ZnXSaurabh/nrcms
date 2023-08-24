@extends('layouts.admin-template')


@section('title')

    Add New Department

@endsection


@section('page-heading')

    <h2>Add New Department</h2>

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

            

            <form class="col-12" action="{{ route('management.super-categories.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">

               

                @include('partials.management.masters.super-category')

            

            </form>

        

        </div>



    </div>



@endsection