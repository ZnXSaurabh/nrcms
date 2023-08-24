@extends('layouts.admin-template')



@section('title')

    Manage Complaints

@endsection



@section('page-heading')

    <h2>Complaints</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Quarter Wise Complaints Report</h3>

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
            <label>Location *</label>
                <select class="form-control" name="location" id="location">
                    <option value="">Select Location</option>
                    @foreach ($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>
                <span id="location-error" class="text-danger d-none">Please select Location</span>
            </div>
            <div class="form-group col-3">
            <label>House Types</label>
                <select class="form-control" name="houseType" id="houseType" disabled>
                    <option value="">Select Location First ...</option>
                </select>
            </div>
            <div class="form-group col-3">
            <label>Block No</label>
                <select class="form-control" name="block" id="block" disabled>
                    <option value="">Select House Type First ...</option>
                </select>
            </div>
            <div class="form-group col-3">
            <label>Quarter No</label>
                <select class="form-control" name="quarterNo" id="quarterNo" disabled>
                    <option value="">Select Block No First ...</option>
                </select>
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
            
            $('#location').change(function(){
                if(this.value != ''){
                    
                    var location_id = this.value;
                    
                    $.get('/housetypes-of-a-location/' + location_id, function(data) {

                    $('#houseType').empty().removeAttr('disabled');

                    $('#houseType').append('<option value="">Select House type</option>');

                    $.each(data, function(index, houseType){

                        $('#houseType').append('<option value="'+ houseType.id +'">'+ houseType.name +'</option>');

                    });

                });
                }
            });
            
            
            $('#houseType').change(function(){
                if(this.value != ''){
                    
                    var houseType_id = this.value;
                    
                    $.get('/blocks-of-a-housetype/' + houseType_id, function(data) {

                    $('#block').empty().removeAttr('disabled');

                    $('#block').append('<option value="">Select Block No</option>');

                    $.each(data, function(index, block){

                        $('#block').append('<option value="'+ block.id +'">'+ block.name +'</option>');

                    });

                });
                }
            });
            
            $('#block').change(function(){
                if(this.value != ''){
                    
                    var block_id = this.value;
                    
                    $.get('/quarters-of-a-block/' + block_id, function(data) {

                    $('#quarterNo').empty().removeAttr('disabled');

                    $('#quarterNo').append('<option value="">Select Quarter No</option>');

                    $.each(data, function(index, quarterNo){

                        $('#quarterNo').append('<option value="'+ quarterNo.id +'">'+ quarterNo.qtrno +'</option>');

                    });

                });
                }
            });
            
            
            $('.submit-btn').click(function(){
                
                var location,houseType,blockNo,quarterNo;
                location = $('#location').val();
                houseType = $('#houseType').val();
                blockNo = $('#block').val();
                quarterNo = $('#quarterNo').val();
                
                
                if(location==""){                    
                    $('#location-error').addClass('d-block');
                    $('#location-error').removeClass('d-none');
                }else{
                    $('#location-error').addClass('d-none');
                    $('#location-error').removeClass('d-block');
                }
                
                // Get report By location
                
                if(location!=""&&houseType==""&&blockNo==""&&quarterNo==""){
                    let dataa = location;
                  $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-quarter-wise-complaint-reportByLocation/'+dataa ,

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
                
                //Get report By location and houseType
                
                  if(location!=""&&houseType!=""&&blockNo==""&&quarterNo==""){
                    let dataa = [location,houseType];
                  $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-quarter-wise-complaint-reportByLocationAndHouseType/'+dataa ,

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
                
                // Get report by Location, HouseType and Block No
                
                  if(location!=""&&houseType!=""&&blockNo!=""&&quarterNo==""){
                    let dataa = [location,houseType,blockNo];
                  $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNo/'+dataa ,

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
                
                // Get report by Location, HouseType and Block No and Quarter No
                
                  if(location!=""&&houseType!=""&&blockNo!=""&&quarterNo!=""){
                    let dataa = [location,houseType,blockNo,quarterNo];
                  $('#complaintDataTable').DataTable({

                    destroy: true,

                    processing: true,

                    serverSide: true,
                    
                    ajax: '/get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNoAndQuarterNo/'+dataa ,

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