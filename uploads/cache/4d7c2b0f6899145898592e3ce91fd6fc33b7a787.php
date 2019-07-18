<?php $__env->startSection('content'); ?>
  <article id="primary" class="content-area">
    <div class="container-fluid post-bg"></div>
      <div class="container site-content" id="content" role="main">
        <div class="row post-container mx-auto">
          <?php while(have_posts()): ?> <?php the_post() ?>
            <?php the_content() ?>
          <?php endwhile; ?>
          <div class="col-12 col-md-2 pb-5">
            <?php echo $__env->make( 'partials.social-sharing' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        </div>
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

<?php echo $__env->make('layouts.app-fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>