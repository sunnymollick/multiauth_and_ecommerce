@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="">Product</a>
    <span class="breadcrumb-item active">Update Product</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Add New Product
        <a href="{{ route('admin.all.product') }}" class="btn btn-dark pull-right">All Product</a>
     </h5>
     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Update Product Form</h6>

    <form action="{{ route('update.product.without.image',$product->id) }}" method="POST">
    @csrf

    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_name" value="{{ $product->product_name }}" placeholder="Enter Product Name" required>
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_code" value="{{ $product->product_code }}" placeholder="Enter Product Code" required>
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_quantity" value="{{ $product->product_quantity }}" placeholder="Enter Quantity" required>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="discount_price" value="{{ $product->discount_price }}" placeholder="Enter Discount price">
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
              <select class="form-control select2" id="category" data-placeholder="Choose Category" name="category_id" required>
                <option label="Choose Category"></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ($category->id == $product->category_id)
                            selected
                        @endif
                    >{{ $category->category_name }}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
              <select class="form-control select2" id="subcategory" data-placeholder="Choose Sub Category" name="subcategory_id" required>
                <option label="Choose Sub Category"></option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        @if ($subcategory->id == $product->subcategory_id)
                            selected
                        @endif
                    >{{ $subcategory->subcategory_name }}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
              <select class="form-control select2" data-placeholder="Choose Brand" name="brand_id" required>
                <option label="Choose Brand"></option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        @if ($brand->id == $product->brand_id)
                            selected
                        @endif
                    >{{ $brand->brand_name }}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_size" value="{{ $product->product_size }}" id="size" data-role="tagsinput" >
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="product_color" value="{{ $product->product_color }}" id="color" data-role="tagsinput">
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="selling_price" value="{{ $product->selling_price }}" placeholder="Enter Selling Price" required>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="product_details" id="editor" cols="30" rows="10" required>
                    {!! $product->product_details !!}
              </textarea>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
              <input class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="Enter Video Link" >
            </div>
          </div><!-- col-4 -->


        </div><!-- row -->

        <hr>
        <br><br>

        <div class="row">

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="main_slider" value="1"
                    @if ($product->main_slider == 1)
                        checked
                    @endif
                    >
                    <span>Main Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="hot_deal" value="1"
                    @if ($product->hot_deal == 1)
                        checked
                    @endif
                    >
                    <span>Hot Deal</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="best_rated" value="1"
                    @if ($product->best_rated == 1)
                        checked
                    @endif
                    >
                    <span>Best Rated</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="trend" value="1"
                    @if ($product->trend == 1)
                        checked
                    @endif
                    >
                    <span>Trend Product</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="mid_slider" value="1"
                    @if ($product->mid_slider == 1)
                        checked
                    @endif
                    >
                    <span>Mid Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="hot_new" value="1"
                    @if ($product->hot_new == 1)
                        checked
                    @endif
                    >
                    <span>Hot New</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="buyone_getone" value="1"
                    @if ($product->buyone_getone == 1)
                        checked
                    @endif
                    >
                    <span>BuyOne GetOne</span>
                  </label>
            </div>


        </div>
        <br><br>

        <div class="form-layout-footer">
          <button class="btn btn-info mg-r-5">Update Product</button>
        </div><!-- form-layout-footer -->

      </div>

    </form>



      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->

  <div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Update Product Images</h6>

    <form action="{{ route('update.product.images',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

      <div class="col-lg-6 col-sm-6">
        <div class="form-group">
          <label class="form-control-label">Image One (Main Thumbnail): <span class="tx-danger">*</span></label>
          <br>
          <label class="custom-file">
            <input type="file" id="file" class="custom-file-input" onchange="readURL(this);" name="image_one" >
            <span class="custom-file-control"></span>
            <br>
            <img src="#" id="one" alt="">
          </label>
        </div>
      </div>
      <div class="col-lg-6 col-sm-6">
        <img src="{{ asset($product->image_one) }}" alt="Main Image" height="80px" width="120px">
      </div>

      <div class="col-lg-6 col-sm-6">
        <div class="form-group">
          <label class="form-control-label">Image Two : <span class="tx-danger">*</span></label>
          <br>
          <label class="custom-file">
            <input type="file" id="file" class="custom-file-input" onchange="readURL2(this);" name="image_two" >
            <span class="custom-file-control"></span>
            <br>
            <img src="#" id="two" alt="">
          </label>
        </div>
      </div>
      <div class="col-lg-6 col-sm-6">
        <img src="{{ asset($product->image_two) }}" alt="Second Image" height="80px" width="120px">
      </div>

      <div class="col-lg-6 col-sm-6">
        <div class="form-group">
          <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
          <br>
          <label class="custom-file">
            <input type="file" id="file" class="custom-file-input" onchange="readURL3(this);" name="image_three" >
            <span class="custom-file-control"></span>
            <br>
            <img src="#" id="three" alt="">
          </label>
        </div>
      </div>
      <div class="col-lg-6 col-sm-6">
        <img src="{{ asset($product->image_three) }}" alt="Third Image" height="80px" width="120px">
      </div>

      <br><br>

      <div class="col-lg-6 col-sm-6">
      <div class="form-layout-footer">
        <button class="btn btn-info mg-r-5" type="submit">Update Images</button>
      </div><!-- form-layout-footer -->
      </div>

    </div>

    </form>

  </div>
  </div>

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
