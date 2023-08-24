@csrf

@isset($quarter)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id">
            <option value="">Select Location...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @isset($quarter)
                        {{ old('location_id', $quarter->location_id) == $location->id ? " selected" : "" }}
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
        <select name="area_id" id="area_id" @empty($quarter) disabled @endempty>
            <option value="">Select Location First...</option>
            @isset($quarter)
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"{{ old('area_id', $quarter->area_id) == $area->id ? " selected" : "" }}>{{ $area->name }}</option>        
                @endforeach
            @endisset
        </select>

        @error('area_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="housetype_id">Housetype</label>
        <select name="housetype_id" id="housetype_id" @empty($quarter) disabled @endempty>
            <option value="">Select Area First...</option>
            @isset($quarter)
                @foreach ($housetypes as $housetype)
                    <option value="{{ $housetype->id }}"{{ old('housetype_id', $quarter->housetype_id) == $housetype->id ? " selected" : "" }}>{{ $housetype->name }}</option>        
                @endforeach
            @endisset
        </select>

        @error('housetype_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="block_id">Block</label>
        <select name="block_id" id="block_id" @empty($quarter) disabled @endempty>
            <option value="">Select Housetype First...</option>
            @isset($quarter)
                @foreach ($blocks as $block)
                    <option value="{{ $block->id }}"{{ old('block_id', $quarter->block_id) == $block->id ? " selected" : "" }}>{{ $block->name }}</option>        
                @endforeach
            @endisset
        </select>

        @error('block_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="qtrno">Quarter Number</label>
        <input type="text" name="qtrno" id="qtrno" value="@isset($quarter){{ old('qtrno', $quarter->qtrno) }}@else{{ old('qtrno')}}@endisset">
        
        @error('qtrno')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="rent">Rent</label>
        <input type="text" name="rent" id="rent" value="@isset($quarter){{ old('rent', $quarter->rent) }}@else{{ old('rent')}}@endisset">
        
        @error('rent')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="house_area">House Area <span class="indicator">(in sq. ft.)</span></label>
        <input type="text" name="house_area" id="house_area" value="@isset($quarter){{ old('house_area', $quarter->house_area) }}@else{{ old('house_area')}}@endisset">
        
        @error('house_area')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="garages">No. of Garages</label>
        <input type="text" name="garages" id="garages" value="@isset($quarter){{ old('garages', $quarter->garages) }}@else{{ old('garages')}}@endisset">
        
        @error('garages')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="">Select Status...</option>
            <option value="Available"@isset($quarter){{ old('status', $quarter->status) == 'Available' ? " selected" : "" }}@else{{ old('status') == 'Available' ? " selected" : "" }}@endisset>Available</option>
            <option value="Occupied"@isset($quarter){{ old('status', $quarter->status) == 'Occupied' ? " selected" : "" }}@else{{ old('status') == 'Occupied' ? " selected" : "" }}@endisset>Occupied</option>
        </select>
        
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="remarks">Remarks <span class="indicator">(optional)</span></label>
        <textarea name="remarks" id="remarks" rows="3">@isset($quarter){{ old('remarks', $quarter->remarks) }}@else{{ old('remarks')}}@endisset</textarea>
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($quarter)
            <i data-feather="edit"></i> Update Quarter
        @else
            <i data-feather="save"></i> Save Quarter
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

        $('#area_id').on('change', function(e) {
            var area_id = e.target.value;
            if (area_id) {
                $.get('/housetypes-of-an-area/' + area_id, function(data) {
                    $('#housetype_id').empty().removeAttr('disabled');
                    $('#housetype_id').append('<option value="">Select Housetype...</option>');
                    $.each(data, function(index, housetype){
                        $('#housetype_id').append('<option value="'+ housetype.id +'">'+ housetype.name +'</option>');
                    });
                });
            } else {
                $('#housetype_id').empty().attr('disabled', 'disabled');
                $('#housetype_id').append('<option value="">Select Area First...</option>');
            }
        });

        $('#housetype_id').on('change', function(e) {
            var housetype_id = e.target.value;
            if (housetype_id) {
                $.get('/blocks-of-a-housetype/' + housetype_id, function(data) {
                    $('#block_id').empty().removeAttr('disabled');
                    $('#block_id').append('<option value="">Select Block...</option>');
                    $.each(data, function(index, block){
                        $('#block_id').append('<option value="'+ block.id +'">'+ block.name +'</option>');
                    });
                });
            } else {
                $('#block_id').empty().attr('disabled', 'disabled');
                $('#block_id').append('<option value="">Select Housetype First...</option>');
            }
        });
    </script>

@endsection