@csrf


@isset($user)

    @method('PUT')    

@endisset



<div class="col-md-7">

    <div class="form-group">

        <label for="name">Name</label>

        <input type="text" name="name" id="name" value="@isset($user){{ old('name', $user->name) }}@else{{ old('name')}}@endisset">

        

        @error('name')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="fathername">Father's Name <span class="indicator">(optional)</span></label>

        <input type="text" name="fathername" id="fathername" value="@isset($user){{ old('fathername', $user->profile->fathername) }}@else{{ old('fathername')}}@endisset">

        @error('fathername')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="email">Email <span class="indicator">(optional)</span></label>

        <input type="email" name="email" id="email" value="@isset($user){{ old('email', $user->email) }}@else{{ old('email')}}@endisset">

        

        @error('email')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="mobile">Mobile</label>

        <input type="text" name="mobile" id="mobile" value="@isset($user){{ old('mobile', $user->mobileno) }}@else{{ old('mobile')}}@endisset">

        

        @error('mobile')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="pfno">PF Number <span class="indicator">(optional)</span></label>

        <input type="text" name="pfno" id="pfno" value="@isset($user){{ old('pfno', $user->profile->pfno) }}@else{{ old('pfno')}}@endisset">

        

        @error('pfno')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="department">Department</label>

        <input type="text" name="department" id="department" value="@isset($user){{ old('department', $user->profile->department) }}@else{{ old('department')}}@endisset">

        

        @error('department')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="designation">Designation</label>

        <input type="text" name="designation" id="designation" value="@isset($user){{ old('designation', $user->profile->designation) }}@else{{ old('designation')}}@endisset">

        

        @error('designation')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-md-7">

    <div class="form-group">

        @isset($user)

            <div class="mb-2" style="height: 100px;">

                @if($user->profile->photo)

                    <img height="100" src="{{ asset(Illuminate\Support\Facades\Storage::url('users/'.$user->id.'/'.$user->profile->photo)) }}" alt="{{ $user->name }}">

                @else

                    <img height="100" src="{{ asset('images/no-pic.png') }}" alt="{{ $user->name }}">

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

    <h2>Address Details</h2>

</div>



<div class="col-md-7">

    <div class="form-group">

        <label for="location_id">Location</label>

        <select name="location_id" id="location_id">

            <option value="">Select Location...</option>

            @foreach (auth()->user()->hasAnyRole('sse') ? $locations : $locations as $location)

                <option value="{{ $location->id }}"

                    @isset($user)

                        {{ old('location_id', $user->profile->location_id) == $location->id ? " selected" : "" }}

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

        <select name="area_id" id="area_id" @empty($user) disabled @endempty>

            <option value="">Select Location First...</option>

            @isset($user)

                @foreach ($areas as $area)

                    <option value="{{ $area->id }}"{{ old('area_id', $user->profile->area_id) == $area->id ? " selected" : "" }}>{{ $area->name }}</option>        

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

        <select name="housetype_id" id="housetype_id" @empty($user) disabled @endempty>

            <option value="">Select Area First...</option>

            @isset($user)

                @foreach ($housetypes as $housetype)

                    <option value="{{ $housetype->id }}"{{ old('housetype_id', $user->profile->housetype_id) == $housetype->id ? " selected" : "" }}>{{ $housetype->name }}</option>        

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

        <select name="block_id" id="block_id" @empty($user) disabled @endempty>

            <option value="">Select Housetype First...</option>

            @isset($user)

                @foreach ($blocks as $block)

                    <option value="{{ $block->id }}"{{ old('block_id', $user->profile->block_id) == $block->id ? " selected" : "" }}>{{ $block->name }}</option>        

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

        <select name="qtrno" id="qtrno" @empty($user) disabled @endempty>

            <option value="">Select Block First...</option>

            @isset($user)

                @foreach ($quarters as $quarter)

                    <option value="{{ $quarter->id }}"{{ old('qtrno', $user->profile->qtrno) == $quarter->qtrno ? " selected" : "" }}>{{ $quarter->qtrno }}</option>        

                @endforeach

            @endisset

        </select>

        @error('qtrno')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>



<div class="col-12">

    <button class="btn green-btn" type="submit">

        @isset($user)

            <i class="mr-1" data-feather="edit"></i> Update User

        @else

            <i class="mr-1" data-feather="save"></i> Save User

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



        $('#block_id').on('change', function(e) {

            var block_id = e.target.value;

            if (block_id) {

                $.get('/quarters-of-a-block/' + block_id, function(data) {

                    $('#qtrno').empty().removeAttr('disabled');

                    $('#qtrno').append('<option value="">Select Block...</option>');

                    $.each(data, function(index, quarter){

                        $('#qtrno').append('<option value="'+ quarter.id +'">'+ quarter.qtrno +'</option>');

                    });

                });

            } else {

                $('#qtrno').empty().attr('disabled', 'disabled');

                $('#qtrno').append('<option value="">Select Block First...</option>');

            }

        });

    </script>

@endsection