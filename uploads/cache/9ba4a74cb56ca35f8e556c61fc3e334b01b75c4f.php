<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    
    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php if($cta_header): ?>
        <a href="<?php echo esc_url( get_permalink($cta_header) ); ?>" class="btn-deco btn-deco-green"><?php _e('НАПРАВИ СИ САМ', 'f4y') ?></a>
      <?php endif; ?>

      <?php if( isset($has_sidebar) && $has_sidebar ): ?>
        <?php $terms = get_field('categories'); ?>
      <?php else: ?>
        <?php $terms[] = get_field('category'); ?>
      <?php endif; ?>
      <?php if( $terms ): ?>
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
      <?php endif; ?>

    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>