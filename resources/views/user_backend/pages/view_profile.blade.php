@extends('user_backend.layouts.user_master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h3 class="text-center">User Profile</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <img src="{{ !empty($user->profile_photo_path)? url($user->profile_photo_path) : url('uploads/no_image.jpg') }}" class="card-img-left" height="320px" width="480px" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $user->name }}</h5>
                  <p class="card-text">{{ $user->email }}</p>
                  <a href="{{ route('edit.user.profile') }}" class="btn btn-primary">Edit Profile</a>
                </div>
              </div>
        </div>
    </div>
@endsection
