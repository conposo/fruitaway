<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>

    <div class="my-4 py-1 d-flex flex-column flex-md-row justify-content-between align-items-center">
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php if($cta_header): ?>
        <a href="<?php echo e(esc_url( get_permalink($cta_header) )); ?>" class="btn-deco btn-deco-green">
          <?php		
          $do_it_yourself = __('НАПРАВИ СИ САМ', 'f4y');
          if(get_locale() == 'bg_BG') {
            $do_it_yourself = 'НАПРАВИ СИ САМ';
          }
          if(get_locale() == 'en_US') {
            $do_it_yourself = 'DO IT YOURSELF';
          }
          ?>
          <span class="position-relative"><?php echo e($do_it_yourself); ?></span>
        </a>
      <?php endif; ?>
    </div>
    
    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <!-- <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>

    <?php endif; ?>

    <?php if( isset($has_sidebar) && $has_sidebar ): ?>
      <?php $terms = get_field('categories'); ?>
    <?php else: ?>
      <?php $terms[] = get_field('category'); ?>
    <?php endif; ?>

    <?php if( $terms ): ?>
      <div class="mb-5 row">
        <?php if( count($terms) > 1 ): ?>
          <div class="col-12 <?php if( count($terms) > 1 ): ?> col-md-3 <?php endif; ?>">
            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
                  <a class="d-block" data-href="#<?php echo e(get_term_link( $term )); ?>"><?php echo e($term->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>

        <div class="col-12 <?php if( count($terms) > 1 ): ?> col-md-9 <?php endif; ?>">
          <?php
          $see_more_label =__( 'Виж повече', 'f4y' );
          if(get_locale() == 'bg_BG') {
              $see_more_label = 'Виж повече';
          }
          if(get_locale() == 'en_US') {
              $see_more_label = 'More';
          }
          ?>
          <script>
          jQuery(document).ready(function(){
            jQuery('a.button').each(function(){
              jQuery(this).text('<?php echo e($see_more_label); ?> >')
            })
          })
          </script>
          <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
            <?php echo do_shortcode('[products category='.$term->slug.']'); ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>