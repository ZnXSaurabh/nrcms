@csrf

@isset($service_building)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id">
            <option value="">Select Location...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @isset($service_building)
                        {{ old('location_id', $service_building->location_id) == $location->id ? " selected" : "" }}
                    @else
                        {{ old('location_id') == $location->id ? " selected" : "" }}
                    @endisset
                >
                    {{ $location->name }}
                </option>
            @endforeach
        </select>

        @error('location_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="area_id">Area</label>
        <select name="area_id" id="area_id" @empty($service_building) disabled @endempty>
            @isset($service_building)
                <option value="{{ $area->id }}"{{ old('area_id', $service_building->area_id) == $area->id ? " selected" : "" }}>{{ $area->name }}</option>        
            @endisset
        </select>

        @error('area_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="name">Building Name</label>
        <input type="text" name="name" id="name" value="@isset($service_building){{ old('name', $service_building->name) }}@else{{ old('name')}}@endisset">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="area_covered">Area Covered <span class="indicator">(approx)</span></label>
        <input type="text" name="area_covered" id="area_covered" value="@isset($service_building){{ old('area_covered', $service_building->area_covered) }}@else{{ old('area_covered')}}@endisset">

        @error('area_covered')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3">@isset($service_building){{ old('address', $service_building->address) }}@else{{ old('address')}}@endisset</textarea>

        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="contact_no">Contact Number</label>
        <input type="text" name="contact_no" id="contact_no" value="@isset($service_building){{ old('contact_no', $service_building->contact_no) }}@else{{ old('contact_no')}}@endisset">
        
        @error('contact_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="email">Email <span class="indicator">(optional)</span></label>
        <input type="text" name="email" id="email" value="@isset($service_building){{ old('email', $service_building->email) }}@else{{ old('email')}}@endisset">
        
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="">Select Status...</option>
            <option value="Active"@isset($service_building){{ old('status', $service_building->status) == 'Active' ? " selected" : "" }}@else{{ old('status') == 'Active' ? " selected" : "" }}@endisset>Active</option>
            <option value="Deactive"@isset($service_building){{ old('status', $service_building->status) == 'Deactive' ? " selected" : "" }}@else{{ old('status') == 'Deactive' ? " selected" : "" }}@endisset>Deactive</option>
        </select>
        
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="description">Description <span class="indicator">(optional)</span></label>
        <textarea name="description" id="description" rows="3">@isset($service_building){{ old('description', $service_building->description) }}@else{{ old('description')}}@endisset</textarea>
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($service_building)
            <i data-feather="edit"></i> Update Service Building
        @else
            <i data-feather="save"></i> Save Service Building
        @endisset
    </button>
</div>

@section('script')
    <script>
        $('#location_id').on('change', function(e) {
            var location_id = e.target.value;
            if (location_id) {
                $.get('/areas-of-a-location/' + location_id, function(data) {
                    $('#area_id').empty().removeAttr('disabled');
                    $('#area_id').append('<option value="">Select Area...</option>');
                    $.each(data, function(index, area){
                        $('#area_id').append('<option value="'+ area.id +'">'+ area.name +'</option>');
                    });
                });
            } else {
                $('#area_id').empty().attr('disabled', 'disabled');
                $('#area_id').append('<option value="">Select Location First...</option>');
            }
        });
    </script>

@endsection