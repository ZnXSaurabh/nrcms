@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Complaints Report</h3>

        @desktop
        <a class="btn btn-warning download-btn d-none" >

            <i data-feather="plus-circle"></i>

            Download Excel

        </a>
        @enddesktop

    </div>

    <div class="content-area">
        <div class="row">
            <div class="form-group col-3">  
                <label>Mobile No/Username *</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile No./Username"/>
                <span id="mobile-error" class="text-danger d-none">Please select mobile</span>
            </div>
            <div class="form-group col-3">
            <label>Date *</label>
            <input type="date" name="date" id="date" class="form-control" />
            <span id="date-error" class="text-danger d-none">Please select date</span>
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
                var mobile,date;
                mobile=$('#mobile').val();
                date=$('#date').val(); 
                if(mobile==""){                    
                    $('#mobile-error').addClass('d-block');
                    $('#mobile-error').removeClass('d-none');
                }else{
                    $('#mobile-error').addClass('d-none');
                    $('#mobile-error').removeClass('d-block');
                }
                if(date==""){
                    $('#date-error').addClass('d-block');
                    $('#date-error').removeClass('d-none');
                }else{
                    $('#date-error').addClass('d-none');
                    $('#date-error').removeClass('d-block');
                }
                var dataa=[mobile,date];  
                if(mobile!=""&&date!=""){
                $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-all-complaint-report/'+dataa ,

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
                var mobile,date;
                mobile=$('#mobile').val();
                date=$('#date').val();
                var dataa=[mobile,date];

                window.location.href='/complaint-export/'+dataa;
            });
    });

    </script>

@endsection