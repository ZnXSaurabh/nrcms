@extends('layouts.admin-template')



@section('title')

    Manage Service Building

@endsection



@section('page-heading')

    <h2>Manage Service Building</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Service Building</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.service-buildings.create') }}">

            <i data-feather="plus-circle"></i>

            New Service Building

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="sbDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Location</th>

                        <th>Area</th>

                        <th>Building</th>

                        <th>Status</th>

                        <th class="actions">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>



    <!-- Show Building Info Modal -->

    <div class="custom-modal modal fade" id="showBuildingModal" tabindex="-1" role="dialog" aria-labelledby="showBuildingModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title text-bold" id="showBuildingModalLabel">Building Details</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <table class="table table-bordered table-striped">

                        <tr>

                            <th style="width: 170px;">Location</th>

                            <td><span id="show_location"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Area</th>

                            <td><span id="show_area"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Building</th>

                            <td><span id="show_name"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Area Covered (approx)</th>

                            <td><span id="show_area_covered"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Address</th>

                            <td><span id="show_address"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Contact Number</th>

                            <td><span id="show_contact_no"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Email</th>

                            <td><span id="show_email"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Status</th>

                            <td><span id="show_status"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Description</th>

                            <td><span id="show_description"></span></td>

                        </tr>

                    </table>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>



@endsection



@section('script')

    <script>

        $(function() {

            $('#sbDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-service-buildings') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'location_id', name: 'location_id' },

                    { data: 'area_id', name: 'area_id' },

                    { data: 'name', name: 'name' },

                    { data: 'status', name: 'status' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                    $('.showBuildingModalBtn').on('click', function(e) {

                        e.preventDefault();

                        $.ajax({

                            type: 'GET',

                            url: "/management/service-buildings/" + $(this).attr('data-buildingID'),

                            success: function(response) {

                                console.log(response);

                                $('#show_location').html(response[0].location.name);

                                $('#show_area').html(response[0].area.name);

                                $('#show_name').html(response[0].name);

                                $('#show_area_covered').html(response[0].area_covered);

                                $('#show_address').html(response[0].address);

                                $('#show_contact_no').html(response[0].contact_no);

                                $('#show_email').html(response[0].house_email);

                                $('#show_status').html(response[0].status);

                                $('#show_description').html(response[0].description);

                                $('#showBuildingModal').modal('show');

                            },

                            error: function(response) {



                            }

                        });

                    });

                }

            });

        });

    </script>

@endsection