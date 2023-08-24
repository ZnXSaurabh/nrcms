@csrf

@isset($admin)
    @method('PUT')    
@endisset

<div class="col-md-7">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="@isset($admin){{ old('name', $admin->name) }}@else{{ old('name')}}@endisset">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="department">Department</label>
        <select name="department" id="department">
            <option value="">Select Department...</option>
            @foreach ($supercategories as $category)
                <option value="{{ $category->id }}"
                    @isset($complaint)
                        {{ old('department', $complaint->department) == $category->id ? " selected" : "" }}
                    @else
                        {{ old('department') == $category->id ? " selected" : "" }}
                    @endisset
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('department')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror
    </div>
</div>

<!-- <div class="col-md-7">
    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" name="department" id="department" value="@isset($admin){{ old('department', $admin->profile->department) }}@else{{ old('department')}}@endisset">
        
        @error('department')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div> -->

<div class="col-md-7">
    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" name="designation" id="designation" value="@isset($admin){{ old('designation', $admin->profile->designation) }}@else{{ old('designation')}}@endisset">
        
        @error('designation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="@isset($admin){{ old('email', $admin->email) }}@else{{ old('email')}}@endisset">
        
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" name="mobile" id="mobile" value="@isset($admin){{ old('mobile', $admin->mobileno) }}@else{{ old('mobile')}}@endisset">
        
        @error('mobile')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="">Select Role...</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                    @isset($admin)
                        {{ old('role', $admin->roles()->get()->pluck('id')->toArray()[0]) == $role->id ? " selected" : "" }}
                    @else
                        {{ old('role') == $role->id ? " selected" : "" }}
                    @endisset
                >
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-7">
    <div class="form-group">
        @isset($admin)
            <div class="mb-2" style="height: 100px;">
                @if($admin->profile->photo)
                    <img height="100" src="{{ asset(Illuminate\Support\Facades\Storage::url('users/'.$admin->id.'/'.$admin->profile->photo)) }}" alt="{{ $admin->name }}">
                @else
                    <img height="100" src="{{ asset('images/no-pic.png') }}" alt="{{ $admin->name }}">
                @endif
            </div>
        @endisset

        <label for="photo">Photo <span class="indicator">(optional)</span></label>
        <input type="file" name="photo" id="photo">

        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="my-5">

<div class="col-12">
    <h2>Location Area Mapping</h2>
</div>

@isset($admin)
    @if(count($admin->locations) == 0)
        <div class="row m-0 d-flex align-items-center">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="location_id">Location</label>
                    <select name="location_id[]" id="location_id">
                        <option value="">Select Location...</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>

                    @error('location_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label for="area_id">Area <span class="indicator">(optional)</span></label>
                    <select name="area_id[]" id="area_id" disabled>
                        <option value="">Select Location First...</option>
                    </select>

                    @error('area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <button type="button" id="addFields" class="action-btn edit-btn">
                    <i data-feather="plus-circle"></i>
                </button>
            </div>   
        </div>
    @endif
@else
    <div class="row m-0 d-flex align-items-center">
        <div class="col-md-5">
            <div class="form-group">
                <label for="location_id">Location</label>
                <select name="location_id[]" id="location_id">
                    <option value="">Select Location...</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>

                @error('location_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="area_id">Area <span class="indicator">(optional)</span></label>
                <select name="area_id[]" id="area_id" disabled>
                    <option value="">Select Location First...</option>
                </select>

                @error('area_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <button type="button" id="addFields" class="action-btn edit-btn">
                <i data-feather="plus-circle"></i>
            </button>
        </div>   
    </div>
@endisset

<div class="dynamic-fields mb-2">
    @isset($admin)
        @php $counter = 1; @endphp
        @foreach($admin->locations as $location_m)
            <div class="row m-0 @if($counter == 1) d-flex align-items-center @endif">
                <div class="col-md-5">
                    <div class="form-group">
                        @if($counter == 1)
                            <label for="">Location</label>
                        @endif
                        <select name="location_id[]">
                            <option value="">Select Location...</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"{{ old('location_id', $location_m->id) == $location->id ? " selected" : "" }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        @if($counter == 1)
                            <label for="">Area</label>
                        @endif
                        <select name="area_id[]">
                            <option value="">Select Area</option>
                            @foreach(\App\Models\Location::find($location_m->id)->areas as $area_l)
                                <option value="{{ $area_l->id }}"{{ old('area_id', $location_m->pivot->area_id) == $area_l->id ? " selected" : "" }}>{{ $area_l->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($counter == 1)
                    <div class="col-md-2">
                        <button type="button" id="addFields" class="action-btn edit-btn">
                            <i data-feather="plus-circle"></i>
                        </button>
                    </div>
                @else
                    <div class="col-md-2">
                        <button type="button" class="action-btn delete-btn remove-this">
                            <i data-feather="x-circle"></i>
                        </button>
                    </div>
                @endif
            </div>
            @php $counter++; @endphp
        @endforeach
    @endisset
</div>

<div class="col-12">
    <button class="btn green-btn" type="submit">
        @isset($admin)
            <i data-feather="edit"></i> Update Admin
        @else
            <i data-feather="save"></i> Save Admin
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

    <script>
        $("#addFields").click( function(e) {
            e.preventDefault();
            
            $(".dynamic-fields").append('<div class="row m-0">\
                    <div class="col-md-5">\
                        <div class="form-group">\
                            <select name="location_id[]">\
                                <option value="">Select Location...</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-5">\
                        <div class="form-group">\
                            <select name="area_id[]" disabled>\
                                <option value="">Select Location First...</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-2"><button type="button" class="action-btn delete-btn remove-this"><i data-feather="x-circle"></i></button></div>\
                </div>'
            );
            
            var currentSelect = $('.dynamic-fields').children('div:last-child').find('select');

            $.get('/get-all-locations/', function(data) {
                $.each(data, function(index, location){
                    $(currentSelect).append('<option value="'+ location.id +'">'+ location.name +'</option>');
                });
            });

            feather.replace();
            
            return false;
        });

        $(document).on('click', 'select', function() {
            var areaSelect = $(this).parent().parent().next().find('select');

            $($(this)).on('change', function(e) {
                var location_id = e.target.value;
                
                if (location_id) {
                    $.get('/areas-of-a-location/' + location_id, function(data) {
                        $(areaSelect).empty().removeAttr('disabled');
                        $(areaSelect).append('<option value="">Select Area...</option>');
                        $.each(data, function(index, area){
                            $(areaSelect).append('<option value="'+ area.id +'">'+ area.name +'</option>');
                        });
                    });
                } else {
                    $(areaSelect).empty().attr('disabled', 'disabled');
                    $(areaSelect).append('<option value="">Select Location First...</option>');
                }
            });
        });

        $(document).on('click', '.remove-this', function() {
            $(this).parent().parent().remove();
            return false;
        });
    </script>

@endsection