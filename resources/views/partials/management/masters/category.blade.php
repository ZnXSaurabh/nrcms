@csrf

@isset($category)

    @method('PUT')    

@endisset

<div class="form-group col-md-7">

    <div class="form-group">

        <label for="sup_cat_id">Department</label>

        <select name="sup_cat_id" id="sup_cat_id">

            <option value="">Select Department...</option>

            @foreach ($supcategories as $supcategory)

                <option value="{{ $supcategory->id }}"

                    @isset($category)

                        {{ old('sup_cat_id', $supcategory->id) == $category->sup_cat_id ? " selected" : "" }}

                    @else

                        {{ old('sup_cat_id') == $supcategory->id ? " selected" : "" }}

                    @endisset

                >

                    {{ $supcategory->name }}

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

        <label for="name">Category</label>

        <input type="text" name="name" id="name" value="@isset($category){{ old('name', $category->name) }}@else{{ old('name')}}@endisset" autofocus>

        

        @error('name')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>

<div class="col-md-7">

    <div class="form-group">

        <label for="icons">Icon <span class="indicator">(optional)</span></label>

        <input type="file" name="icons" id="icons" value="@isset($category){{ old('icons', $category->icons) }}@else{{ old('icons')}}@endisset">

        @error('icons.*')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>

<div class="col-md-7">

    <div class="form-group">

        <label for="desc">Description <span class="indicator">(optional)</span></label>

        <textarea name="desc" id="desc" rows="3">@isset($category){{ old('desc', $category->description) }}@else{{ old('desc')}}@endisset</textarea>

    </div>

</div>



<div class="col-12">

    <button class="btn green-btn" type="submit">

        @isset($category)

            <i data-feather="edit"></i> Update Category

        @else

            <i data-feather="save"></i> Save Category

        @endisset

    </button>

</div>