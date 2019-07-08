<header class="banner navbar navbar-expand-md navbar-white" role="navigation">
  <div class="container">
    <a class="brand navbar-brand" href="<?php echo e(home_url('/')); ?>">
      <?php echo e(get_bloginfo('name', 'display')); ?>

      <?php if(is_front_page()) { ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-home.svg">
      <?php } else { ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-pages.svg">
      <?php } ?>
    </a>
    <!-- Brand and toggle get grouped for better mobile display -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/menu.svg"></span>
    </button>
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
      <a class="d-none d-md-block d-lg-block d-xl-block" href="#">
        <img src="<?= App\asset_path('shopping-basket.png'); ?>">
      </a>
    </nav>
  </div>
</header>