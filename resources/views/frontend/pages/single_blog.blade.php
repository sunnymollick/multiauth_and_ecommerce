@extends('frontend.layouts.default')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_responsive.css') }}">

	<!-- Header -->
    @include('frontend.includes.menubar')

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" style="background-image:url({{ asset($post->post_image) }})" data-speed="0.8"></div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">
                        @if (Session()->get('lang') == 'bangla')
                            {{ $post->post_title_in }}
                        @else
                            {{ $post->post_title_en }}
                        @endif
                    </div>
					<div class="single_post_text">
						<p>
                        @if (Session()->get('lang') == 'bangla')
                            {!! $post->details_in !!}
                        @else
                            {!! $post->details_en !!}
                        @endif
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

						@foreach ($all_post as $row)
                        <!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{ asset($row->post_image) }})"></div>
							<div class="blog_text">
                                @if (Session()->get('lang') == 'bangla')
                                    {{ $row->post_title_in }}
                                @else
                                    {{ $row->post_title_en }}
                                @endif
                            </div>
							<div class="blog_button"><a href="{{ route('single.blog',$row->id) }}">
                                @if (Session()->get('lang') == 'bangla')
                                    পড়া চালিয়ে যান
                                @else
                                    Continue Reading
                                @endif

                            </a></div>
						</div>
                    @endforeach

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

<script src="{{ asset('frontend/js/blog_single_custom.js') }}"></script>
@endsection
