@csrf

@isset($block)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id">
            <option value="">Select Location...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @isset($block)
                        {{ old('location_id', $block->location_id) == $location->id ? " selected" : "" }}
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
        <select name="area_id" id="area_id" @empty($block) disabled @endempty>
            <option value="">Select Location First...</option>
            @isset($block)
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"{{ old('area_id', $block->area_id) == $area->id ? " selected" : "" }}>{{ $area->name }}</option>        
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
        <select name="housetype_id" id="housetype_id" @empty($block) disabled @endempty>
            <option value="">Select Area First...</option>
            @isset($block)
                @foreach ($housetypes as $housetype)
                    <option value="{{ $housetype->id }}"{{ old('housetype_id', $block->housetype_id) == $housetype->id ? " selected" : "" }}>{{ $housetype->name }}</option>        
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
        <label for="name">Block</label>
        <input type="text" name="name" id="name" value="@isset($block){{ old('name', $block->name) }}@else{{ old('name')}}@endisset">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="desc">Description <span class="indicator">(optional)</span></label>
        <textarea name="desc" id="desc" rows="3">@isset($block){{ old('desc', $block->description) }}@else{{ old('desc')}}@endisset</textarea>
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($block)
            <i data-feather="edit"></i> Update Block
        @else
            <i data-feather="save"></i> Save Block
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
    </script>

@endsection