<?php $__env->startSection('content'); ?>
  <?php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  ?>

  <?php while(have_posts()): ?>
    <?php
      the_post();
      do_action('woocommerce_shop_loop');
      wc_get_template_part('content', 'single-product');
    ?>
  <?php endwhile; ?>

  <?php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>