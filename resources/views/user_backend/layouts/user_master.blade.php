<!DOCTYPE html>
<html lang="en">
    <head>
       @include('user_backend.includes.head')
    </head>
    <body id="page-top">
        <!-- preloader -->
        <div class="preloader">
            <img src="{{ asset('backend/userbackend') }}/panel/assets/images/preloader.gif" alt="">
        </div>
        <!-- wrapper -->
    <div class="wrapper">

            <!-- header area -->
            <header class="header_area">
               @include('user_backend.includes.header')
            </header><!-- / header area -->
            <!-- sidebar area -->
            <aside class="sidebar-wrapper ">
               @include('user_backend.includes.sidebar')
            </aside><!-- /sidebar Area-->

<div class="content_wrapper">
    <!--middle content wrapper-->
    <div class="middle_content_wrapper">
        @yield('content')
    </div><!--/middle content wrapper-->
</div><!--/ content wrapper -->

        </div><!--/ wrapper -->

        @include('user_backend.includes.scripts')

    </body>
</html>
