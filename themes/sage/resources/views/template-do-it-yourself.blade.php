{{--
  Template Name: Do It Yourself Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
      @include('partials.page-header')
      @include('partials.content-page')
    @else
      @include('partials.page-header')
      @if( isset($categories) && $categories )
        <div>
          @foreach( $categories as $term_id )
            @php $term = get_term_by('id', $term_id, 'product_cat'); @endphp
            <a class="d-block" data-href="#{{get_term_link( $term )}}">{{$term->name}}</a>
          @endforeach
        </div>

        <div>
          @foreach( $categories as $term_id )
            <div class="mb-5 border p-5">
              @php $term = get_term_by('id', $term_id, 'product_cat'); @endphp
              {!! do_shortcode("[products category='$term->slug' columns=3]") !!}
            </div>
          @endforeach
        </div>
      @endif
    @endif

  @endwhile
@endsection
