@extends('layouts.admin-template')



@section('title')

    Manage Categories

@endsection



@section('page-heading')

    <h2>Manage Categories</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Categories</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.categories.create') }}">

            <i data-feather="plus-circle"></i>

            New Category

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="categoryDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Icon</th>

                        <th>Department</th>

                        <th>Category</th>

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

            $('#categoryDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-categories') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'icons', name: 'icons' },

                    { data: 'sup_cat_id', name: 'sup_cat_id' },

                    { data: 'name', name: 'name' },

                    { data: 'description', name: 'description' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                }

            });

        });

    </script>

@endsection