@extends('frontend.layouts.default')

@section('content')
@include('frontend.includes.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">


@php
    $setting = DB::table('settings')->first();
    $charge = $setting->shipping_charge;
    $vat = $setting->vat;
    $cart = Cart::content();
@endphp



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
                    {{-- <form action="{{ route('stripe.charge') }}" method="POST" id="payment-form">
                        @csrf
                        <label for="">Credit Or Debit Card</label>
                        <div id="card-element">
                          <!-- Elements will create input elements here -->
                        </div>

                        <!-- We'll put the error messages in this element -->
                        <div id="card-errors" role="alert"></div><br>

                        <button class="btn btn-block btn-primary" id="submit">Pay</button>
                      </form> --}}
                      <form action="{{ route('stripe.charge') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">Credit Or Debit Card</label>
                            <div id="card-element">

                            </div>
                            <div id="card-errors" role="alert"></div>
                        </div><br>
                        <input type="hidden" name="shipping" value="{{ $charge }}">
                        <input type="hidden" name="vat" value="{{ $vat }}">
                        @if (Session::has('coupon'))
                            <input type="hidden" name="total" value="{{ Session::get('coupon')['balance'] + $charge + $vat }}">
                        @else
                            <input type="hidden" name="total" value="{{ Cart::subtotal() + $charge + $vat }}">
                        @endif
                        <input type="hidden" name="ship_name" value="{{ $data['name'] }}">
                        <input type="hidden" name="ship_email" value="{{ $data['email'] }}">
                        <input type="hidden" name="ship_phone" value="{{ $data['phone'] }}">
                        <input type="hidden" name="ship_address" value="{{ $data['address'] }}">
                        <input type="hidden" name="ship_city" value="{{ $data['city'] }}">
                        <input type="hidden" name="payment_type" value="{{ $data['payment'] }}">


                        <button class="btn btn-info btn-block">Pay</button>
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

<style>
.StripeElement {
    box-sizing: border-box;
    height: 40px;
    width: 100%;
    padding: 10px 12px;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}

.StripeElement--focus{
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid{
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}
</style>

<script>
    // Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe('pk_test_51Ig8FWEiuiwXWBmyB9gE7nm2ytk4Xtwc0YGwfoaVYvrJaDO3EXut2Pnw4uzufCrFv68dWNxlFOAZcvBsbiQQioi000CJXarlfb');
var elements = stripe.elements();
// Set up Stripe.js and Elements to use in checkout form
var elements = stripe.elements();
var style = {
  base: {
    color: "#32325d",
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', ({error}) => {
  let displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
    form.addEventListener('submit',function(event){
        event.preventDefault();

        stripe.createToken(card).then(function(result){
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token){
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type','hidden');
        hiddenInput.setAttribute('name','stripeToken');
        hiddenInput.setAttribute('value',token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
// var form = document.getElementById('payment-form');

// form.addEventListener('submit', function(ev) {
//   ev.preventDefault();
//   // If the client secret was rendered server-side as a data-secret attribute
//   // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
//   stripe.confirmCardPayment(clientSecret, {
//     payment_method: {
//       card: card,
//       billing_details: {
//         name: 'Jenny Rosen'
//       }
//     }
//   }).then(function(result) {
//     if (result.error) {
//       // Show error to your customer (e.g., insufficient funds)
//       console.log(result.error.message);
//     } else {
//       // The payment has been processed!
//       if (result.paymentIntent.status === 'succeeded') {
//         // Show a success message to your customer
//         // There's a risk of the customer closing the window before callback
//         // execution. Set up a webhook or plugin to listen for the
//         // payment_intent.succeeded event that handles any business critical
//         // post-payment actions.
//       }
//     }
//   });
// });


</script>


{{-- <script>
    var stripe = Stripe('pk_test_51IfeGLSJ3kVI1NlcZrX15sSP83fsFhyxvzPRoO4Gx0pmPHDACG1CHR8EpGdJtAVHSyfkZTAqOgWXstQLnSMbkbMO007000LuvX');

    var elements = stripe.elements();

    var style = {
        base: {
            color: #32325d;
            fontFamily: ' "Helvetica Neue", Helvetica, sans-serif ',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder':{
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var card = elements.create('card',{style:style});
    card.mount('#card-element');

    card.addEventListener('change',function(event){
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit',function(event){
        event.preventDefault();

        stripe.createToken(card).then(function(result){
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token){
        var form = document.getElementById('payment-form');
        var hiddenInput = document.getElementById('input');
        hiddenInput.setAttribute('type','hidden');
        hiddenInput.setAttribute('name','stripeToken');
        hiddenInput.setAttribute('value',token.id);
        form.appendChild(hiddenInput);

        form.submit();
    } --}}




{{-- </script> --}}

<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection
