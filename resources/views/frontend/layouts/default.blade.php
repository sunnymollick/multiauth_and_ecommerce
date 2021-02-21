<!DOCTYPE html>
<html lang="en">
<head>
@include('frontend.includes.head')
</head>

<body>


<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">

            @include('frontend.includes.top_bar')

        </div>

        <!-- Header Main -->

        <div class="header_main">
            @include('frontend.includes.header')
        </div>




    <!-- Characteristics -->

    @yield('content')

    <!-- Footer -->
    @include('frontend.includes.footer')

</div>

    @include('frontend.includes.scripts')

</body>

</html>
