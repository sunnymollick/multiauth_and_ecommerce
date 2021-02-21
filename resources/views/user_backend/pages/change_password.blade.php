@extends('user_backend.layouts.user_master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Edit Profile</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update.user.password') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Current Passord</label>
                        <input type="password" id="current_password" name="oldpassword" placeholder="current password" class="form-control">
                        @error('oldpassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-grroup">
                        <label for="">New Password</label>
                        <input type="password" id="password" name="password" placeholder="New Password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="form-control">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Change Password">
                    </div>
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
