<?php $__env->startSection('content'); ?>
  <?php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  ?>

  <header class="woocommerce-products-header">
    <?php if(apply_filters('woocommerce_show_page_title', true)): ?>
      <h1 class="woocommerce-products-header__title page-title"><?php echo woocommerce_page_title(false); ?></h1>
    <?php endif; ?>

    <?php
      do_action('woocommerce_archive_description');
    ?>
  </header>

  <?php if(woocommerce_product_loop()): ?>
    <?php
      do_action('woocommerce_before_shop_loop');
      woocommerce_product_loop_start();
    ?>

    <?php if(wc_get_loop_prop('total')): ?>
      <?php while(have_posts()): ?>
        <?php
          the_post();
          do_action('woocommerce_shop_loop');
          wc_get_template_part('content', 'product');
        ?>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php
      woocommerce_product_loop_end();
      do_action('woocommerce_after_shop_loop');
    ?>
  <?php else: ?>
    <?php
      do_action('woocommerce_no_products_found');
    ?>
  <?php endif; ?>

  <?php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>