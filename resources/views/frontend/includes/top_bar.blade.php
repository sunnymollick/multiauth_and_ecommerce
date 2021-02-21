<div class="container">
    <div class="row">
        <div class="col d-flex flex-row">
            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/phone.png')}}" alt=""></div>+38 068 005 3570</div>
            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
            <div class="top_bar_content ml-auto">
                <div class="top_bar_menu">
                    <ul class="standard_dropdown top_bar_dropdown">
                        <li>
                            <a href="#">English<i class="fas fa-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">Spanish</a></li>
                                <li><a href="#">Japanese</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">EUR Euro</a></li>
                                <li><a href="#">GBP British Pound</a></li>
                                <li><a href="#">JPY Japanese Yen</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="top_bar_user">
                    <div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div>
                    <div><a href="{{ route('register') }}">Register</a></div>
                    <div><a href="{{ route('login') }}">Sign in</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
