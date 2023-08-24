@extends('layouts.admin-template')
@section('title')
User Submit Complaint
@endsection
@section('content')
<div class="content-container">
	<header class="row">
		<div class="col heading">
			<a class="go-back-btn" href="#" onclick="window.history.go(-1); return false;" title="Go Back"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 198.194 198.194" style="enable-background:new 0 0 198.194 198.194;" xml:space="preserve" width="25px" height="25px"><g><path d="M132.447,46.884h-88.02l7.267-7.267c4.531-4.531,4.531-11.873,0-16.41   c-4.531-4.531-11.873-4.531-16.41,0l-27.07,27.07c-0.005,0.005-0.011,0.005-0.011,0.005L0,58.491l8.202,8.197   c0,0,0.005,0.005,0.011,0.016L37.214,95.7c2.268,2.268,5.238,3.399,8.202,3.399c2.975,0,5.939-1.131,8.208-3.399   c4.531-4.531,4.531-11.873,0-16.41l-9.197-9.197h88.02c23.459,0,42.544,19.091,42.544,42.544s-19.091,42.544-42.544,42.544H16.421   c-6.413,0-11.607,5.194-11.607,11.602c0,6.407,5.194,11.602,11.607,11.602h116.026c36.257,0,65.747-29.496,65.747-65.747   S168.703,46.884,132.447,46.884z" fill="#D2D1D7"></path></g></svg></a>
			<span>|</span>
			<h3>Submit Complaint</h3>
		</div>
	</header>
</div>
<hr>
<div class="row mb-3">
	<div class="col">
		@include('partials.common.alerts')
		<form action="{{ route('complaints.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-7">
			        <div class="form-group">
			        	@csrf
					    @if (auth()->user()->hasAnyRole('user'))
					        <input type="hidden" name="user_id" value={{ auth()->user()->id }}>
					    @endif
					    
					    @if(null !== Session::get('location_id'))
					    	<input type="hidden" name="comp_type" value="Service Building">
					    	<input type="hidden" name="location_id" value="{{ Session::get('location_id') }}">
					    @else
					    	<input type="hidden" name="comp_type" value="Quarter">
							<input type="hidden" name="location_id" value="" disabled="">
					    @endif

					    <input type="hidden" name="area_id" value="">

						@if(null !== Session::get('service_building_id'))
					    <input type="hidden" name="service_building_id" value="{{ Session::get('service_building_id') }}">
					    @else
					    <input type="hidden" name="service_building_id" value="">
					    @endif

					    <input type="hidden" name="sup_cat_id" value="{{ $complaintdetails->sup_cat_id }}">
					    <input type="hidden" name="category_id" value="{{ $complaintdetails->category_id }}">
					    <input type="hidden" name="sub_category_id" value="{{ $complaintdetails->id }}">
			            
			            <label for="description">Description</label>
			            <textarea name="description" id="description" rows="3">@isset($complaint){{ old('description', $complaint->description) }}@else{{ old('description')}}@endisset</textarea>
			            
			            @error('description')
			                <div class="invalid-feedback">{{ $message }}</div>
			            @enderror
			        </div>
			    </div>
			    <div class="col-md-7">
			        <div class="form-group">
			            <label for="images">Complaint Images <span class="indicator">(optional or you can select upto 5 images at a time)</span></label>
			            <input type="file" name="images[]" id="images" max="5" multiple>
			            @error('images.*')
			                <div class="invalid-feedback">{{ $message }}</div>
			            @enderror
			        </div>
			    </div>		            
			    <div class="col-12">
			        <button class="btn green-btn" type="submit">
			                <i class="mr-1" data-feather="save"></i> Save Complaint
			        </button>
			    </div>
			</div>
		</form>
	</div>
</div>
@endsection