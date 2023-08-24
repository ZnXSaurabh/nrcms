@extends('layouts.admin-template')


@section('title')

    Vendors

@endsection



@section('page-heading')

    <h2>Vendors</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Vendors</h3>

        <a class="btn sm-btn green-btn" href="{{ route('sse.vendors.create') }}">

            <i data-feather="plus-circle"></i>

            New Vendor

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="vendorDataTable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Mobile</th>

                        <th class="actions">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>



    <!-- Show Vendor Info Modal -->

    <div class="custom-modal modal fade" id="showVendorModal" tabindex="-1" role="dialog" aria-labelledby="showVendorModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title text-bold" id="showVendorModalLabel">Vendor Details</h3>

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

                            <th style="width: 170px;">Name</th>

                            <td><span id="show_name"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Email</th>

                            <td><span id="show_email"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Mobile</th>

                            <td><span id="show_mobile"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Agreement Number</th>

                            <td><span id="show_agreement_no"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Photo</th>

                            <td><span id="show_photo"></span></td>

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

            $('#vendorDataTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('sse.get-vendors') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'photo', name: 'photo' },

                    { data: 'name', name: 'name' },

                    { data: 'email', name: 'email' },

                    { data: 'mobile', name: 'mobile' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                    $('.showVendorModalBtn').on('click', function(e) {

                        e.preventDefault();

                        $.ajax({

                            type: 'GET',

                            url: "/sse/vendors/" + $(this).attr('data-vendorID'),

                            success: function(response) {

                                $('#show_location').html(response.location.name);

                                $('#show_name').html(response.name);

                                $('#show_email').html(response.email);

                                $('#show_mobile').html(response.mobile);

                                $('#show_agreement_no').html(response.agreement_no);

                                $('#show_photo').html('<img height="50" src="/storage/vendors/'+ response.id + '/' + response.photo +'" alt="'+ response.name +'">');

                                $('#show_remarks').html(response.remarks);

                                $('#showVendorModal').modal('show');

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