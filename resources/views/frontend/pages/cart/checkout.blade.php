@extends('frontend.layouts.default')

@section('content')
@include('frontend.includes.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Checkout</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach ($cart as $row)

								<li class="cart_item clearfix">
									<div class="cart_item_image text-center"><br><img src="{{ asset($row->options->image) }}" style="height: 100px;width: 100px" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ $row->name }}</div>
										</div>

                                        @if ($row->options->color == NULL)

                                        @else
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text"><span style="background-color:{{ $row->options->color }};"></span>{{ $row->options->color }}</div>
                                            </div>
                                        @endif

                                        @if ($row->options->size == NULL)

                                        @else

                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">{{ $row->options->size }}</div>
                                            </div>

                                        @endif
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div><br><p></p>
                                            <form action="{{ route('update.cartitem',$row->rowId) }}" method="POST">
                                                @csrf
                                                <input type="number" name="qty" value="{{ $row->qty }}" style="width: 50px;" min="1">
                                                <button class="btn btn-sm btn-success"><i class="fas fa-check-square"></i></button>
                                            </form>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{ $row->price }} Tk</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">{{ $row->price * $row->qty }} Tk</div>
										</div>
                                        <div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div><br><p></p>
											<a href="{{ route('cart.remove',$row->rowId) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
										</div>
									</div>
								</li>

                                @endforeach

							</ul>
						</div>

						<!-- Order Total -->
						<div class="order_total_content" style="padding: 15px;">
                            @if (Session::has('coupon'))

                            @else

                            <h4 style="margin-left: 20px;">Apply Coupon</h4>
							<form action="{{ route('apply.coupon') }}" method="POST">
                                @csrf
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" name="coupon" required placeholder="Enter Your Coupon">
                                </div>
                                <button type="submit" class="btn btn-danger ml-2">Submit</button>
                            </form>

                            @endif

						</div>

                        @php
                            $setting = DB::table('settings')->first();
                            $charge = $setting->shipping_charge;
                            $vat = $setting->vat;
                        @endphp

                        <ul class="list-group col-lg-4" style="float: right;">
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
            </div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">All Cancel</button>
                            <a href="{{ route('payment.step') }}" class="button cart_button_checkout">Process To Pay</a>
						</div>
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
