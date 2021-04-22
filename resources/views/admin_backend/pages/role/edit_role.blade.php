@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="">Admin Section</a>
    <span class="breadcrumb-item active">Edit User</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Edit User
        <a href="{{ route('admin.all.user') }}" class="btn btn-dark pull-right">All User</a>
     </h5>
     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">

    <form action="{{ route('admin.update.user',$admin->id) }}" method="POST">
    @csrf

    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="name" value="{{ $admin->name }}" placeholder="Enter User Name" required>
              @error('name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-6 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
              <input class="form-control" type="email" name="email" value="{{ $admin->email }}" placeholder="Enter User Email" required>
              @error('email')
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
                    <input type="checkbox" name="category" value="1"
                    @if ($admin->category == 1)
                        checked
                    @endif
                    >
                    <span>Category</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="coupon" value="1"
                    @if ($admin->coupon == 1)
                        checked
                    @endif
                    >
                    <span>Coupon</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="product" value="1"
                    @if ($admin->product == 1)
                        checked
                    @endif
                    >
                    <span>Product</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="blog" value="1"
                    @if ($admin->blog == 1)
                        checked
                    @endif
                    >
                    <span>Blog</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="order" value="1"
                    @if ($admin->order == 1)
                        checked
                    @endif
                    >
                    <span>Order</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="other" value="1"
                    @if ($admin->other == 1)
                        checked
                    @endif
                    >
                    <span>Other</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="report" value="1"
                    @if ($admin->report == 1)
                        checked
                    @endif
                    >
                    <span>Report</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="role" value="1"
                    @if ($admin->role == 1)
                        checked
                    @endif
                    >
                    <span>Role</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="return" value="1"
                    @if ($admin->return == 1)
                        checked
                    @endif
                    >
                    <span>Return</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="stock" value="1"
                    @if ($admin->stock == 1)
                        checked
                    @endif
                    >
                    <span>Stock</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="contact" value="1"
                    @if ($admin->contact == 1)
                        checked
                    @endif
                    >
                    <span>Contact</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="comment" value="1"
                    @if ($admin->comment == 1)
                        checked
                    @endif
                    >
                    <span>Comment</span>
                  </label>
            </div>

            <div class="col-lg-4">
                <label class="ckbox">
                    <input type="checkbox" name="setting" value="1"
                    @if ($admin->setting == 1)
                        checked
                    @endif
                    >
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
          <button type="submit" class="btn btn-info mg-r-5">Update</button>
        </div><!-- form-layout-footer -->
      </div>

    </form>



      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->


@endsection

@section('scripts')




@endsection
