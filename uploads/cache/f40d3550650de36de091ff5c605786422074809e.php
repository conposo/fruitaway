<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    
    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    
    <!-- Product -->
    <?php if( isset($the_product_id) && $GLOBALS['the_product_id'] = $the_product_id ): ?>
    <section id="top" class="container my-5">
	    <div class="row">
		    <div class="col">
          <?php global $product; ?>
          <?php echo do_shortcode("[product_page id='$the_product_id']"); ?>

          <?php if( $fruits_in_the_box ): ?>
            <?php if( $fruits_in_the_box->section_with_fruits ): ?>
              <?php echo $__env->make('partials.fruits_in_the_box.section_with_fruits', ['fruits_in_the_box' => $fruits_in_the_box], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if( $fruits_in_the_box->section_with_image ): ?>
              <?php echo $__env->make('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $fruits_in_the_box], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
          <?php endif; ?>
		    </div>
	    </div>
    </section>
    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<style>
p.price {
  display: none;
}
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>