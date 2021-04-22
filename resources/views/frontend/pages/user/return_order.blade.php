@extends('frontend.layouts.default')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">

	<!-- Header -->
    @include('frontend.includes.menubar')

 <div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          {{-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('edit.user.profile') }}">Edit User</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.profile') }}">User Profile</a></li>
            </ol>
          </nav> --}}
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Admin" class="rounded-circle" width="120">
                    @else
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{ Auth::user()->name }}</h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                      <a href="{{ route('edit.user.profile') }}" class="btn btn-primary">Edit Profile</a>
                      <a href="{{ route('user.logout') }}" class="btn btn-outline-primary">Logout</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  {{-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('success.orderlist') }}" class="btn btn-danger btn-block"> Return Order </a>
                  </li> --}}
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      (239) 816-9029
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      (320) 380-4539
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Bay Area, San Francisco, CA
                    </div>
                  </div>
                </div>
              </div>

             
              <div class="row gutters-sm">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap table-striped">
                              <thead class="table-info">
                                <tr>
                                  <th class="wd-15p">No.</th>
                                  <th class="wd-15p">Payment Type</th>
                                  <th class="wd-15p">Return</th>
                                  <th class="wd-15p">Amount</th>
                                  <th class="wd-15p">Date</th>
                                  <th class="wd-15p">Status</th>
                                  <th class="wd-20p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php($i=1)
                                  @foreach ($order as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->payment_type }}</td>
                                        <td>
                                            @if ($row->return_order == 0)
                                                <span class="badge badge-warning">No Request</span>
                                            @elseif ($row->return_order == 1)
                                                <span class="badge badge-info">Pending</span>
                                            @elseif ($row->return_order == 2)
                                                <span class="badge badge-success">Success</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->total }} Tk</td>
                                        <td>{{ $row->date }}</td>
                                        <td>
                                        @if ($row->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($row->status == 1)
                                            <span class="badge badge-info">Payment Accept</span>
                                        @elseif ($row->status == 2)
                                            <span class="badge badge-warning">Progress</span>
                                        @elseif ($row->status == 3)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-danger">Cancel</span>
                                        @endif
                                        </td>
                                        <td>
                                             @if ($row->return_order == 0)
                                                <a href="{{ route('request.return',$row->id) }}" class="btn btn-sm btn-danger" id="return" >Return</a>
                                            @elseif ($row->return_order == 1)
                                                <span class="badge badge-info">Pending</span>
                                            @elseif ($row->return_order == 2)
                                                <span class="badge badge-success">Success</span>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                  @endforeach
                              </tbody>
                            </table>
                            {{ $order->links() }}
                          </div><!-- table-wrapper -->
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
