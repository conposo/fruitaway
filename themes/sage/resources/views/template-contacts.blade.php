{{--
  Template Name: Contacts Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
        @include('partials.page-header')
        @include('partials.content-page')
    @else
    <section id="primary" class="content-area">
        <div class="container" role="main">
            <div class="row">
                <div class="col py-3 py-md-5">
                    <h1>{!!get_the_title()!!}</h1>
                </div>
            </div>
            <div class="row flex-column-reverse flex-md-row pb-5">
                <!-- Contact Form -->
                @if( isset($contact_form_shortcode) && $contact_form_shortcode )
                    <div class="mb-3 mb-lg-0 col-12 col-lg-6">
                        {!! do_shortcode($contact_form_shortcode) !!}
                        <!-- <div id="contact_form" class="d-flex">
                        </div> -->
                    </div>
                @endif
                <div class="mb-3 mb-md-0 col-12 col-lg-6">
                    <div class="mb-3 contact-ctas">
                        @if($phone)
                        <a href="tel:0889600113">{{$phone->title}}</a><br>
                        @endif
                        @if($email)
                        <a href="{{$email->url}}">{{$email->title}}</a>
                        @endif
                    </div>
                    <div class="mb-3 company-info">
                        <p>{!!$company!!}</p>
                    </div>
                    <div class="mb-3 company-address">
                        <p>{!!$address->label!!}</p>
                        <p>{!!$address->text!!}</p>
                    </div>
                    <div>
                        {!! $address->map !!}
                    </div>
                </div>
            </div>
        </div><!-- #content -->
    </section><!-- #primary -->
    @endif

    @endwhile
@endsection