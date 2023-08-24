@extends('layouts.admin-template')



@section('title')

    Manage Departments

@endsection



@section('page-heading')

    <h2>Manage Departments</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Departments</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.super-categories.create') }}">

            <i data-feather="plus-circle"></i>

            New Department

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="superCategoryDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Icon</th>

                        <th>Name</th>

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

            $('#superCategoryDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-super-categories') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'icons', name: 'icons' },

                    { data: 'name', name: 'name' },

                    { data: 'description', name: 'description' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; },
                    "title": "icons",

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                }

            });

        });

    </script>

@endsection