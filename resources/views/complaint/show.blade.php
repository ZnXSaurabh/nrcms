@extends('layouts.admin-template')


@section('title')

    Show Complaint

@endsection



@section('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css">

@endsection



@section('page-heading')

    <h2>Show Complaint</h2>

@endsection



@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="m-0">Complaint #{{ $complaint->comp_id }} Details</h3>

        <a class="btn sm-btn green-btn" href="{{ url()->previous() }}">

            <i data-feather="arrow-left"></i> Go Back

        </a>

    </div>



    <div class="row">

        <div class="col-md-6 mb-3">

            <div class="content-area">

                <div class="card">

                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h4>Complaint Details</h4>

                        <span>Status: <strong>{{ $complaint->status }}</strong></span>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">

                                <span class="head">Username</span>
                               @if(!empty($complaint->user->name))
                                <p class="card-text">{{ $complaint->user->name }}</p>
                               @else
                               <p class="card-text"></p>
                               @endif
                                <span class="head">Father's Name</span>

                                <p class="card-text">{{ $complaint->user->profile->fathername ?? 'NA' }}</p>

                                <span class="head">Mobile Number</span>
                                     @if(!empty($complaint->user->mobileno ))
                                <p class="card-text">{{ $complaint->user->mobileno }}</p>
                                @else
                                
                                <p class="card-text"></p>
                                @endif
                                <span class="head">Email</span>

                                <p class="card-text">{{ $complaint->user->email ?? 'NA' }}</p>

                            </div>

                            <div class="col-md-4">

                                <span class="head">Launch Date</span>

                                <p class="card-text">{{ date('d-m-Y', strtotime($complaint->created_at)) }}</p>



                                <span class="head">Complaint Type</span>

                                <p class="card-text">{{ $complaint->comp_type }}</p>



                                <span class="head">Category</span>

                                <p class="card-text">{{ $complaint->category->name }}</p>



                                <span class="head">Sub Category</span>

                                <p class="card-text">{{ $complaint->subcategory->name }}</p>

                            </div>

                            <div class="col-md-4">

                                <span class="head">Location</span>

                                <p class="card-text">{{ $complaint->location->name }}</p>



                                <span class="head">Area</span>

                                <p class="card-text">{{ $complaint->user->profile->quarter->area->name ?? 'NA' }}</p>

                                
                                <span class="head">Quarter No.</span>

                                <p class="card-text">{{ $complaint->user->profile->quarter->qtrno ?? 'NA' }}</p>
                                
                                <span class="head">Block</span>

                                <p class="card-text">{{ $complaint->user->profile->block->name ?? 'NA' }}</p>
                                <!-- Edited by Ashish Purohit on 15 -03-2022-->

                                @if($complaint->comp_type == 'Service Building')

                                    <span class="head">Service Building</span>

                                    <p class="card-text">{{ $complaint->service_building->name ?? 'NA' }}</p>

                                @endif

                            </div>

                            <div class="col-12 mt-4">

                                <span class="head">Description</span>

                                <p class="card-text">{{ $complaint->description }}</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-md-6 mb-3">

            <div class="content-area">           

                <div class="card">

                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h4 class="m-0">Complaint Images</h4>

                        <span>(click to enlarge)</span>

                    </div>

                    <div class="card-body">

                        @if ( !json_decode($complaint->images) )

                            <p class="card-text">Images not available.</p>

                        @else 

                            <div class="row">

                                @foreach(json_decode($complaint->images) as $image)

                                    <a class="col-md-4 col-sm-6 mb-3" data-fancybox="gallery" data-caption="{{ $complaint->comp_id }}" href="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/' . $image) }}">

                                        <img class="img-fluid img-thumbnail" src="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/' . $image) }}" alt="{{ $complaint->comp_id }}">

                                    </a>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        @if ($complaint->status === 'Resolved')

            <div class="col-md-6 mb-3">

                <div class="content-area">           

                    <div class="card">

                        <div class="card-header d-flex align-items-center justify-content-between">

                            <h4 class="m-0">Resolution Details</h4>

                            <span>(Proof of job completion)</span>

                        </div>

                        <div class="card-body">

                            <div class="mb-4">

                                <p>Resolution Date: <strong>{{ date('d-m-Y h:m A', strtotime($complaint->resolution_date)) }}</strong></p>

                            </div>



                            <div class="mb-4">

                                <span class="head">Resolution Summary</span>

                                <p class="card-text">{{ $complaint->resolution }}</p>

                            </div>



                            @if ( !json_decode($complaint->resolution_images) )

                                <p class="card-text">Images not available.</p>

                            @else 

                                <div class="row">

                                    @foreach(json_decode($complaint->resolution_images) as $image)

                                        <a class="col-md-4 col-sm-6 mb-3" data-fancybox="resolution-gallery" data-caption="{{ $complaint->comp_id }}" href="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/resolution-images/' . $image) }}">

                                            <img class="img-fluid img-thumbnail" src="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/resolution-images/' . $image) }}" alt="{{ $complaint->comp_id }}">

                                        </a>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @endif
        @role(['sse','den','aden']))
            @if($complaint->status === 'Initiated')

                    <div class="col-md-6 mb-3">

            <div class="content-area">

                <div class="card">

                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h4>Job Allocation Details</h4>

                        @if($complaint->allocateJob)

                            <span>Estimated Days: <strong>{{ $complaint->allocateJob->estimated_days }} Days</strong></span>

                        @endif

                    </div>

                    <div class="card-body">

                        @if($complaint->allocateJob)

                            <div class="row">

                                <div class="col-12">

                                    <p>Job Allocation Date: <strong>{{ date('d-m-Y h:m A', strtotime($complaint->allocateJob->created_at)) }}</strong></p>

                                </div>

                                <div class="col-md-6">

                                    <span class="head">Vendor Name</span>

                                    <p class="card-text">{{ $complaint->allocateJob->vendor->name }}</p>



                                    <span class="head">Vendor Email</span>

                                    <p class="card-text">{{ $complaint->allocateJob->vendor->email }}</p>



                                    <span class="head">Vendor Mobile</span>

                                    <p class="card-text">{{ $complaint->allocateJob->vendor->mobile }}</p>

                                </div>

                                <div class="col-md-6">

                                    <span class="head">Resource Name</span>

                                    <p class="card-text">{{ $complaint->allocateJob->resource->name }}</p>



                                    <span class="head">Resource Email</span>

                                    <p class="card-text">{{ $complaint->allocateJob->resource->email }}</p>



                                    <span class="head">Resource Mobile</span>

                                    <p class="card-text">{{ $complaint->allocateJob->resource->mobile }}</p>

                                </div>

                            </div>

                        @else

                            @role(['user'])

                                <p class="mb-0">Job has not been allocated yet by the SSE. Check back later.</p>

                            @endrole

                            @role(['sse'])

                                @include('partials.common.alerts')



                                <form action="{{ route('complaint.allocate-job', $complaint->id) }}" method="POST">

                                    @csrf

                                    <div class="form-group">

                                        <label for="complaint_priority">Select Complaint Priority</label>

                                        <select name="complaint_priority" id="complaint_priority">

                                            <option value="">Choose Priority...</option>
                                            <option value="Urgent">Urgent</option>
                                            <option value="Minor">Minor</option>
                                            <option value="Major">Major</option>

                                        </select>



                                        @error('complaint_priority')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="estimated_days">Estimated Days</label>

                                        <select name="estimated_days" id="estimated_days">

                                            <option value="">Select Days...</option>

                                            @for ($i = 1; $i < 21; $i++)

                                                <option value="{{ $i }}">{{ $i }}</option>

                                            @endfor

                                        </select>



                                        @error('estimated_days')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="vendor_id">Select Vendor</label>

                                        <select name="vendor_id" id="vendor_id">

                                            <option value="">Choose Vendor...</option>

                                            @foreach($vendors as $vendor)

                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>

                                            @endforeach

                                        </select>



                                        @error('vendor_id')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>



                                    <div class="form-group">

                                        <label for="resource_id">Select Resource</label>

                                        <select name="resource_id" id="resource_id" disabled>

                                            <option value="">Choose Vendor First...</option>

                                        </select>

                                        @error('resource_id')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="remark">SSE Remark</label>

                                        <textarea name="remark" class="form-control"></textarea>



                                        @error('remark')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>

                                    <button class="btn green-btn" type="submit"><i class="mr-1" data-feather="tool"></i> Allocate Job</button>

                                </form>

                            @endrole

                        @endif

                    </div>

                </div>

            </div>
        </div>
        
            <div class="col-md-6 mb-3">

                <div class="content-area">

                    <div class="card">

                        <div class="card-header d-flex align-items-center justify-content-between">

                            <h4>Mark Duplicate Complaint</h4>

                        </div>

                        <div class="card-body">

                            @include('partials.common.alerts')

                            <form action="{{ route('complaint.mark-duplicate', $complaint->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <label for="mark_resolutionduplicate">Choose Complaints</label>
                                    
                                    <select name="resolution[]" id="resolution" class="multi-select" multiple>
                                        @foreach($oldComplaints as $complaint)
                                            <option value="Marked duplicate with {{ $complaint->comp_id }}">{{ $complaint->comp_id }}</option>
                                        @endforeach
                                    </select>

                                    @error('mark_duplicate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn green-btn" type="submit"><i class="mr-1" data-feather="check-circle"></i> Mark Duplicate</button>

                            </form>
                            
                        </div>

                    </div>

                </div>

            </div>
        @endif
        
            @if($complaint->status === 'Allocated')

                <div class="col-md-6 mb-3">

                    <div class="content-area">

                        <div class="card">

                            <div class="card-header d-flex align-items-center justify-content-between">

                                <h4>Resolve Complaint</h4>

                                <span>(Mark Complaint Resolved)</span>

                            </div>

                            <div class="card-body">

                                @include('partials.common.alerts')

                                <form action="{{ route('complaint.resolve-job', $complaint->id) }}" method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">

                                        <label for="resolution">Resolution Summary</label>

                                        <textarea name="resolution" id="resolution" rows="5">{{ old('resolution') }}</textarea>

                                        @error('resolution')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="resolution_images">Resolution Images <span class="indicator">(optional or you can select upto 5 images at a time)</span></label>

                                        <input type="file" name="resolution_images[]" id="resolution_images" multiple>

                                        @error('resolution_images')

                                            <div class="invalid-feedback">{{ $message }}</div>

                                        @enderror

                                    </div>



                                    <button class="btn green-btn" type="submit"><i class="mr-1" data-feather="check-square"></i> Resolve Job</button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="col-12">

                    <div class="content-area">

                        <div id="jobCard">

                            <div class="row">

                                <div class="col" style="border-right: 2px dashed #000;">

                                    <div class="table-responsive-md">

                                        <table class="table table-bordered table-striped mb-0" width="100%" style="font-size: 80%;">

                                            <thead>

                                                <tr>

                                                    <td colspan="2" class="text-center">

                                                        <h4>Delhi Division Northern Railway</h2>

                                                        <h5>Complaint Management System</h2>

                                                        <h6>Job Card</h4>

                                                    </td>

                                                </tr>

                                            </thead>

                                            <tr>

                                                <th>Compaint ID</th>

                                                <td>{{ $complaint->comp_id }}</td>

                                            </tr>

                                            <tr>

                                                <th>Department</th>

                                                <td>{{ \App\Models\SuperCategory::where('id',$complaint->sup_cat_id)->pluck('name')[0] }}</td>

                                            </tr>

                                            <tr>

                                                <th>Complaint Date & Time</th>

                                                <td>{{ date('j F, Y h:m A', strtotime($complaint->created_at)) }}</td>

                                            </tr>

                                            <tr>

                                                <th>Complaint Description</th>

                                                <td>{{ $complaint->description }}</td>

                                            </tr>

                                            <tr>

                                                <th>Username</th>

                                                <td>{{ $complaint->user->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Email</th>

                                                <td>{{ $complaint->user->email }}</td>

                                            </tr>

                                            <tr>

                                                <th>Mobile Number</th>

                                                <td>{{ $complaint->user->mobileno }}</td>

                                            </tr>

                                            <tr>

                                                <th>Address</th>
                                            <!-- Code edited by Ashish Purohit on 03-03-2022 -->
                                                <td>Quarter No. {{ $complaint->user->profile->quarter->qtrno }}, Block {{ $complaint->user->profile->block->name }}, {{ $complaint->user->profile->housetype->name }}, @isset($complaint->user->profile->area->name) {{ $complaint->user->profile->area->name }}, @endisset {{ $complaint->user->profile->location->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Resource Name</th>

                                                <td>{{ $complaint->allocateJob->resource->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Resource Mobile Number</th>

                                                <td>{{ $complaint->allocateJob->resource->mobile }}</td>

                                            </tr>

                                            <tr>

                                                <th>Estimated Days</th>

                                                <td>{{ $complaint->allocateJob->estimated_days }} Days</td>

                                            </tr>

                                            <tr>

                                                <th>Category</th>

                                                <td>{{ $complaint->category->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Sub Category</th>

                                                <td>{{ $complaint->subcategory->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Allocation Time</th>

                                                <td>{{ date('j F Y h:m A', strtotime($complaint->allocateJob->created_at)) }}</td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <div style="padding: 50px 0 0; text-align: center;">Customer Signature</div>

                                                </td>

                                                <td>

                                                    <div style="padding: 50px 0 0; text-align: center;">SSE Signature</div>

                                                </td>

                                            </tr>

                                        </table>

                                    </div>

                                </div>

                                <div class="col">

                                    <div class="table-responsive-md">

                                        <table class="table table-bordered table-striped mb-0" width="100%" style="font-size: 80%;">

                                            <thead>

                                                <tr>

                                                    <td colspan="2" class="text-center">

                                                        <h4>Delhi Division Northern Railway</h2>

                                                        <h5>Complaint Management System</h2>

                                                        <h6>Job Card</h4>

                                                    </td>

                                                </tr>

                                            </thead>

                                            <tr>

                                                <th>Compaint ID</th>

                                                <td>{{ $complaint->comp_id }}</td>

                                            </tr>

                                            <tr>

                                                <th>Department</th>

                                                <td>{{ \App\Models\SuperCategory::where('id',$complaint->sup_cat_id)->pluck('name')[0] }}</td>

                                            </tr>
                                            
                                            <tr>

                                                <th>Complaint Date & Time</th>

                                                <td>{{ date('j F, Y h:m A', strtotime($complaint->created_at)) }}</td>

                                            </tr>

                                            <tr>

                                                <th>Complaint Description</th>

                                                <td>{{ $complaint->description }}</td>

                                            </tr>

                                            <tr>

                                                <th>Username</th>

                                                <td>{{ $complaint->user->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Email</th>

                                                <td>{{ $complaint->user->email }}</td>

                                            </tr>

                                            <tr>

                                                <th>Mobile Number</th>

                                                <td>{{ $complaint->user->mobileno }}</td>

                                            </tr>

                                            <tr>

                                                <th>Address</th>
                                            <!-- Code edited by Ashish Purohit on 03-03-2022 -->
                                                <td>Quarter No. {{ $complaint->user->profile->quarter->qtrno }}, Block {{ $complaint->user->profile->block->name }}, {{ $complaint->user->profile->housetype->name }}, @isset($complaint->user->profile->area->name) {{ $complaint->user->profile->area->name }}, @endisset {{ $complaint->user->profile->location->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Resource Name</th>

                                                <td>{{ $complaint->allocateJob->resource->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Resource Mobile Number</th>

                                                <td>{{ $complaint->allocateJob->resource->mobile }}</td>

                                            </tr>

                                            <tr>

                                                <th>Estimated Days</th>

                                                <td>{{ $complaint->allocateJob->estimated_days }} Days</td>

                                            </tr>

                                            <tr>

                                                <th>Category</th>

                                                <td>{{ $complaint->category->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Sub Category</th>

                                                <td>{{ $complaint->subcategory->name }}</td>

                                            </tr>

                                            <tr>

                                                <th>Allocation Time</th>

                                                <td>{{ date('j F Y h:m A', strtotime($complaint->allocateJob->created_at)) }}</td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <div style="padding: 50px 0 0; text-align: center;">Customer Signature</div>

                                                </td>

                                                <td>

                                                    <div style="padding: 50px 0 0; text-align: center;">SSE Signature</div>

                                                </td>

                                            </tr>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-12 text-center mt-4">
                            @desktop
                                <button id="printJobCard" type="button" class="btn green-ghost-btn"><i data-feather="printer" class="mr-1"></i> Print Job Card</button>
                            @enddesktop
                        </div>

                    </div>

                </div>

            @endif

        @endif

        @if ($complaint->status === 'Resolved')

            <div class="col-md-6 mb-3">

                <div class="content-area">           

                    <div class="card">

                        <div class="card-header d-flex align-items-center justify-content-between">

                            <h4 class="m-0">Resolution Images</h4>

                            <span>(Proof of job completion)</span>

                        </div>

                        <div class="card-body">

                            @if ( !json_decode($complaint->resolution_images) )

                                <p class="card-text">Images not available.</p>

                            @else 

                                <div class="row">

                                    @foreach(json_decode($complaint->resolution_images) as $image)

                                        <a class="col-md-4 col-sm-6 mb-3" data-fancybox="resolution-gallery" data-caption="{{ $complaint->comp_id }}" href="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/resolution-images/' . $image) }}">

                                            <img class="img-fluid img-thumbnail" src="{{ \Illuminate\Support\Facades\Storage::url('complaint-images/' . str_replace('/', '', $complaint->comp_id) . '/resolution-images/' . $image) }}" alt="{{ $complaint->comp_id }}">

                                        </a>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @endif

        
        @if ($complaint->status === 'Resolved')

            @if (empty($complaint->feedback))

                @role(['user'])

                    <div class="col-md-6 mb-3">

                        <div class="content-area">

                            <div class="card">

                                <div class="card-header d-flex align-items-center justify-content-between">

                                    <h4>Complaint Feedback</h4>

                                    <span>(satisfied or not)</span>

                                </div>

                                <div class="card-body">

                                    @include('partials.common.alerts')

                                    <form action="{{ route('complaint.feedback', $complaint->id) }}" method="POST">

                                        @csrf

                                        <div class="form-group">

                                            <label for="feedback">Feedback</label>

                                            <textarea name="feedback" id="feedback" rows="5">{{ old('feedback') }}</textarea>

                                            @error('feedback')

                                                <div class="invalid-feedback">{{ $message }}</div>

                                            @enderror

                                        </div>

                                        <div class="form-group">

                                            <label for="satisfaction_level">Satisfaction Level</label>

                                            <select name="satisfaction_level" id="satisfaction_level">

                                                <option value="">Choose Level...</option>

                                                <option value="Very Satisfied">Very Satisfied</option>

                                                <option value="Satisfied">Satisfied</option>

                                                <option value="OK">OK</option>

                                                <option value="Disatisfied">Disatisfied</option>

                                                <option value="Very Disatisfied">Very Disatisfied</option>

                                            </select>

                                            @error('satisfaction_level')

                                                <div class="invalid-feedback">{{ $message }}</div>

                                            @enderror

                                        </div>

                                        <button class="btn green-btn" type="submit"><i class="mr-1" data-feather="message-square"></i> Submit</button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endrole

            @else

                <div class="col-md-6 mb-3">

                    <div class="content-area">

                        <div class="card">

                            <div class="card-header d-flex align-items-center justify-content-between">

                                <h4 class="m-0">Complaint Feedback</h4>

                                <span>(user feeback)</span>

                            </div>

                            <div class="card-body">

                                @include('partials.common.alerts')

                                <span class="head">Satisfaction Level</span>

                                <p class="card-text">{{ $complaint->satisfaction_level }}</p>

                                <span class="head">Feedback</span>

                                <p class="card-text">{{ $complaint->feedback }}</p>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        @endif

    </div>

@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>

    <script>

        $('#vendor_id').on('change', function(e) {

            var vendor_id = e.target.value;

            if (vendor_id) {

                $.get('/resources-of-a-vendor/' + vendor_id, function(data) {

                    $('#resource_id').empty().removeAttr('disabled');

                    $('#resource_id').append('<option value="">Select Resource...</option>');

                    $.each(data, function(index, resource){
                        
                        $('#resource_id').append('<option value="'+ resource.id +'">'+ resource.name +' -> '+ resource.cat_name +'</option>');

                    });

                });

            } else {

                $('#resource_id').empty().attr('disabled', 'disabled');

                $('#resource_id').append('<option value="">Select Vendor First...</option>');

            }

        });

        $('#printJobCard').on('click', function() { 

			var divElements = document.getElementById('jobCard').innerHTML;

			var oldPage = document.body.innerHTML; 

			document.body.innerHTML = "<html><head><title>NRCMS Job Card</title></head><body>" + divElements + "</body>"; window.print(); 

			document.body.innerHTML = oldPage;
 
		});

        $(".multi-select").select2({
            placeholder: "You can select multiple complaints",
            allowClear: true,
            width: 'resolve' // need to override the changed default
        });
        jQuery('.select2-search input').prop('readonly', true);
        jQuery(document).on('touchend', function(){
            jQuery(".select2-search, .select2-focusser").remove();
        });
    </script>
    
@endsection