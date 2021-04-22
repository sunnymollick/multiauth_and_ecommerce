@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Website Setting</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Website Setting</h6>

      <form method="POST" action="{{ route('update.site.setting',$setting->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pd-20 row">

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Company Name</label>
              <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" id="company_name" value="{{ $setting->company_name }}" >
              @error('company_name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="{{ $setting->email }}" >
              @error('email')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Phone (One)</label>
              <input type="text" class="form-control" name="phone_one" placeholder="Enter Phone Number" id="phone_one" value="{{ $setting->phone_one }}" >
              @error('phone_one')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Phone (Two)</label>
              <input type="text" class="form-control" name="phone_two" placeholder="Enter Phone Number" id="phone_two" value="{{ $setting->phone_two }}" >
              @error('phone_two')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Company Address</label>
              <input type="text" class="form-control" name="company_address" placeholder="Enter Company Address" id="company_address" value="{{ $setting->company_address }}">
              @error('company_address')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Vat</label>
              <input type="text" class="form-control" name="vat" placeholder="Enter Amount Of Vat" id="vat" value="{{ $setting->vat }}">
              @error('vat')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Shipping Charge</label>
              <input type="text" class="form-control" name="shipping_charge" placeholder="Enter Shipping Charge" id="shipping_charge" value="{{ $setting->shipping_charge }}">
              @error('shipping_charge')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Facebook</label>
              <input type="text" class="form-control" name="facebook" placeholder="Enter Faceboook Link" id="facebook" value="{{ $setting->facebook }}" >
              @error('facebook')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Youtube</label>
              <input type="text" class="form-control" name="youtube" placeholder="Enter Youtube Link" id="youtube" value="{{ $setting->youtube }}" >
              @error('youtube')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Instagram</label>
              <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram Link" id="instagram" value="{{ $setting->instagram }}" >
              @error('instagram')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
              <label for="exampleInputEmail1" class="form-label">Twitter</label>
              <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter Link" id="twitter" value="{{ $setting->twitter }}" required>
              @error('twitter')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-4">
                <label for="exampleInputEmail1" class="form-label">Upload New Logo</label>
                <input type="file" class="form-control" name="logo" placeholder="Enter New  Logo" id="logo">
                @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-lg-6">
                <img id="showPhoto" src="{{ !empty($setting->logo)? url($setting->logo) : url('storage/no_image.jpg') }}" class="card-img-left" height="70px" width="80px" alt=" ">
            </div>
            <div class="col-lg-8">
            <label></label><br>
            <button type="submit" class="btn btn-info pd-x-20">Update Setting</button>
            </div>

            </div>



</form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

  <script type="text/javascript">
    $(document).ready(function(){
        $("#logo").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showPhoto").attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
