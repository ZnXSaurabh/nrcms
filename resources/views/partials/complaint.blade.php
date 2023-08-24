 @csrf


@isset($complaint)

    @method('PUT')    

@endisset


<div class="row">

    @if (auth()->user()->hasAnyRoles(['sse', 'helpdesk']))

        <div class="col-md-7">

            <div class="form-group">

                <label for="user_id">Select User</label>

                <select name="user_id" id="user_id">

                    <option value="">Select User...</option>

                    @foreach ($users as $user)

                        <option value="{{ $user->id }}"

                            @isset($complaint)

                                {{ old('user_id', $complaint->user_id) == $user->id ? " selected" : "" }}

                            @else

                                {{ old('user_id') == $user->id ? " selected" : "" }}

                            @endisset

                        >

                            {{ $user->name . ' | ' . $user->mobileno }}

                        </option>

                    @endforeach

                </select>

                @error('user_id')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

        </div>

    @endif



    @if (auth()->user()->hasAnyRole('user'))

        <input type="hidden" name="user_id" value={{ auth()->user()->id }}>

    @endif


    <input type="hidden"  value="Quarter" name="comp_type" />
    <!-- <div class="col-md-7">

        <div class="form-group">

            <label for="comp_type">Complaint Type</label>

            <select name="comp_type" id="comp_type">

                <option value="">Select Complaint Type...</option>

                <option value="Quarter"@isset($complaint){{ old('comp_type', $complaint->comp_type) == 'Quarter' ? " selected" : "" }}@else{{ old('comp_type') == 'Quarter' ? " selected" : "" }}@endisset>Quarter</option>

                <option value="Service Building"@isset($complaint){{ old('comp_type', $complaint->comp_type) == 'Service Building' ? " selected" : "" }}@else{{ old('comp_type') == 'Service Building' ? " selected" : "" }}@endisset>Service Building</option>

            </select>

            

            @error('comp_type')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div> -->



    <div class="col-md-7 @if(!auth()->user()->hasAnyRoles(['sse', 'helpdesk'])) d-none @endif" id="locationField">

        <div class="form-group">

            <label for="location_id">Location</label>

            <select name="location_id" id="location_id">

                <option value="">Select Location...</option>

                @foreach (auth()->user()->hasAnyRole('sse') ? $locations->locations : $locations as $location)

                    <option value="{{ $location->id }}"

                        @isset($complaint)

                            {{ old('location_id', $complaint->location_id) == $location->id ? " selected" : "" }}

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



    <div class="col-md-7 @if(!auth()->user()->hasAnyRoles(['sse', 'helpdesk'])) d-none @endif" id="areaField">

        <div class="form-group">

            <label for="area_id">Area</label>

            <select name="area_id" id="area_id" @empty($complaint) disabled @endempty>

                <option value="">Select Location First...</option>

                @isset($complaint)

                    @foreach ($areas as $area)

                        <option value="{{ $area->id }}"{{ old('area_id', $complaint->area_id) == $area->id ? " selected" : "" }}>{{ $area->name }}</option>

                    @endforeach

                @endisset

            </select>



            @error('area_id')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div>



    <div class="col-md-7 d-none" id="buildingField">

        <div class="form-group">

            <label for="service_building_id">Service Building</label>

            <select name="service_building_id" id="service_building_id" @empty($complaint) disabled @endempty>

                <option value="">Select Area First...</option>

                @isset($complaint)

                    @foreach ($sbs as $sb)

                        <option value="{{ $sb->id }}"{{ old('service_building_id', $complaint->service_building_id) == $sb->id ? " selected" : "" }}>{{ $sb->name }}</option>

                    @endforeach

                @endisset

            </select>



            @error('service_building_id')

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

                        @isset($complaint)

                            {{ old('sup_cat_id', $complaint->sup_cat_id) == $category->id ? " selected" : "" }}

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

            <label for="category_id">Category</label>

            <select name="category_id" id="category_id" @empty($complaint) disabled @endempty>

                <option value="">Select Super Category first...</option>
                @isset($complaint)
                    @foreach ($categories as $category)

                        <option value="{{ $category->id }}"
                            @isset($complaint)
                                {{ old('category_id', $complaint->category_id) == $category->id ? " selected" : "" }}
                            @else
                                {{ old('category_id') == $category->id ? " selected" : "" }}
                            @endisset
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach
                @endisset
            </select>



            @error('category_id')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div>

    <div class="col-md-7">

        <div class="form-group">

            <label for="sub_category_id">Sub Category</label>

            <select name="sub_category_id" id="sub_category_id" @empty($complaint) disabled @endempty>

                <option value="">Select Category First...</option>

                @isset($complaint)

                    @foreach ($subcategories as $subcategory)

                        <option value="{{ $subcategory->id }}"{{ old('sub_category_id', $complaint->sub_category_id) == $subcategory->id ? " selected" : "" }}>{{ $subcategory->name }}</option>

                    @endforeach

                @endisset

            </select>



            @error('sub_category_id')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div>



    <div class="col-md-7">

        <div class="form-group">

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

            <input type="file" name="images[]" id="images" max="5" accept="image/*" capture="camera" multiple>



            @error('images.*')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

    </div>

            

    <div class="col-12">

        <button class="btn green-btn" type="submit">

            @isset($complaint)

                <i class="mr-1" data-feather="edit"></i> Update Complaint

            @else

                <i class="mr-1" data-feather="save"></i> Save Complaint

            @endisset

        </button>

    </div>

</div>



@section('script')

    <script>

        if($('#comp_type option:selected').val() == "Service Building") {

            @if(!auth()->user()->hasAnyRoles(['sse', 'helpdesk']))

                $('#locationField').removeClass('d-none');

                $('#location_id').removeAttr('disabled', 'disabled');

                $('#areaField').removeClass('d-none');

            @endif

            $('#buildingField').removeClass('d-none');

        }



        $('#comp_type').on('change', function(e) {

            if (e.target.value == 'Service Building') {

                $('#locationField').removeClass('d-none');

                $('#location_id').removeAttr('disabled', 'disabled');

                $('#areaField').removeClass('d-none');

                $('#buildingField').removeClass('d-none');

                $('#service_building_id').empty().removeAttr('disabled', 'disabled');

                $('#area_id').empty().attr('disabled', 'disabled');

                $('#area_id').append('<option value="">Select Location First...</option>');

                $('#service_building_id').empty().attr('disabled', 'disabled');

                $('#service_building_id').append('<option value="">Select Area First...</option>');

            } else if (e.target.value == 'Quarter') {

                @if(!auth()->user()->hasAnyRoles(['sse', 'helpdesk']))

                    $('#locationField').addClass('d-none');

                    $('#location_id').attr('disabled', 'disabled');

                    $('#areaField').addClass('d-none');

                    $('#area_id').empty().attr('disabled', 'disabled');

                @endif

                $('#buildingField').addClass('d-none');

                $('#service_building_id').empty().attr('disabled', 'disabled');

            }

        });



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

                $('#service_building_id').empty().attr('disabled', 'disabled');

                $('#service_building_id').append('<option value="">Select Area First...</option>');

            }

        });



        $('#area_id').on('change', function(e) {

            var area_id = e.target.value;

            if (area_id) {

                $.get('/buildings-of-an-area/' + area_id, function(data) {

                    $('#service_building_id').empty().removeAttr('disabled');

                    $('#service_building_id').append('<option value="">Select Service Building...</option>');

                    $.each(data, function(index, building){

                        $('#service_building_id').append('<option value="'+ building.id +'">'+ building.name +'</option>');

                    });

                });

            } else {

                $('#service_building_id').empty().attr('disabled', 'disabled');

                $('#service_building_id').append('<option value="">Select Area First...</option>');

            }

        });



        $('#sup_cat_id').on('change', function(e) {

            var sup_cat_id = e.target.value;

            if (sup_cat_id) {

                $.get('/categories-of-a-super-category/' + sup_cat_id, function(data) {

                    $('#category_id').empty().removeAttr('disabled');

                    $('#category_id').append('<option value="">Select Sub Category...</option>');

                    $.each(data, function(index, building){

                        $('#category_id').append('<option value="'+ building.id +'">'+ building.name +'</option>');

                    });

                });

            } else {

                $('#category_id').empty().attr('disabled', 'disabled');

                $('#category_id').append('<option value="">Select Category First...</option>');

            }

        });

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