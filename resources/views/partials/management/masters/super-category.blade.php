@csrf



@isset($category)

    @method('PUT')    

@endisset



<div class="col-md-7">

    <div class="form-group">

        <label for="name">Name</label>

        <input type="text" name="name" id="name" value="@isset($category){{ old('name', $category->name) }}@else{{ old('name')}}@endisset" autofocus>

        

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



<div class="col-md-7">

    <div class="form-group">

        <label for="desc">Description <span class="indicator">(optional)</span></label>

        <textarea name="desc" id="desc" rows="3">@isset($category){{ old('desc', $category->description) }}@else{{ old('desc')}}@endisset</textarea>

    </div>

</div>



<div class="col-12">

    <button class="btn green-btn" type="submit">

        @isset($category)

            <i data-feather="edit"></i> Update Department

        @else

            <i data-feather="save"></i> Save Department

        @endisset

    </button>

</div>