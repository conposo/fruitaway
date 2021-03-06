{{--
  Template Name: Subscription Template
--}}

@extends('layouts.app-fluid')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    
    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
      @include('partials.page-header')
      @include('partials.content-page')
    @endif

    <!-- Main Section -->
    @if( isset($show_main_section) && $show_main_section )
    <div class="mb-md-0 pb-0 container product-det">
      <div class="row pt-5 pb-5">
        @if($main_section->content)
        <div class="col-12 col-md-6">
          {!! $main_section->content !!}
          <!-- <h2>АБОНАМЕНТНА ДОСТАВКА НА</h2>
          <h1>Кутия със сезонни плодове</h1>
          <p>Вкусни сезонни плодове директно до вашия дом или офис. Вкусни сезонни плодове директно до вашия дом или офис. Вкусни сезонни плодове директно до вашия дом или офис.</p>
          <div class="basket-size clearfix">
              <h3>Възможни размери на кошницата:</h3>
              <p class="pr-4">S<br><span>5 kg.</span></p>
              <p class="pr-4">M<br><span>8 kg.</span></p>
              <p class="pr-4">L<br><span>11 kg.</span></p>
          </div>
          <div class="delivery-frequency mb-3">
              <h3>Честота на доставка:</h3>
              <p>От един до няколко пъти седмично или всеки втори понеделник. Вие решавате колко често да правим доставката ви. Разбира се, винаги можете да ни се обадите и да отмените или отложите доставка при необходимост.</p>
          </div>
          <div class="basket-order w-md-50 ">
              <div class="d-inline-flex flex-column align-items-center mt-5 mb-5">
                  <a class="btn-deco btn-deco-red mb-3" href="#contact_form"><span class="position-relative">СВЪРЖИ СЕ С НАС</span></a>
                  <p class="text-center">или просто ни се обади на<br><span>0889 600 113</span></p>
              </div>
          </div> -->
        </div>
        @endif
        @if( $images = $main_section->gallery )
          <div class="col-12 col-md-6 product-special-image">
            <div id="carousel_images" class="h-100 carousel carousel-fade slide" data-ride="carousel">
                <script>
                jQuery(document).ready(function(){
                    var lis = ``;
                    jQuery('#woo-product-gallery-carousel > div:first-child').addClass('active');

                    if(jQuery('#woo-product-gallery-carousel .carousel-item').length > 1) {
                      jQuery('#woo-product-gallery-carousel .carousel-item').each(function(i){
                          if(i == 0) active = 'active'; else active = ``;
                          lis += `<li style="width:16px; height:16px;" data-target="#carousel_images" data-slide-to="${i}" class="${active} mx-2 rounded-circle"></li>`
                      })
                      jQuery('#carousel_images').prepend(`<ol class="carousel-indicators" style="bottom: 0;">`+lis+`</ol>`)
                    }

                })
                </script>
                <figure id="woo-product-gallery-carousel" class="m-0 carousel-inner h-100" style="overflow: unset;">
                    @foreach( $images as $image )
                      @php
                        ($image === reset($images)) ? $active = 'active' : $active = '';
                      @endphp
                      <div class="carousel-item {{$active}}">
                        {!! wp_get_attachment_image( $image->ID, 'full', '', ['class' => 'd-block w-100'] ) !!}
                      </div>
                    @endforeach
                </figure>
            </div>
          </div>
        @endif
      </div>
    </div>
    @endif

    <!-- How work -->
    @if( isset($show_how_work) && $show_how_work )
    <div class="pink-bg how-it-works">
      <div class="container text-center">
        <div class="row pt-5 pb-5">
        @if( isset($how_work_header) && $how_work_header )
          <div class="col-12">
            <h2>{{$how_work_header}}</h2>
          </div>
        @endif
        @if( have_rows('how_work_sections') )
          @while( have_rows('how_work_sections') ) @php the_row(); @endphp
            <div class="col-12 col-md-3">
              <span class="d-block">{{get_sub_field('title')}}</span>
              {!!get_sub_field('text')!!}
            </div>
          @endwhile
        @else
          <!-- no rows found -->
        @endif
        </div>
      </div>
    </div>
    @endif

    <!-- Fruits in the Box -->
    @if( isset($fruits_in_the_box) && $fruits_in_the_box )
      <div class="container">
        @if( $fruits_in_the_box->section_with_fruits )
          @include('partials.fruits_in_the_box.section_with_fruits', ['fruits_in_the_box' => $fruits_in_the_box])
        @endif
        @if( $fruits_in_the_box->section_with_image )
          @include('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $fruits_in_the_box])
        @endif
      </div>
    @endif

    <!-- Additional Products -->
    @if( isset($show_additional_products) && $show_additional_products )
    <div class="container text-center">
        <div class="row mb-5 py-5">
        @if( isset($additional_products_header) && $additional_products_header )
          <div class="mb-4 pb-2 col-12">
            <h2>{!!$additional_products_header!!}</h2>
            {!!$additional_products_description!!}
          </div>
        @endif
        @if( have_rows('items') )
          @while( have_rows('items') ) @php the_row(); @endphp
            <div class="col-12 col-md-3">
                <figure>
                  {!! wp_get_attachment_image( get_sub_field('image'), 'medium', '', ['class' => 'img-responsive'] ) !!}
                </figure>
                {!!get_sub_field('description')!!}
            </div>
          @endwhile
        @else
          <!-- no rows found -->
        @endif
        </div>
    </div>
    @endif

    <!-- Why to choose Us / same like fruits_in_the_box->section_with_image on Box with Fruits template-->
    @if( isset($show_why_to_choose_us) && $show_why_to_choose_us )
    <div id="why-f4y" class="mb-5 py-5 container">
      @include('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $section_with_image])
    </div>
    @endif
    
    <!-- Contact Form -->
    @if( isset($contact_form_shortcode) && $contact_form_shortcode )
      @section('contact_form')
        <div id="contact_form" class="my-5 d-flex">
          <div class="mx-auto">{!! do_shortcode($contact_form_shortcode) !!}</div>
        </div>
      @endsection
    @endif

  @endwhile
@endsection

