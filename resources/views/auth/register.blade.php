<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Login</title>

    <!-- vendor css -->
    <link href="{{ asset('backend/adminbackend') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('backend/adminbackend') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">



    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('backend/adminbackend') }}/css/starlight.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Register <span class="tx-info tx-normal"></span></div>
        <div class="tx-center mg-b-60">Get Register To Our Website</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
              <div class="form-group col-md-12 mb-4">
                <input type="text" name="name" class="form-control input-lg" id="name" value="{{ old('name') }}" aria-describedby="nameHelp" required autofocus autocomplete="name" placeholder="Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="form-group col-md-12 mb-4">
                <input type="email" name="email" class="form-control input-lg" id="email" value="{{ old('email') }}" aria-describedby="emailHelp" required placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="form-group col-md-12 ">
                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password"  required autocomplete="new-password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
              <div class="form-group col-md-12 ">
                <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control input-lg" id="password_confirmation" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
              <div class="col-md-12">
                <div class="d-inline-block mr-3">
                  <label class="control control-checkbox">
                    <input type="checkbox" />
                    <div class="control-indicator"></div>
                    I Agree the terms and conditions
                  </label>

                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign Up</button>
                <p>Already have an account?
                  <a class="text-blue" href="{{ route('login') }}">Sign in</a>
                </p>
              </div>
            </div>
          </form>
    </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="{{ asset('backend/adminbackend') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/popper.js/popper.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>

        if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }


     </script>
  </body>
</html>
