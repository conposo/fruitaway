<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>

    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>

      <div class="mt-5 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php if($cta_header): ?>
          <a href="<?php echo e(esc_url( get_permalink($cta_header) )); ?>" class="my-4 btn-deco btn-deco-green"><?php echo e(__('НАПРАВИ СИ САМ', 'f4y')); ?></a>
        <?php endif; ?>
      </div>

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
            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
              <?php echo do_shortcode('[products category='.$term->slug.']'); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>

    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>