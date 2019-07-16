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
      <div class="d-flex justify-content-between align-items-center">
        @include('partials.page-header')
        @if($cta_header)
          <a href="<?php echo esc_url( get_permalink($cta_header) ); ?>" class="btn-deco btn-deco-green"><?php _e('НАПРАВИ СИ САМ', 'f4y') ?></a>
        @endif
      </div>

      @if( isset($has_sidebar) && $has_sidebar )
        @php $terms = get_field('categories'); @endphp
      @else
        @php $terms[] = get_field('category'); @endphp
      @endif
      @if( $terms )
        <div class="my-5 pt-5 row">
          <?php if( count($terms) > 1 ): ?> 
              <div class="col-12 <?php if( count($terms) > 1 ): ?> col-md-3 <?php endif; ?>">
                  <?php foreach( $terms as $term_id ):
                      $term = get_term_by('id', $term_id, 'product_cat');
                      ?>
                      <a class="d-block" data-href="#<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
                  <?php endforeach; ?>
              </div>
          <?php endif; ?>

          <div class="border-top col-12 <?php if( count($terms) > 1 ): ?> col-md-9 <?php endif; ?>">
          <?php
          foreach( $terms as $term_id ):
              $term = get_term_by('id', $term_id, 'product_cat');
              $args = array(
                  'post_type'      => 'product',
                  'posts_per_page' => -1,
                  'product_cat'    => $term->slug
              );
              $loop = new WP_Query( $args );
              ?>
              <!-- <h3 class="d-block" data-href="#<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></h3> -->
              <?php
              echo do_shortcode('[products category='.$term->slug.']');
          endforeach;
          ?>
        </div>
      @endif

    @endif

  @endwhile
@endsection
