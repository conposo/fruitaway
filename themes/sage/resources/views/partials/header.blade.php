<header class="py-4 banner navbar navbar-expand-md navbar-white" role="navigation">
  <div class="container -fluid">

    <a class="mr-0 brand navbar-brand position-relative" href="{{ home_url('/') }}">
      @if(is_front_page() && !wp_is_mobile())
        {!! App::logo('big', 'print') !!}
      @else
        {!! App::logo('regular', 'print') !!}
      @endif
    </a>
    <button class="ml-auto mr-0 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span>{!! wp_get_attachment_image( get_field('menu_icon_id', 'options') ) !!}</span>
    </button>

    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav navbar-nav',
          'depth' => 2,
          'container' => 'div',
          'container_class' => 'collapse navbar-collapse',
          'container_id' => 'navbar-collapse',
          ]) !!}
      @endif
    </nav>

    <a id="go_to_cart" class="text-right d-none d-md-block" href="<?= wc_get_cart_url(); ?>">
      {!! wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ) !!}
    </a>

    <script>
    jQuery(document).ready(function(){
      jQuery('#go_to_cart').width( jQuery('.brand img').width() )
    });
    </script>

  </div>
</header>