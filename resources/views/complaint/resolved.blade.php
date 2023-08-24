@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Manage Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Resolved Complaints</h3>

        @desktop
        <a class="btn sm-btn green-btn" href="{{ route('complaints.create') }}">

            <i data-feather="plus-circle"></i>

            New Complaint

        </a>
        @enddesktop

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="complaintDataTable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Type</th>

                        <th>Complaint ID</th>

                        <th>Category</th>

                        <th>Sub Category</th>

                        <th>Status</th>

                        <th>Date</th>

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

            $('#complaintDataTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('get-complaints', 'Resolved') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'comp_type', name: 'comp_type' },

                    { data: 'comp_id', name: 'comp_id' },

                    { data: 'category_id', name: 'category_id' },

                    { data: 'sub_category_id', name: 'sub_category_id' },

                    { data: 'status', name: 'status' },

                    { data: 'created_at', name: 'created_at' },

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