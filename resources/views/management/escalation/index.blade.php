@extends('layouts.admin-template')

@section('title')

    Escalations

@endsection

@section('page-heading')

    Escalations

@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Escalations</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.escalations.create') }}">

            <i data-feather="plus-circle"></i>

            New Escalation

        </a>

    </div>
    
    

    <div class="content-area">


        @include('partials.common.alerts')


        <div class="table-responsive-md">

            <table id="escalationDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Dept_ID</th>

                        <th>Complaint Status</th>

                        <th>L1_Role</th>

                        <th>L1_Days</th>

                        <th>L2_Role</th>

                        <th>L2_Days</th>
                        
                        <th>L3_Role</th>

                        <th>L3_Days</th>

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

            $('#escalationDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-escalations') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'department_id', name: 'department_id' },

                    { data: 'complaint_status', name: 'complaint_status' },

                    { data: 'l1_escalation_role', name: 'l1_escalation_role' },

                    { data: 'l1_escalation_days', name: 'l1_escalation_days' },

                    { data: 'l2_escalation_role', name: 'l2_escalation_role' },

                    { data: 'l2_escalation_days', name: 'l2_escalation_days' },
                    
                    { data: 'l3_escalation_role', name: 'l3_escalation_role' },

                    { data: 'l3_escalation_days', name: 'l3_escalation_days' },

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