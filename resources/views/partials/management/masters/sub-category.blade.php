@csrf



@isset($sub_category)

    @method('PUT')    

@endisset



<div class="form-group col-md-7">

    <div class="form-group">

        <label for="category_id">Category</label>

        <select name="category_id" id="category_id">

            <option value="">Select Category...</option>

            @foreach ($categories as $category)

                <option value="{{ $category->id }}"

                    @isset($sub_category)

                        {{ old('category_id', $category->id) == $sub_category->category->id ? " selected" : "" }}

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



<div class="form-group col-md-7">

    <div class="form-group">

        <label for="name">Sub Category</label>

        <input type="text" name="name" id="name" value="@isset($sub_category){{ old('name', $sub_category->name) }}@else{{ old('name')}}@endisset">

        

        @error('name')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>

<div class="col-md-7">

    <div class="form-group">

        <label for="icons">Icon <span class="indicator">(optional)</span></label>

        <input type="file" name="icons" id="icons">

        @error('icons.*')

            <div class="invalid-feedback">{{ $message }}</div>

        @enderror

    </div>

</div>

<div class="form-group col-md-7">

    <div class="form-group">

        <label for="desc">Description <span class="indicator">(optional)</span></label>

        <textarea name="desc" id="desc" rows="3">@isset($sub_category){{ old('desc', $sub_category->description) }}@else{{ old('desc')}}@endisset</textarea>

    </div>

</div>    



<div class="col-12">

    <button class="btn green-btn" type="submit">

        @isset($sub_category)

            <i data-feather="edit"></i> Update Sub Category

        @else

            <i data-feather="save"></i> Save Sub Category

        @endisset

    </button>

</div>