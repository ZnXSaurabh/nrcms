@csrf

@isset($area)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id">
            <option value="">Select Location...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @isset($area)
                        {{ old('location_id', $location->id) == $area->location->id ? " selected" : "" }}
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
        <label for="name">Area</label>
        <input type="text" name="name" id="name" value="@isset($area){{ old('name', $area->name) }}@else{{ old('name')}}@endisset">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="desc">Description <span class="indicator">(optional)</span></label>
        <textarea name="desc" id="desc" rows="3">@isset($area){{ old('desc', $area->description) }}@else{{ old('desc')}}@endisset</textarea>   
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($area)
            <i data-feather="edit"></i> Update Area
        @else
            <i data-feather="save"></i> Save Area
        @endisset
    </button>
</div>