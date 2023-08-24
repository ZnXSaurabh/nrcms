@extends('layouts.admin-template')



@section('title')

    Manage Housetypes

@endsection



@section('page-heading')

    <h2>Manage Housetypes</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Housetypes</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.housetypes.create') }}">

            <i data-feather="plus-circle"></i>

            New Housetype

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="housetypeDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Location</th>

                        <th>Area</th>

                        <th>Housetype</th>

                        <th>Description</th>

                        <th class="actions">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>



@endsection



@section('script')

    <script>

        $(function() {

            $('#housetypeDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-housetypes') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'location_id', name: 'location_id'},

                    { data: 'area_id', name: 'area_id'},

                    { data: 'name', name: 'name' },

                    { data: 'description', name: 'description' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                "fnDrawCallback": function( oSettings ) {

                    feather.replace();

                }

            });

        });

    </script>

@endsection