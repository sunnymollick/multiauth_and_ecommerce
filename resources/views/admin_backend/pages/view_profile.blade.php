@extends('admin_backend.layouts.admin_master')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-header">
                <h3 class="text-center">Admin Profile</h3>
            </div>
            <div class="card">
                <img src="{{ !empty($admin->profile_photo_path)? url($admin->profile_photo_path) : url('uploads/no_image.jpg') }}" class="card-img-left" height="320px" width="480px" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $admin->name }}</h5>
                  <p class="card-text">{{ $admin->email }}</p>
                  <a href="{{ route('edit.admin.profile') }}" class="btn btn-primary">Edit Profile</a>
                </div>
              </div>
        </div>
    </div>
@endsection
