@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Brand</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Brand Update</h6>

      <form method="POST" action="{{ route('update.brand',$brand->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pd-20">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Brand Name</label>
              <input type="text" class="form-control" name="brand_name" placeholder="Brand" id="brand_name" value="{{ $brand->brand_name }}" required>
              @error('brand_name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload New Brand Logo</label>
                <input type="file" class="form-control" name="brand_logo" placeholder="Enter New Brand Logo" id="brand_logo">
                @error('brand_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <img id="showPhoto" src="{{ !empty($brand->brand_logo)? url($brand->brand_logo) : url('storage/no_image.jpg') }}" class="card-img-left" height="70px" width="80px" alt=" ">
            </div>

            <button type="submit" class="btn btn-info pd-x-20">Update Brand</button>

            </div>



</form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

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
