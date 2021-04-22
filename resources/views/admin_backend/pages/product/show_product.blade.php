@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <h6 class="card-body-title">View Product</h6>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">

     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">


    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->product_name }}</strong>
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->product_code }}</strong>
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->product_quantity }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->category_name }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->subcategory_name }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->brand_name }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->product_size }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->product_color }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->selling_price }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="product_details" id="editor" readonly cols="30" rows="10" required>
                    {!! $product->product_details !!}
              </textarea>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
              <br>
              <strong>{{ $product->video_link }}</strong>
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image One (Main Thumbnail): <span class="tx-danger">*</span></label>
              <br>
              <img src="{{ asset($product->image_one) }}" height="70px" width="80px" alt="">
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image Two : <span class="tx-danger">*</span></label>
              <br>
              <img src="{{ asset($product->image_two) }}" height="70px" width="80px" alt="">
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
              <<br>
              <img src="{{ asset($product->image_three) }}" height="70px" width="80px" alt="">
            </div>
          </div><!-- col-4 -->

        </div><!-- row -->

        <hr>
        <br><br>

        <div class="row">

            <div class="col-lg-4">
                <label>
                    @if ($product->main_slider == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <span>Main Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="">
                    @if ($product->hot_deal == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
                    <span>Hot Deal</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="">
                    @if ($product->best_rated == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
                    <span>Best Rated</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="">
                    @if ($product->trend == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
                    <span>Trend Product</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="">
                     @if ($product->mid_slider == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
                    <span>Mid Slider</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="">
                    @if ($product->hot_new == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
                    <span>Hot New</span>
                  </label>
            </div>


        </div>

      </div>





      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->



@endsection

@section('scripts')




@endsection
