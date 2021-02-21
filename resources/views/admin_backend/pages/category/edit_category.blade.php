@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Category List</h6>

      <form method="POST" action="{{ route('update.category',$category->id) }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" placeholder="Category" id="category_name" value="{{ $category->category_name }}" required aria-describedby="emailHelp">
            @error('category_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


            </div>
    <!-- modal-body -->
    <div class="modal-footer">
      <button type="submit" class="btn btn-info pd-x-20">Update Category</button>
    </div>
</form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

@endsection
