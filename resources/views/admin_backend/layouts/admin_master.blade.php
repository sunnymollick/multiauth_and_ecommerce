<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin_backend.includes.head')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('admin_backend.includes.sidebar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('admin_backend.includes.header')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        @yield('content')

      @include('admin_backend.includes.footer')
    </div>
    <!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    @include('admin_backend.includes.scripts')

    @yield('scripts')

  </body>
</html>
