@csrf

@isset($location)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="name">Location</label>
        <input type="text" name="name" id="name" value="@isset($location){{ old('name', $location->name) }}@else{{ old('name')}}@endisset" autofocus>
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="desc">Description <span class="indicator">(optional)</span></label>
        <textarea name="desc" id="desc" rows="3">@isset($location){{ old('desc', $location->description) }}@else{{ old('desc')}}@endisset</textarea>
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($location)
            <i data-feather="edit"></i> Update Location
        @else
            <i data-feather="save"></i> Save Location
        @endisset
    </button>
</div>