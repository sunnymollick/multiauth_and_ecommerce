@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Blog Category</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Blog Category List
          <button class="btn btn-sm btn-dark" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add New Category</button>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Category Name En</th>
              <th class="wd-15p">Category Name Hin</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($blogcats as $blogcat)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $blogcat->category_name_en }}</td>
                    <td>{{ $blogcat->category_name_in }}</td>
                    <td>
                        <a href="{{ route('edit.blog.category',$blogcat->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <a href="{{ route('delete.blog.category',$blogcat->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->









   <!-- LARGE MODAL -->
   <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Blog Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ route('store.blog.category') }}">
            @csrf
            <div class="modal-body pd-20">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Category Name English</label>
                  <input type="text" class="form-control" name="category_name_en" placeholder="Category Name English" id="category_name_en" value="{{ old('category_name_en') }}" required aria-describedby="emailHelp">
                  @error('category_name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Name Bangla</label>
                    <input type="text" class="form-control" name="category_name_in" placeholder="Category Name Hindi" id="category_name_in" value="{{ old('category_name_in') }}" required aria-describedby="emailHelp">
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>


                </div>
        <!-- modal-body -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info pd-x-20">Add Blog Category</button>
          <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

@endsection

@section('scripts')



@endsection
