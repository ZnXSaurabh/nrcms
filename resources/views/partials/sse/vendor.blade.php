@csrf

@isset($vendor)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id">
            <option value="">Select Location...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @isset($vendor)
                        {{ old('location_id', $vendor->location_id) == $location->id ? " selected" : "" }}
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

            <label for="sup_cat_id">Department</label>

            <select name="sup_cat_id" id="sup_cat_id">

                <option value="">Select Department...</option>

                @foreach ($supercategories as $category)

                    <option value="{{ $category->id }}"

                        @isset($vendor)

                            {{ old('sup_cat_id', $vendor->sup_cat_id) == $category->id ? " selected" : "" }}

                        @else

                            {{ old('sup_cat_id') == $category->id ? " selected" : "" }}

                        @endisset

                    >

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>



            @error('sup_cat_id')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div>

<div class="col-md-7">
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="@isset($vendor){{ old('name', $vendor->name) }}@else{{ old('name')}}@endisset">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="email">Email <span class="indicator">(optional)</span></label>
        <input type="text" name="email" id="email" value="@isset($vendor){{ old('email', $vendor->email) }}@else{{ old('email')}}@endisset">
        
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input type="text" name="mobile" id="mobile" value="@isset($vendor){{ old('mobile', $vendor->mobile) }}@else{{ old('mobile')}}@endisset">
        
        @error('mobile')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="agreement_no">Agreement Number</label>
        <input type="text" name="agreement_no" id="agreement_no" value="@isset($vendor){{ old('agreement_no', $vendor->agreement_no) }}@else{{ old('agreement_no')}}@endisset">
        
        @error('agreement_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7 form-group">
    @isset($vendor)
        <div class="mb-2" style="height: 100px;">
            @if($vendor->photo)
                <img height="100" src="{{ asset(Illuminate\Support\Facades\Storage::url('vendors/'.$vendor->id.'/'.$vendor->photo)) }}" alt="{{ $vendor->name }}">
            @else
                <img height="100" src="{{ asset('images/no-pic.png') }}" alt="{{ $vendor->name }}">
            @endif
        </div>
    @endisset

    <label for="photo">Vendor Photo <span class="indicator">(optional)</span></label>
    <input type="file" name="photo" id="photo">

    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="remarks">Remarks <span class="indicator">(optional)</span></label>
        <textarea name="remarks" id="remarks" rows="5">@isset($vendor){{ old('remarks', $vendor->remarks) }}@else{{ old('remarks')}}@endisset</textarea>
        
        @error('remarks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($vendor)
            <i data-feather="edit"></i> Update Vendor
        @else
            <i data-feather="save"></i> Save Vendor
        @endisset
    </button>
</div>