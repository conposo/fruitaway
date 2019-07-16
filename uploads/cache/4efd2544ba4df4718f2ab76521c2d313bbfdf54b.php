<header class="banner navbar navbar-expand-md navbar-white" role="navigation">
  <div class="container">

    <a class="brand navbar-brand" href="<?php echo e(home_url('/')); ?>">
      <?php if(is_front_page()): ?>
        <?php echo App::logo('big', 'print'); ?>

      <?php else: ?>
        <?php echo App::logo('regular', 'print'); ?>

      <?php endif; ?>
    </a>

    <nav class="nav-primary">
      <?php if(has_nav_menu('primary_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav navbar-nav',
          'depth' => 2,
          'container' => 'div',
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'bs-example-navbar-collapse-1',
          'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
          ]); ?>

      <?php endif; ?>
    </nav>

    <a class="d-none d-md-block d-lg-block d-xl-block" href="<?= wc_get_cart_url(); ?>">
      <?php echo wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ); ?>

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span><?php echo wp_get_attachment_image( get_field('menu_icon_id', 'options') ); ?></span>
    </button>

  </div>
</header>