<header class="pt-3 pb-0 py-md-4 banner navbar navbar-expand-lg navbar-white" role="navigation">
  <div class="container -fluid">

    <a class="mr-0 brand navbar-brand position-relative" href="<?php echo e(home_url('/')); ?>">
      <?php if(is_front_page()): ?>
        <?php echo App::logo('big', 'print'); ?>

      <?php else: ?>
        <?php echo App::logo('regular', 'print'); ?>

      <?php endif; ?>
    </a>
    <button class="ml-auto mr-0 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span><?php echo wp_get_attachment_image( get_field('menu_icon_id', 'options') ); ?></span>
    </button>

    <nav class="<?php if(wp_is_mobile()): ?> w-100 <?php endif; ?> <?php if(is_front_page()): ?> mt-5 pt-5 mt-sm-0 pt-sm-0 <?php else: ?> mt-3 <?php endif; ?> nav-primary">
      <?php if(has_nav_menu('primary_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav navbar-nav',
          'depth' => 2,
          'container' => 'div',
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'navbar-collapse',
          ]); ?>

      <?php endif; ?>
    </nav>

    <a id="go_to_cart" class="text-right d-none d-lg-block" href="<?= wc_get_cart_url(); ?>">
      <?php echo wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ); ?>

    </a>

  </div>
</header>

<script>
  jQuery(document).ready(function(){
    jQuery('a.navbar-brand.brand').width( jQuery('.brand img').width() )
    if(jQuery(window).width() > 1200) {
      // jQuery('#go_to_cart').width( jQuery('.brand img').width() )
    }
  });
</script>