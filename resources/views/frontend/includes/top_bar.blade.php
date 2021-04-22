@php
$setting = DB::table('settings')->first();
@endphp

<div class="container">
    <div class="row">
        <div class="col d-flex flex-row">
            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/phone.png')}}" alt=""></div>{{ $setting->phone_one }}</div>
            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">{{ $setting->email }}</a></div>
            <div class="top_bar_content ml-auto">


            @guest

            @else
                <div class="top_bar_menu">
                    <ul class="standard_dropdown top_bar_dropdown">
                        <li>
                            <a href="" data-toggle="modal" data-target="#exampleModal">My Order Tracking</a>
                        </li>
                    </ul>
                </div>
            @endguest


                <div class="top_bar_menu">
                    <ul class="standard_dropdown top_bar_dropdown">
                        @php
                            $language = Session()->get('lang');
                        @endphp
                        <li>
                            @if (Session()->get('lang') == 'bangla')
                                <a href="{{ route('language.english') }}">English<i class="fas fa-chevron-down"></i></a>
                            @else
                                <a href="{{ route('language.bangla') }}">Bangla<i class="fas fa-chevron-down"></i></a>
                            @endif


                        </li>
                    </ul>
                </div>
                <div class="top_bar_user">
                    @guest
                        <div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div>
                        <div><a href="{{ route('register') }}">Register</a></div>
                        <div><a href="{{ route('login') }}">Sign in</a></div>
                    @else
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="{{ route('user.profile') }}"><div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div>Profile<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                                    <li><a href="{{ route('user.checkout') }}">Checkout</a></li>
                                    @guest

                                    @else
                                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                                    @endguest

                                </ul>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>


