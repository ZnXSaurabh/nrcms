@csrf

@isset($resource)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="vendor_id">Vendor</label>
        <select name="vendor_id" id="vendor_id">
            <option value="">Select Vendor...</option>
            @foreach ($vendors as $vendor)
                <option value="{{ $vendor->id }}"
                    @isset($resource)
                        {{ old('vendor_id', $resource->vendor_id) == $vendor->id ? " selected" : "" }}
                    @else
                        {{ old('vendor_id') == $vendor->id ? " selected" : "" }}
                    @endisset
                >
                    {{ $vendor->name }} --> {{ $vendor->location->name }}
                </option>
            @endforeach
        </select>
        
        @error('vendor_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="@isset($resource){{ old('name', $resource->name) }}@else{{ old('name')}}@endisset">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="email">Email <span class="indicator">(optional)</span></label>
        <input type="text" name="email" id="email" value="@isset($resource){{ old('email', $resource->email) }}@else{{ old('email')}}@endisset">
        
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input type="text" name="mobile" id="mobile" value="@isset($resource){{ old('mobile', $resource->mobile) }}@else{{ old('mobile')}}@endisset">
        
        @error('mobile')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3">@isset($resource){{ old('address', $resource->address) }}@else{{ old('address')}}@endisset</textarea>
        
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="pfno">PF Number <span class="indicator">(optional)</span></label>
        <input type="text" name="pfno" id="pfno" value="@isset($resource){{ old('pfno', $resource->pfno) }}@else{{ old('pfno')}}@endisset">
        
        @error('pfno')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="esi_no">ESI Number <span class="indicator">(optional)</span></label>
        <input type="text" name="esi_no" id="esi_no" value="@isset($resource){{ old('esi_no', $resource->esi_no) }}@else{{ old('esi_no')}}@endisset">
        
        @error('esi_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            <option value="">Select Category...</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @isset($resource)
                        {{ old('category_id', $resource->category_id) == $category->id ? " selected" : "" }}
                    @else
                        {{ old('category_id') == $category->id ? " selected" : "" }}
                    @endisset
                >
                    {{ $category->supercategory->name }} --> {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7 form-group">
    @isset($resource)
        <div class="mb-2" style="height: 100px;">
            @if($resource->photo)
                <img height="100" src="{{ asset(Illuminate\Support\Facades\Storage::url('resources/'.$resource->id.'/'.$resource->photo)) }}" alt="{{ $resource->name }}">
            @else
                <img height="100" src="{{ asset('images/no-pic.png') }}" alt="{{ $resource->name }}">
            @endif
        </div>
    @endisset

    <label for="photo">Resource Photo <span class="indicator">(optional)</span></label>
    <input type="file" name="photo" id="photo">

    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="remarks">Remarks <span class="indicator">(optional)</span></label>
        <textarea name="remarks" id="remarks" rows="5">@isset($resource){{ old('remarks', $resource->remarks) }}@else{{ old('remarks')}}@endisset</textarea>
        
        @error('remarks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($resource)
            <i data-feather="edit"></i> Update Resource
        @else
            <i data-feather="save"></i> Save Resource
        @endisset
    </button>
</div>

@section('script')
    <script>
        $('#category_id').on('change', function(e) {
            var category_id = e.target.value;
            if (category_id) {
                $.get('/subcategories-of-a-category/' + category_id, function(data) {
                    $('#sub_category_id').empty().removeAttr('disabled');
                    $('#sub_category_id').append('<option value="">Select Sub Category...</option>');
                    $.each(data, function(index, building){
                        $('#sub_category_id').append('<option value="'+ building.id +'">'+ building.name +'</option>');
                    });
                });
            } else {
                $('#sub_category_id').empty().attr('disabled', 'disabled');
                $('#sub_category_id').append('<option value="">Select Category First...</option>');
            }
        });
    </script>
@endsection