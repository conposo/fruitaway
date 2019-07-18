{{--
  Template Name: Gift Baskets Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
      @include('partials.page-header')
      @include('partials.content-page')
    @else

      <div class="mt-5 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
        @include('partials.page-header')
        @if($cta_header)
          <a href="{{ esc_url( get_permalink($cta_header) ) }}" class="my-4 btn-deco btn-deco-green">{{ __('НАПРАВИ СИ САМ', 'f4y') }}</a>
        @endif
      </div>

      @if( isset($has_sidebar) && $has_sidebar )
        @php $terms = get_field('categories'); @endphp
      @else
        @php $terms[] = get_field('category'); @endphp
      @endif

      @if( $terms )
        <div class="mb-5 row">
          @if( count($terms) > 1 )
            <div class="col-12 @if( count($terms) > 1 ) col-md-3 @endif">
              @foreach( $terms as $term_id )
                @php $term = get_term_by('id', $term_id, 'product_cat'); @endphp
                    <a class="d-block" data-href="#{{ get_term_link( $term ) }}">{{$term->name}}</a>
              @endforeach
            </div>
          @endif

          <div class="col-12 @if( count($terms) > 1 ) col-md-9 @endif">
            @foreach( $terms as $term_id )
              @php $term = get_term_by('id', $term_id, 'product_cat'); @endphp
              {!! do_shortcode('[products category='.$term->slug.']') !!}
            @endforeach
        </div>
      @endif

    @endif

  @endwhile
@endsection
