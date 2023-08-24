@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Location Wise Complaints</h3>

        @desktop
        <a class="btn btn-warning download-btn d-none" >

            <i data-feather="plus-circle"></i>

            Download Excel

        </a>
        @enddesktop

    </div>

@role(['aden'])
    <div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Location</label>
                <select class="form-control" name="location" id="location">
                <option value = "">Choose location</option>
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-4">  
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                    <option value = "">Choose status</option>
                    <option value="Initiated">Initiated</option>
                    <option value="Allocated">Allocated</option>
                    <option value="Resolved">Resolved</option>
                   
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

        </div>
    </div>
@endrole

@role(['super-admin'])
<div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Location</label>
                <select class="form-control" name="location" id="location">
                <option value = "">Choose location</option>
                    @foreach($allLocation as $allLocations )
                    <option value="{{$allLocations->id}}">{{$allLocations->name}}</option>
                    @endforeach
                
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-4">  
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                <option value = "">Choose status</option>
                    <option value="Initiated">Initiated</option>
                    <option value="Allocated">Allocated</option>
                    <option value="Resolved">Resolved</option>
                   
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

        </div>
    </div>
@endrole


@role(['den'])
<div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Location</label>
                <select class="form-control" name="location" id="location">
                <option value = "">Choose location</option>
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                
                 
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-4">  
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                <option value = "">Choose status</option>
                    <option value="Initiated">Initiated</option>
                    <option value="Allocated">Allocated</option>
                    <option value="Resolved">Resolved</option>
                   
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
            </div>

        </div>
    </div>
@endrole



@role(['sden'])
<div class="content-area">
        <div class="row">
            <div class="form-group col-4">  
                <label>Location</label>
                <select class="form-control" name="location" id="location">
                <option value = "">Choose location</option>
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-4">  
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                <option value = "">Choose status</option>
                    <option value="Initiated">Initiated</option>
                    <option value="Allocated">Allocated</option>
                    <option value="Resolved">Resolved</option>
                   
                </select>
                <span id="month-error" class="text-danger d-none">Please select Status</span>
            </div>

            <div class="form-group col-3">
                <br/>
                <button class="submit-btn btn btn-success" >Get Complaints</button>
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

            var location = $('#location').val();
            
            var status = $('#status').val();
           
            var data = [location,status]
                
            $('#complaintDataTable').DataTable({

                destroy: true,
                
                processing: true,

                serverSide: true,

                ajax: '/location-wise-all-complaint/'+data,

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