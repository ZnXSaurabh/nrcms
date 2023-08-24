@extends('layouts.admin-template')



@section('title')

    Resources

@endsection



@section('page-heading')

    <h2>Resources</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Resources</h3>

        <a class="btn sm-btn green-btn" href="{{ route('sse.resources.create') }}">

            <i data-feather="plus-circle"></i>

            New Resource

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="resourceDataTable" class="table dataTable">

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



    <!-- Show Resource Info Modal -->

    <div class="custom-modal modal fade" id="showResourceModal" tabindex="-1" role="dialog" aria-labelledby="showResourceModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title text-bold" id="showResourceModalLabel">Resource Details</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <table class="table table-bordered table-striped">

                        <tr>

                            <th style="width: 170px;">Vendor Details</th>

                            <td>

                                <span id="show_vendor_name"></span><br>

                                <span id="show_vendor_email"></span><br>

                                <span id="show_vendor_mobile"></span>

                            </td>

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

                            <th style="width: 170px;">Address</th>

                            <td><span id="show_address"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">PF Number</th>

                            <td><span id="show_pfno"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">ESI Number</th>

                            <td><span id="show_esi_no"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Category</th>

                            <td><span id="show_category"></span></td>

                        </tr>

                        <tr>

                            <th style="width: 170px;">Sub Category</th>

                            <td><span id="show_sub_category"></span></td>

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

            $('#resourceDataTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('sse.get-resources') }}',

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

                    $('.showResourceModalBtn').on('click', function(e) {

                        e.preventDefault();

                        $.ajax({

                            type: 'GET',

                            url: "/sse/resources/" + $(this).attr('data-resourceID'),

                            success: function(response) {

                                $('#show_vendor_name').html(response.vendor.name);

                                $('#show_vendor_email').html(response.vendor.email);

                                $('#show_vendor_mobile').html(response.vendor.mobile);

                                $('#show_name').html(response.name);

                                $('#show_email').html(response.email);

                                $('#show_mobile').html(response.mobile);

                                $('#show_address').html(response.address);

                                $('#show_pfno').html(response.pfno);

                                $('#show_esi_no').html(response.esi_no);

                                $('#show_category').html(response.category.name);

                                $('#show_sub_category').html(response.sub_category.name);

                                $('#show_photo').html('<img height="50" src="/storage/resources/'+ response.id + '/' + response.photo +'" alt="'+ response.name +'">');

                                $('#show_remarks').html(response.remarks);

                                $('#showResourceModal').modal('show');

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