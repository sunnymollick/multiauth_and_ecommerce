@extends('user_backend.layouts.user_master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Edit Profile</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $user->email }}">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" id="photo" name="profile_photo_path" >
                      </div>
                      <div class="mb-3">
                          <img id="showPhoto" src="{{ !empty($user->profile_photo_path)? url($user->profile_photo_path) : url('storage/no_image.jpg') }}" class="card-img-left" height="320px" width="480px" alt="...">
                      </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#photo").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showPhoto").attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
