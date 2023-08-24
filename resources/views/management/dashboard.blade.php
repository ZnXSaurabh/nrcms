@extends('layouts.admin-template')

@section('title')

    Dashboard

@endsection

@section('page-heading')

    Dashboard

@endsection

@section('content')

    <div class="row mb-3">

        <div class="col-12">

            <h2>Complaints</h2>

        </div>
        
         @if(auth()->user()->hasAnyRoles(['sden','den','aden']))
        <div class="col-6 col-md-3">

            <div class="counter-card orange d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Total Users</span>

                    <span class="counter">{{ $total_users }}</span>

                </div>

                <div class="body">

                    <i data-feather="check-circle"></i>

                </div>

            </div>

        </div>
        @endif
        
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
        
         @if(auth()->user()->hasAnyRoles(['super-admin','helpdesk','sse']))
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
        @endif
        
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

        @if(auth()->user()->hasAnyRole('sse'))
        <div class="col-6 col-md-3">

            <div class="counter-card orange d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Vendors</span>

                    <span class="counter">{{ $vendors }}</span>

                </div>

                <div class="body">

                    <i data-feather="check-circle"></i>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-3">

            <div class="counter-card orange d-flex align-items-center justify-content-between">

                <div class="header">

                    <span class="head">Resources</span>

                    <span class="counter">{{ $resources }}</span>

                </div>

                <div class="body">

                    <i data-feather="check-circle"></i>

                </div>

            </div>

        </div>
        @endif

    </div>


    <div class="row">

        <div class="col-12">

            <h2>Recent Complaints</h2>

        </div>

        <div class="col-12">

            <div class="table-responsive-md">

                <table class="table dataTable sse-dashboard">

                    <thead>

                        <tr>

                            <th class="sno">#</th>

                            <th>Type</th>

                            <th>Complaint ID</th>

                            <th>Category</th>

                            <th>Sub Category</th>

                            <th>Status</th>

                            <th class="actions">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($complaints_latest as $key => $complaint)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $complaint->comp_type }}</td>

                                <td>{{ $complaint->comp_id }}</td>

                                <td>{{ $complaint->category->name }}</td>

                                <td>{{ $complaint->subcategory->name }}</td>

                                <td>{{ $complaint->status }}</td>

                                <td class="actions">

                                    <a class="action-btn show-btn mr-1" href="{{ route('complaints.show', $complaint->id) }}" title="Show complaint">

                                        <i data-feather="eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>       

        </div>

    </div>

@endsection