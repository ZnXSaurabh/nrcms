@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Report</h3>

        @desktop
        <a class="btn btn-warning download-btn" >

            <i data-feather="plus-circle"></i>

            Download Excel

        </a>
        @enddesktop

    </div>

    <div class="content-area">
        <div class="row">
            <div class="form-group col-3">
                <label>From *</label>
                <input type="date" name="from" id="from" class="form-control" />
                <span id="from-error" class="text-danger d-none">Please choose a date</span>
            </div>
            <div class="form-group col-3">
                <label>To *</label>
                <input type="date" name="to" id="to" class="form-control" />
                <span id="to-error" class="text-danger d-none">Please choose a date</span>
            </div>
            <div class="form-group col-3">
                <label>Status *</label>
                <select class="form-control" name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="Initiated">Initiated</option>
                    <option value="Allocated">Allocated</option>
                    <option value="Resolved">Resolved</option>
                </select>
                <span id="status-error" class="text-danger d-none">Please select status</span>
            </div>
            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>
        </div>
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
        $(document).ready(function(){
            $('.submit-btn').click(function(){
                var from,to,status;
                from=$('#from').val();
                to=$('#to').val();
                status=$('#status').val(); 
                if(from==""){                    
                    $('#from-error').addClass('d-block');
                    $('#from-error').removeClass('d-none');
                }else{
                    $('#from-error').addClass('d-none');
                    $('#from-error').removeClass('d-block');
                }
                if(to==""){
                    $('#to-error').addClass('d-block');
                    $('#to-error').removeClass('d-none');
                }else{
                    $('#to-error').addClass('d-none');
                    $('#to-error').removeClass('d-block');
                }
                if(status==""){
                    $('#status-error').addClass('d-block');
                    $('#status-error').removeClass('d-none');
                }else{
                    $('#status-error').addClass('d-none');
                    $('#status-error').removeClass('d-block');
                }
                var dataa=[from,to,status];  
                if(from!=""&&to!=""&&status!=""){
                $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-complaint-report/'+dataa ,

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
            }

        });
            $('.download-btn').click(function(){
                var from,to,status;
                from=$('#from').val();
                to=$('#to').val();
                status=$('#status').val(); 
                var dataa=[from,to,status];

                window.location.href='/complaint-export/'+dataa;
            });
    });

    </script>

@endsection