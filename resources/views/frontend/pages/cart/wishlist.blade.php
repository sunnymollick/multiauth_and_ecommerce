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
						<div class="cart_title">My Wishlist</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach ($product as $row)

								<li class="cart_item clearfix">
									<div class="cart_item_image text-center"><br><img src="{{ asset($row->image_one) }}" style="height: 100px;width: 100px" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ $row->product_name }}</div>
										</div>

                                        @if ($row->product_color == NULL)

                                        @else
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text">{{ $row->product_color }}</div>
                                            </div>
                                        @endif

                                        @if ($row->product_size == NULL)

                                        @else

                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">{{ $row->product_size }}</div>
                                            </div>

                                        @endif

                                        <div class="cart_item_total cart_info_col">
											<div class="cart_item_title"></div><br><p></p>
											<a href="#" class="btn btn-sm btn-danger">Add To Cart</a>
										</div>
									</div>
								</li>

                                @endforeach

							</ul>
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
