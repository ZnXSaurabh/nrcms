@extends('layouts.admin-template')



@section('title')

    Manage Admins

@endsection



@section('page-heading')

    <h2>Manage Admins</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Admins</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.admins.create') }}">

            <i data-feather="plus-circle"></i>

            New Admin

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="adminDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Mobile No.</th>

                        <th>Role</th>
                        
                        <th>Department</th>

                        <th>Location-Area</th>

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

            $('#adminDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-admins') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'photo', name: 'photo' },

                    { data: 'name', name: 'name' },

                    { data: 'email', name: 'email' },

                    { data: 'mobileno', name: 'mobileno' },

                    { data: 'role', name: 'role' },
                    
                    { data: 'department', name: 'department' },

                    { data: 'location_area', name: 'location_area', orderable: false, searchable: false,},

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