{{--
  Template Name: Box with Fruits Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    
    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
      @include('partials.page-header')
      @include('partials.content-page')
    @endif
    
    <!-- Product -->
    @if( isset($the_product_id) && $GLOBALS['the_product_id'] = $the_product_id )
    <section class="container my-5">
	    <div class="row">
		    <div class="col">
          @php global $product; @endphp
          {!! do_shortcode("[product_page id='$the_product_id']") !!}
          @if( $fruits_in_the_box )
            @if( $fruits_in_the_box->section_with_fruits )
              @include('partials.fruits_in_the_box.section_with_fruits', ['fruits_in_the_box' => $fruits_in_the_box])
            @endif
            @if( $fruits_in_the_box->section_with_image )
              @include('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $fruits_in_the_box])
            @endif
          @endif
		    </div>
	    </div>
    </section>
    @endif

  @endwhile
@endsection
