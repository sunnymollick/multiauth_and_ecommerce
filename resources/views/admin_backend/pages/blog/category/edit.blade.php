@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Blog Category Update</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Category List</h6>

      <form method="POST" action="{{ route('update.blog.category',$blogcat->id) }}">
        @csrf
        <div class="modal-body pd-20">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Category Name English</label>
              <input type="text" class="form-control" name="category_name_en"  id="category_name_en" value="{{ $blogcat->category_name_en }}" required aria-describedby="emailHelp">
              @error('category_name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category Name Bangla</label>
                <input type="text" class="form-control" name="category_name_in" id="category_name_in" value="{{ $blogcat->category_name_in }}" required aria-describedby="emailHelp">
                @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>


            </div>
    <!-- modal-body -->
    <div class="modal-footer">
      <button type="submit" class="btn btn-info pd-x-20">Update Blog Category</button>
    </div>
</form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

@endsection
