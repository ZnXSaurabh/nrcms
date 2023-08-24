@extends('layouts.admin-template')



@section('title')

    Edit User

@endsection



@section('page-heading')

    <h2>Edit User</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Edit {{ $user->name }}'s Details</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.users.index') }}">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>



    <div class="content-area">



        @include('partials.common.alerts')

        

        <div class="row">

            

            <form class="col-12" action="{{ route('management.users.update', $user->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">

               

                @include('partials.management.user')    

            

            </form>

        

        </div>



    </div>



@endsection