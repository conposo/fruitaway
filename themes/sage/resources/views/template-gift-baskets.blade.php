{{--
  Template Name: Gift Baskets Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    <div class="my-4 py-1 d-flex flex-column flex-md-row justify-content-between align-items-center">
      @include('partials.page-header')
      @if($cta_header)
        <a href="{{ esc_url( get_permalink($cta_header) ) }}" class="btn-deco btn-deco-green">
          <?php		
          $do_it_yourself = __('НАПРАВИ СИ САМ', 'f4y');
          if(get_locale() == 'bg_BG') {
            $do_it_yourself = 'НАПРАВИ СИ САМ';
          }
          if(get_locale() == 'en_US') {
            $do_it_yourself = 'DO IT YOURSELF';
          }
          ?>
          <span class="position-relative">{{ $do_it_yourself }}</span>
        </a>
      @endif
    </div>
    
    <!-- Content -->
    @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
      <!-- @include('partials.page-header') -->
      @include('partials.content-page')
    @else

    @endif

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
          @php
          $see_more_label =__( 'Виж повече', 'f4y' );
          if(get_locale() == 'bg_BG') {
              $see_more_label = 'Виж повече';
          }
          if(get_locale() == 'en_US') {
              $see_more_label = 'More';
          }
          @endphp
          <script>
          jQuery(document).ready(function(){
            jQuery('a.button').each(function(){
              jQuery(this).text('{{$see_more_label}} >')
            })
          })
          </script>
          @foreach( $terms as $term_id )
            @php $term = get_term_by('id', $term_id, 'product_cat'); @endphp
            {!! do_shortcode('[products category='.$term->slug.']') !!}
          @endforeach
        </div>
      </div>
    @endif

  @endwhile
@endsection
