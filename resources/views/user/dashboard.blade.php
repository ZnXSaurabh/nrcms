@extends('layouts.admin-template')

@section('title')

    User Dashboard

@endsection

@section('content')

    <div class="row mb-3">

        <div class="col-12">

            <h2>Complaints</h2>

        </div>

        <div class="col-6 col-md-3">

            <div class="counter-card green d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">All</span>

                    <span class="counter">{{ $complaints }}</span>

                </div>

                <div class="body">

                    <i data-feather="archive"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-3">

            <div class="counter-card purple d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Initiated</span>

                    <span class="counter">{{ $complaints_initiated }}</span>

                </div>

                <div class="body">

                    <i data-feather="server"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-3">

            <div class="counter-card pink d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">In Progress</span>

                    <span class="counter">{{ $complaints_progress }}</span>

                </div>

                <div class="body">

                    <i data-feather="layers"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-3">

            <div class="counter-card orange d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Resolved</span>

                    <span class="counter">{{ $complaints_resolved }}</span>

                </div>

                <div class="body">

                    <i data-feather="check-circle"></i>

                </div>

            </div>

        </div>
        <div class="col-6 col-md-4">

            <div class="counter-card orange d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Civil</span>

                    <span class="counter">{{ $civil_complaint }}</span>

                </div>

                <div class="body">

                    <i data-feather="server"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-4">

            <div class="counter-card purple d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Electrical</span>

                    <span class="counter">{{ $electrical_complaint }}</span>

                </div>

                <div class="body">

                    <i data-feather="server"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-4">

            <div class="counter-card green d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">S&T</span>

                    <span class="counter">{{ $sandt_complaint }}</span>

                </div>

                <div class="body">

                    <i data-feather="server"></i>

                </div>

            </div>

        </div>

    </div>

    @mobile
    <div class="row mb-3">

        <div class="col-12">

            <h2>Create Complaint</h2>

        </div>

        <div class="col-12 col-md-3">
            <a href="{{ route('complaint.super-categories') }}">
                <div class="counter-card green d-flex align-items-center justify-content-between">

                    <div class="header">

                        <span class="head">Quarter</span>

                    </div>

                    <div class="body">

                        <i data-feather="home"></i>

                    </div>

                </div>
            </a>
        </div>

        <div class="col-6 col-md-3 d-none">
            <a href="{{ route('complaint.location') }}">
                <div class="counter-card purple d-flex align-items-center justify-content-between">

                    <div class="header">

                        <span class="head">Building</span>                    

                    </div>

                    <div class="body">

                        <i data-feather="codesandbox"></i>

                    </div>

                </div>
            </a>
        </div>

    </div>
    @endmobile

    @desktop
    <div class="row">

        <div class="col-12">

            <h2>User Profile</h2>

        </div>

        <div class="col-12">

            <div class="content-area">

                <div class="row">

                    <div class="col-md-4">

                        <figure class="mb-3">

                            @if (auth()->user()->profile->photo)

                                <img src="{{ asset(Illuminate\Support\Facades\Storage::url('users/'.auth()->user()->id.'/'.auth()->user()->profile->photo)) }}" alt="{{ auth()->user()->name }}" class="img-fluid">

                            @else

                                <img src="{{ asset('images/no-pic.png') }}" alt="{{ auth()->user()->name }}">

                            @endif

                        </figure>

                    </div>

                    <div class="col-md-4 mb-3">

                        <span>Name</span>

                        <p><strong>{{ auth()->user()->name }}</strong></p>



                        <span>Email</span>

                        <p><strong>{{ auth()->user()->email }}</strong></p>



                        <span>Mobile Number</span>

                        <p><strong>{{ auth()->user()->mobileno }}</strong></p>



                        <span>Father's Name</span>

                        <p><strong>{{ auth()->user()->profile->fathername ?? 'NA' }}</strong></p>



                        <span>PF Number</span>

                        <p><strong>{{ auth()->user()->profile->pfno ?? 'NA' }}</strong></p>



                        <span>Department</span>

                        <p><strong>{{\App\Models\SuperCategory::where(['id' => auth()->user()->profile->department])->first()->name ?? 'NA' }}</strong></p>



                        <span>Designation</span>

                        <p><strong>{{ auth()->user()->profile->designation ?? 'NA' }}</strong></p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <span>Location</span>

                        <p><strong>{{ auth()->user()->profile->location->name ?? 'NA' }}</strong></p>



                        <span>Area</span>

                        <p><strong>{{ auth()->user()->profile->area->name ?? 'NA' }}</strong></p>



                        <span>Housetype</span>

                        <p><strong>{{ auth()->user()->profile->housetype->name ?? 'NA' }}</strong></p>



                        <span>Block</span>

                        <p><strong>{{ auth()->user()->profile->block->name ?? 'NA' }}</strong></p>



                        <span>Quarter Number</span>

                        <p><strong>{{ auth()->user()->profile->quarter->qtrno ?? 'NA' }}</strong></p>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @enddesktop

@endsection