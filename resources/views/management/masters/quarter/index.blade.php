@extends('layouts.admin-template')



@section('title')

    Manage Quarters

@endsection



@section('page-heading')

    <h2>Manage Quarters</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Quarters</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.quarters.create') }}">

            <i data-feather="plus-circle"></i>

            New Quarter

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="quarterDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Location</th>

                        <th>Area</th>

                        <th>Housetype</th>

                        <th>Block</th>

                        <th>Qtr. No.</th>

                        <th>Status</th>

                        <th class="actions">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>



    <!-- Show Quarter Info Modal -->

    <div class="custom-modal modal fade" id="showQuarterModal" tabindex="-1" role="dialog" aria-labelledby="showQuarterModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title text-bold" id="showQuarterModalLabel">Quarter Details</h3>

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

                            <th style="width: 170px;">Housetype</th>

                            <td><span id="show_housetype"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Block</th>

                            <td><span id="show_block"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Quarter Number</th>

                            <td><span id="show_quarter_no"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Rent</th>

                            <td><span id="show_rent"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">House Area</th>

                            <td><span id="show_harea"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">No. of Garages</th>

                            <td><span id="show_garages"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Status</th>

                            <td><span id="show_status"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Remarks</th>

                            <td><span id="show_remarks"></span></td>

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

            $('#quarterDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.get-quarters') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'location_id', name: 'location_id' },

                    { data: 'area_id', name: 'area_id' },

                    { data: 'housetype_id', name: 'housetype_id' },

                    { data: 'block_id', name: 'block_id' },

                    { data: 'qtrno', name: 'qtrno' },

                    { data: 'status', name: 'status' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                    $('.showQuarterModalBtn').on('click', function(e) {

                        e.preventDefault();

                        $.ajax({

                            type: 'GET',

                            url: "/management/quarters/" + $(this).attr('data-quarterID'),

                            success: function(response) {

                                $('#show_location').html(response[0].location.name);

                                $('#show_area').html(response[0].area.name);

                                $('#show_housetype').html(response[0].housetype.name);

                                $('#show_block').html(response[0].block.name);

                                $('#show_quarter_no').html(response[0].quarter_id);

                                $('#show_rent').html(response[0].rent);

                                $('#show_harea').html(response[0].house_area);

                                $('#show_garages').html(response[0].garages);

                                $('#show_status').html(response[0].status);

                                $('#show_remarks').html(response[0].remarks);

                                $('#showQuarterModal').modal('show');

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