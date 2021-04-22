@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Brand</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Brand List
          <button class="btn btn-sm btn-dark" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add Brand</button>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Brand Name</th>
              <th class="wd-15p">Brand Logo</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($brands as $brand)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $brand->brand_name }}</td>
                    <td><img src="{{ asset($brand->brand_logo) }}" alt="Brand Image" height="70px" width="80px"></td>
                    <td>
                        <a href="{{ route('edit.brand',$brand->id) }}" class="btn btn-sm btn-primary" title="Edit Brand"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{ route('delete.brand',$brand->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Brand</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body pd-20">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                  <input type="text" class="form-control" name="brand_name" placeholder="Brand" id="brand_name" value="{{ old('brand_name') }}" required>
                  @error('brand_name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Brand Logo</label>
                    <input type="file" class="form-control" name="brand_logo" placeholder="Enter Brand Logo" id="brand_logo" required>
                    @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <img id="showPhoto" src="" class="card-img-left" height="320px" width="480px" alt=" ">
                </div>


                </div>
        <!-- modal-body -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info pd-x-20">Add Brand</button>
          <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

  <script type="text/javascript">
    $(document).ready(function(){
        $("#brand_logo").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showPhoto").attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
