<?php $__env->startSection('content'); ?>
  <article id="primary" class="content-area">
    <div class="container-fluid post-bg"></div>
    <div class="container site-content" id="content" role="main">
      <?php while(have_posts()): ?> <?php the_post() ?>
        <?php echo $__env->make('partials.content-single-'.get_post_type(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endwhile; ?>
      <?php get_template_part( 'templates/partials/social-sharing' ); ?></div></div><!-- Closing Row and Col - View theme-setup -->
    </div><!-- #content -->
    <div class="container-fluid rp-bg">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center pb-5">
                <h2>Подобни статии</h2>
            </div>
            <div class="row">
                <?php
                SinglePost::related_posts();
                ?>
            </div>
        </div>
    </div>
  </article><!-- #primary -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>