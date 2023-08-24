@extends('layouts.admin-template')



@section('title')

    Manage Unverified Users

@endsection



@section('page-heading')

    <h2>Manage Unverified Users</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">All Users</h3>

        <a class="btn sm-btn green-btn" href="{{ route('management.users.create') }}">

            <i data-feather="plus-circle"></i>

            New User

        </a>

    </div>



    <div class="content-area">

        

        @include('partials.common.alerts')



        <div class="table-responsive-md">

            <table id="userDatatable" class="table dataTable">

                <thead>

                    <tr>

                        <th class="sno">#</th>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Mobile No.</th>

                        <th>Register Date</th>

                        <th class="actions">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>



    <!-- Show User Info Modal -->

    <div class="custom-modal wide-custom-modal modal fade" id="showUserModal" tabindex="-1" role="dialog" aria-labelledby="showUserModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title text-bold" id="showUserModalLabel">User Details</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <figure id="show_photo" class="mb-3"></figure>

                        </div>

                        <div class="col-md-4 mb-3">

                            <span>Name</span>

                            <p><strong id="show_name"></strong></p>



                            <span>Email</span>

                            <p><strong id="show_email"></strong></p>



                            <span>Mobile Number</span>

                            <p><strong id="show_mobileno"></strong></p>



                            <span>Father's Name</span>

                            <p><strong id="show_fathername"></strong></p>



                            <span>PF Number</span>

                            <p><strong id="show_pfno"></strong></p>



                            <span>Department</span>

                            <p><strong id="show_department"></strong></p>



                            <span>Designation</span>

                            <p><strong id="show_designation"></strong></p>

                        </div>

                        <div class="col-md-4">

                            <span>Location</span>

                            <p><strong id="show_location_id"></strong></p>



                            <span>Area</span>

                            <p><strong id="show_area_id"></strong></p>



                            <span>Housetype</span>

                            <p><strong id="show_housetype_id"></strong></p>



                            <span>Block</span>

                            <p><strong id="show_block_id"></strong></p>



                            <span>Quarter Number</span>

                           <p><strong id="show_qtrno"></strong></p>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <form id="verifyForm" class="d-inline" action="" method="POST">

                        @csrf

                        <button type="submit" class="btn green-btn sm-btn"><i class="mr-1" data-feather="check"></i> Verify User</button>

                    </form>

                    <button type="button" class="btn btn-secondary" style="padding: 4px 15px;" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>



@endsection



@section('script')

    <script>

        $(function() {

            $('#userDatatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('management.verify-users-list') }}',

                columns: [

                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    { data: 'photo', name: 'photo' },

                    { data: 'name', name: 'name' },

                    { data: 'email', name: 'email' },

                    { data: 'mobileno', name: 'mobileno' },

                    { data: 'created_at', name: 'created_at' },

                    { data: 'actions', name: 'actions', orderable: false, searchable: false,

                        "render": function (data, type, row) { feather.replace(); return data; }

                    }

                ],

                fnDrawCallback: function( oSettings ) {

                    feather.replace();

                    $('.showUserModalBtn').on('click', function(e) {

                        e.preventDefault();

                        var user_id = $(this).attr('data-userID');

                        $.ajax({

                            type: 'GET',

                            url: "/management/users/" + user_id,

                            success: function(response) {

                                $('#show_photo').html('<img class="img-fluid" src="{{ asset('images/no-pic.png') }}" alt="'+ response.name +'">');

                                if (response.profile.photo) {

                                    $('#show_photo').html('<img class="img-fluid" src="/storage/users/'+ response.id + '/' + response.profile.photo +'" alt="'+ response.name +'">');

                                }

                                $('#show_name').html(response.name);

                                $('#show_email').html(response.email);

                                $('#show_mobileno').html(response.mobileno);

                                $('#show_fathername').html(response.profile.fathername);

                                $('#show_pfno').html(response.profile.pfno);

                                $('#show_department').html(response.profile.department);

                                $('#show_designation').html(response.profile.designation);

                                $('#show_location_id').html(response.profile.location.name);

                                if (response.profile.area) {

                                    $('#show_area_id').html(response.profile.area.name);

                                }

                                $('#show_housetype_id').html(response.profile.housetype.name);

                                $('#show_block_id').html(response.profile.block.name);
                                
                                if( response.profile.qtrno){
                                    // console.log(response);
                                    $('#show_qtrno').html(response.profile.quarter.qtrno);
                                }
                                

                                // $('#show_qtrno').html(response.quarter.qtrno);

                                $('#verifyForm').attr('action', '/management/verify-user/'+ user_id);

                                $('#showUserModal').modal('show');

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