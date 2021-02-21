@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Sub Category</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Sub Category List</h6>

      <form method="POST" action="{{ route('update.sub.category',$subCats->id) }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Sub-Category Name</label>
            <input type="text" class="form-control" name="subcategory_name" placeholder="Category" id="subcategory_name" value="{{ $subCats->subcategory_name }}" required>
            @error('subcategory_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-group">
                <label for="">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @php
                                if ($category->id == $subCats->category_id) {
                                    echo "selected";
                                }
                            @endphp
                            >{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-info pd-x-20">Update</button>
        </div>

</form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

@endsection
