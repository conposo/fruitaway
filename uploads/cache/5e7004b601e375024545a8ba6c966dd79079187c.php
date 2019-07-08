<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>

    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php if( isset($categories) && $categories ): ?>
        <div>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
            <a class="d-block" data-href="#<?php echo e(get_term_link( $term )); ?>"><?php echo e($term->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="mb-5 border p-5">
            <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
            <?php echo do_shortcode("[products category='$term->slug' columns=3]"); ?>

          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>