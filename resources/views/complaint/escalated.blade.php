@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Escalated Complaints</h3>

        @desktop
        <a class="btn btn-warning download-btn d-none" >

            <i data-feather="plus-circle"></i>

            Download Excel

        </a>
        @enddesktop

    </div>

@role(['super-admin'])
    <div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Status and days</label>
                <select class="form-control" name="status" id="status">
                    @foreach($rs as $data)
                    <option value="{{$data->complaint_status}}">{{$data->complaint_status}}  and delayed for  {{$data->l1_escalation_days}}days</option>
                    @endforeach
                   <!-- <option value="Allocated">Allocated</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>
                 <div class="form-group col-3">
            <label>Department *</label>
                <select class="form-control" name="department" id="department">
                    <option value="1">Civil</option>
                    <option value="2">Electrical</option>
                    <option value="3">S&T</option>
 
                </select>
                <span id="department-error" class="text-danger d-none">Please select department</span>
            </div>
            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

            <div class="form-group col-1" style=" visibility: hidden;">  
                <label>Days *</label>
                <select class="form-control" name="days" id="days">
                @foreach($rs as $data)
                    <option value="{{$data->l1_escalation_days	}}"></option>
                    @endforeach
                    <!--<option value="20">20 days</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>
          
           
        </div>
    </div>
@endrole


@role(['aden'])
    <div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Status and days</label>
                <select class="form-control" name="status" id="status">
                    @foreach($dt as $data)
                    <option value="{{$data->complaint_status}}">{{$data->complaint_status}}  and delayed for  {{$data->l1_escalation_days}}days</option>
                    @endforeach
                   <!-- <option value="Allocated">Allocated</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

            <div class="form-group col-3" style=" visibility: hidden;">  
                <label>Days *</label>
                <select class="form-control" name="days" id="days">
                @foreach($dt as $data)
                    <option value="{{$data->l1_escalation_days	}}"></option>
                    @endforeach
                    <!--<option value="20">20 days</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>
          
           
        </div>
    </div>
@endrole


@role(['den'])
<div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Status and days</label>
                <select class="form-control" name="status" id="status">
                    @foreach($dt as $data)
                    <option value="{{$data->complaint_status}}">{{$data->complaint_status}}  and delayed for  {{$data->l2_escalation_days}}days</option>
                    @endforeach
                   <!-- <option value="Allocated">Allocated</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

            <div class="form-group col-3" style=" visibility: hidden;">  
                <label>Days *</label>
                <select class="form-control" name="days" id="days">
                @foreach($dt as $data)
                    <option value="{{$data->l1_escalation_days}}"></option>
                    @endforeach
                    <!--<option value="20">20 days</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>
          
           
        </div>
    </div>
@endrole



@role(['sden'])
<div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Status and days</label>
                <select class="form-control" name="status" id="status">
                    @foreach($dt as $data)
                    <option value="{{$data->complaint_status}}">{{$data->complaint_status}} and delayed for {{$data->l3_escalation_days}} days</option>
                    @endforeach
                   <!-- <option value="Allocated">Allocated</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

            <div class="form-group col-3" style=" visibility: hidden;">  
                <label>Days *</label>
                <select class="form-control" name="days" id="days">
                @foreach($dt as $data)
                    <option value="{{$data->l1_escalation_days	}}"></option>
                    @endforeach
                    <!--<option value="20">20 days</option>-->
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>
          
           
        </div>
    </div>
@endrole


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

            var status = $('#status').val();
            var days = $('#days').val();
            var department = $('#department').val();

                var data = [status,days,department]
            $('#complaintDataTable').DataTable({

                destroy: true,
                
                processing: true,

                serverSide: true,

                ajax: '/get-escalated-complaints/'+data,

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'comp_type', name: 'comp_type' },

                    { data: 'comp_id', name: 'comp_id' },

                    { data: 'category_id', name: 'category_id' },

                    { data: 'sub_category_id', name: 'sub_category_id' },

                    { data: 'status', name: 'status' },

                    { data: 'created_at', name: 'created_at' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data;  }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                }

            });

        });
    });
    </script>

@endsection