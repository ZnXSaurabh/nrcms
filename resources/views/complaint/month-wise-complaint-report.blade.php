@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Month Wise Complaints Report</h3>

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
                <label>Month *</label>
                <select class="form-control" name="month" id="month">
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <span id="month-error" class="text-danger d-none">Please select month</span>
            </div>
            <div class="form-group col-3">
            <label>Department *</label>
                <select class="form-control" name="department" id="department">
                @role(['den','sden','sse','aden'])
                    <option value="{{DB::table('super_categories')->join('profiles','super_categories.id','=','profiles.department')->where('profiles.user_id',Auth::user()->id)->value('super_categories.name')}}">{{DB::table('super_categories')->join('profiles','super_categories.id','=','profiles.department')->where('profiles.user_id',Auth::user()->id)->value('super_categories.name')}}</option>
                    @endrole
                    @role(['super-admin','helpdesk'])
                    <option value="1">Civil</option>
                    <option value="2">Electrical</option>
                    <option value="3">S&T</option>
                    @endrole
                </select>
                <span id="department-error" class="text-danger d-none">Please select department</span>
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
                var month,department;
                month=$('#month').val();
                department=$('#department').val(); 
                if(month==""){                    
                    $('#month-error').addClass('d-block');
                    $('#month-error').removeClass('d-none');
                }else{
                    $('#month-error').addClass('d-none');
                    $('#month-error').removeClass('d-block');
                }
                if(department==""){
                    $('#department-error').addClass('d-block');
                    $('#department-error').removeClass('d-none');
                }else{
                    $('#department-error').addClass('d-none');
                    $('#department-error').removeClass('d-block');
                }
                var dataa=[month,department];  
                if(month!=""&&department!=""){
                $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-monthly-complaint-report/'+dataa ,

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
                var month,department;
                month=$('#month').val();
                department=$('#department').val();
                var dataa=[month,department];

                window.location.href='/complaint-export/'+dataa;
            });
    });

    </script>

@endsection