@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Sub Category</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Sub Category List
          <button class="btn btn-sm btn-dark" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add Sub-Category</button>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Category Name</th>
              <th class="wd-15p">Sub-Category Name</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($subCats as $subCat)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $subCat->category_name }}</td>
                    <td>{{ $subCat->subcategory_name }}</td>
                    <td>
                        <a href="{{ route('edit.sub.category',$subCat->id) }}" class="btn btn-sm btn-primary" title="Edit Sub Category"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{ route('delete.sub.category',$subCat->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Sub-Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ route('store.sub.category') }}">
            @csrf
            <div class="modal-body pd-20">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                  <input type="text" class="form-control" name="subcategory_name" placeholder="Enter Sub-Category" id="subcategory_name" value="{{ old('subcategory_name') }}" required >
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
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                </div>
        <!-- modal-body -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info pd-x-20">Add Sub-Category</button>
          <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

@endsection
