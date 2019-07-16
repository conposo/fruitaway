@extends('layouts.app')

@section('content')
  @include('partials.page-header')

    <section id="main-content" class="main-content">

        <?php

        ?>
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="container-fluid pink-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1>Вкусният блог - рецепти, съвети и още…</h1>
                            </div>
                        </div>
                        <div class="row">
                            <nav class="navbar navbar-expand-md navbar-white w-100 categories" role="navigation">
                                <div class="container">
                                    <a class="navbar-brand d-block-on-mobile" href="#">Категории</a>
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-category-navbar-collapse-1" aria-controls="bs-category-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                        <span>V</span>
                                    </button>
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'categories-menu',
                                        'depth'             => 2,
                                        'container'         => 'div',
                                        'container_class'   => 'collapse navbar-collapse',
                                        'container_id'      => 'bs-category-navbar-collapse-1',
                                        'menu_class'        => 'nav navbar-nav',
                                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'            => new WP_Bootstrap_Navwalker(),
                                    ) );
                                    ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row pt-5 pb-5">
                        <?php
                        foreach( ( get_the_category() ) as $category ) {
                            $the_query = new WP_Query('category_name=' . $category->category_nicename . '&showposts=5&order=ASC');
                            while ($the_query->have_posts()) : $the_query->the_post();
                                ?>
                                <div class="col-6 col-md-3 pb-3">
                                    <div class="post-thumbnail">
                                        <a href="<?php esc_url(the_permalink()); ?>">
                                            <?php the_post_thumbnail('delicious-recent-thumbnails'); ?>
                                        </a>
                                    </div>
                                    <div class="pt-content">
                                        <p><?php echo get_the_author_meta('display_name'); ?> | <?php echo get_the_date('d.m.Y'); ?></p>
                                        <p>
                                            <a href="<?php esc_url(the_permalink()); ?>">
                                                <?php esc_html(the_title()); ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php
                        }
                        ?>
                    </div>
                </div>



            </div><!-- #content -->
        </div><!-- #primary -->
        <?php //get_sidebar( 'content' ); ?>
    </section><!-- #main-content -->

@endsection
