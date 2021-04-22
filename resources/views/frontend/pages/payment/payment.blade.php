@extends('frontend.layouts.default')

@section('content')
@include('frontend.includes.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-7" style="border: 1px solid grey; padding:20px; border-radius:25px;">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center"><h3 class="text-dark">Cart Products</h3></div><hr>


                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($cart as $row)

                            <li class="cart_item clearfix">
                                <div class=" d-flex flex-md-row flex-column justify-content-between">

                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title"> <b> Image </b></div>
                                        <div class=""><img src="{{ asset($row->options->image) }}" style="height: 70px;width: 70px" alt=""></div>
                                    </div>

                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title" > <b> Name </b></div>
                                        <div class="">{{ $row->name }}</div>
                                    </div>

                                    @if ($row->options->color == NULL)

                                    @else
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title"> <b> Color </b></div>
                                            <div class="">{{ $row->options->color }}</div>
                                        </div>
                                    @endif

                                    @if ($row->options->size == NULL)

                                    @else

                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title"> <b> Size </b></div>
                                            <div class="text-center">{{ $row->options->size }}</div>
                                        </div>

                                    @endif
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title"> <b> Quantity</b></div>
                                        <div class="text-center">{{ $row->qty }}</div>

                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title"> <b> Price </b></div>
                                        <div class="">{{ $row->price }} Tk</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title"> <b> Total </b></div>
                                        <div class="">{{ $row->price * $row->qty }} Tk</div>
                                    </div>
                                </div>
                            </li>

                            @endforeach

                        </ul>
                    </div>
                    @php
                        $setting = DB::table('settings')->first();
                        $charge = $setting->shipping_charge;
                        $vat = $setting->vat;
                    @endphp

                <ul class="list-group col-lg-8" style="float: right;">
                    @if (Session::has('coupon'))
                        <li class="list-group-item">Subtotal : <span style="float: right">{{ Session::get('coupon')['balance'] }} Tk</span></li>
                        <li class="list-group-item">Coupon [ {{ Session::get('coupon')['name'] }} ]:
                            <a href="{{ route('coupon.remove') }}" class="btn btn-sm btn-danger"><i class="fas fa-minus-circle"></i></a>
                            <span style="float: right">{{ Session::get('coupon')['discount'] }} Tk</span></li>
                    @else
                        <li class="list-group-item">Subtotal : <span style="float: right">{{ Cart::subtotal() }} Tk</span></li>
                    @endif
                    <li class="list-group-item">Shipping Charge : <span style="float: right">{{ $charge }} Tk</span></li>
                    <li class="list-group-item">Vat : <span style="float: right">{{ $vat }} Tk</span></li>
                    @if (Session::has('coupon'))
                        <li class="list-group-item">Total : <span style="float: right">{{ Session::get('coupon')['balance'] + $charge + $vat}} Tk</span></li>
                    @else
                        <li class="list-group-item">Total : <span style="float: right">{{ Cart::subtotal() + $charge + $vat }} Tk</span></li>
                    @endif
                </ul>

                </div>
            </div>

            <div class="col-lg-5" style="border: 1px solid grey; padding:20px; border-radius:25px;">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center"><h3 class="text-dark">Shipping Address</h3></div><hr>

                    <form action="{{ route('payment.process') }}" id="contact_form" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Your Name" id="" required>
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" id="" required>
                        @error('email')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Your Phone Number" required id="">
                        @error('phone')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Enter Your Address" required id="">
                        @error('address')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="Enter Your City" required id="">
                        @error('city')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="contact_form_title text-center">Payment By</div>
                    <div class="form-group">
                        <ul class="logo_list">
                            <li>
                                <input type="radio" name="payment" value="stripe"><img src="{{ asset('frontend/images/mastercard.png') }}" width="100px" height="60px" title="Master Card" alt="">
                            </li>
                            <li>
                                <input type="radio" name="payment" value="paypal"><img src="{{ asset('frontend/images/paypal.png') }}" width="100px" height="60px" title="Paypal" alt="">
                            </li>
                            <li>
                                <input type="radio" name="payment" value="bkash"><img src="{{ asset('frontend/images/Bkash1.png') }}" width="100px" height="60px" title="Bkash" alt="">
                            </li>
                            <li>
                                <input type="radio" name="payment" value="cash_on_delivery"><img src="{{ asset('frontend/images/cash_on_delivery.jpg') }}" title="Cash On Delivery" width="100px" height="60px" alt="">
                            </li>
                            @error('payment')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                        </ul>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Pay Now</button>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>


<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{ asset('frontend/images/send.png')}}" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="{{ route('store.newsletter') }}" method="POST" class="newsletter_form">
                            @csrf
                            <input type="email" class="newsletter_input" name="email" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button" type="submit">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection
