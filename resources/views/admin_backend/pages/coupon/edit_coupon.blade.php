@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Coupon List</h6>

      <form method="POST" action="{{ route('update.coupon',$coupon->id) }}">
        @csrf
        <div class="modal-body pd-20">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
              <input type="text" class="form-control" name="coupon" placeholder="Coupon Code" id="coupon" value="{{ $coupon->coupon }}" required>
              @error('coupon')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Coupon Discount (%)</label>
                <input type="text" class="form-control" name="discount" placeholder="Coupon discount" id="discount" value="{{ $coupon->discount }}" required>
                @error('discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-info pd-x-20">Update Coupon</button>
            </div>

    </form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

@endsection
