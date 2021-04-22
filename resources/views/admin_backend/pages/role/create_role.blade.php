@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="">Admin Section</a>
    <span class="breadcrumb-item active">Add User</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Add New User
        <a href="{{ route('admin.all.user') }}" class="btn btn-dark pull-right">All User</a>
     </h5>
     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">

    <form action="{{ route('admin.store.user') }}" method="POST">
    @csrf

    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter User Name" required>
              @error('name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
              <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter User Email" required>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group">
              <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
              <input class="form-control" type="password" name="password"  placeholder="Enter Password" required>
              @error('password')
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
                    <input type="checkbox" name="category" value="1" >
                    <span>Category</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="coupon" value="1" >
                    <span>Coupon</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="product" value="1" >
                    <span>Product</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="blog" value="1" >
                    <span>Blog</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="order" value="1" >
                    <span>Order</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="other" value="1" >
                    <span>Other</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="report" value="1" >
                    <span>Report</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="role" value="1" >
                    <span>Role</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="return" value="1" >
                    <span>Return</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="stock" value="1" >
                    <span>Stock</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="contact" value="1" >
                    <span>Contact</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="comment" value="1" >
                    <span>Comment</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="setting" value="1" >
                    <span>Setting</span>
                  </label>
            </div>

            {{-- <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="type" value="1" >
                    <span>Type</span>
                  </label>
            </div> --}}


        </div>
        <br><br>

        <div class="form-layout-footer">
          <button type="submit" class="btn btn-info mg-r-5">Submit</button>
        </div><!-- form-layout-footer -->
      </div>

    </form>



      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->


@endsection

@section('scripts')




@endsection
