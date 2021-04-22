@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="">Product</a>
    <span class="breadcrumb-item active">Add Product</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Add New Product
        <a href="{{ route('admin.all.product') }}" class="btn btn-dark pull-right">All Product</a>
     </h5>
     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">New Product Form</h6>

    <form action="{{ route('admin.store.product') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Enter Product Name" required>
              @error('product_name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Code" required>
              @error('product_code')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_quantity" value="{{ old('product_quantity') }}" placeholder="Enter Quantity" required>
              @error('product_quantity')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="discount_price" value="{{ old('discount_price') }}" placeholder="Enter Discount price">
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
              <select class="form-control select2" id="category" data-placeholder="Choose Category" name="category_id" required>
                <option label="Choose Category"></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
              <select class="form-control select2" id="subcategory" data-placeholder="Choose Sub Category" name="subcategory_id" required>
                <option label="Choose Sub Category"></option>
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
              <select class="form-control select2" data-placeholder="Choose Brand" name="brand_id" required>
                <option label="Choose Brand"></option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" required >
            @error('product_size')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput" required>
            @error('product_color')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="selling_price" value="{{ old('selling_price') }}" placeholder="Enter Selling Price" required>
            @error('selling_price')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="product_details" id="editor" cols="30" rows="10" required>

              </textarea>
              @error('product_details')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
              <input class="form-control" name="video_link" placeholder="Enter Video Link" >
            @error('video_link')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image One (Main Thumbnail): <span class="tx-danger">*</span></label>
              <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" onchange="readURL(this);" name="image_one" required>
                <span class="custom-file-control"></span>
                <img src="#" id="one" alt="">
              </label>
            @error('image_one')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image Two : <span class="tx-danger">*</span></label>
              <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" onchange="readURL2(this);" name="image_two" required>
                <span class="custom-file-control"></span>
                <img src="#" id="two" alt="">
              </label>
            @error('image_two')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
              <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" onchange="readURL3(this);" name="image_three" required>
                <span class="custom-file-control"></span>
                <img src="#" id="three" alt="">
              </label>
            @error('image_three')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div><!-- col-4 -->

        </div><!-- row -->

        <hr>
        <br><br>

        <div class="row">

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="main_slider" value="1" >
                    <span>Main Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="hot_deal" value="1" >
                    <span>Hot Deal</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="best_rated" value="1" >
                    <span>Best Rated</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="trend" value="1" >
                    <span>Trend Product</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="mid_slider" value="1" >
                    <span>Mid Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="hot_new" value="1" >
                    <span>Hot New</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="buyone_getone" value="1" >
                    <span>BuyOne GetOne</span>
                  </label>
            </div>


        </div>
        <br><br>

        <div class="form-layout-footer">
          <button class="btn btn-info mg-r-5">Submit Form</button>
          <button class="btn btn-secondary">Cancel</button>
        </div><!-- form-layout-footer -->
      </div>

    </form>



      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
   $('select[name="category_id"]').on('change',function(){
        var category_id = $(this).val();
        if (category_id) {

          $.ajax({
            url: "{{ url('/get/subcategory/') }}/"+category_id,
            type:"GET",
            dataType:"json",
            success:function(data) {
            var d =$('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){

            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

            });
            },
          });

        }else{
          alert('danger');
        }

          });
    });

</script>

<script type="text/javascript">
function readURL(input){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#one')
      .attr('src', e.target.result)
      .width(80)
      .height(80);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<script type="text/javascript">
    function readURL2(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>

<script type="text/javascript">
    function readURL3(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#three')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>

@endsection

@section('scripts')




@endsection
