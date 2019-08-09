<?php $__env->startSection('content'); ?>
  
  <!-- <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->

    <section id="main-content" class="main-content">

        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <?php echo $__env->make('partials.header-blog', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="container">
                    <div class="row pt-5 _pb-5">
                        <?php $the_query = Home::the_query(); $posts_ids = ''; ?>
                        <?php while($the_query->have_posts()): ?> <?php $the_query->the_post() ?>
                            <div class="col-6 col-md-3 pb-3">
                                <div class="post-thumbnail">
                                    <a href="<?php echo e(esc_url(the_permalink())); ?>"><?php echo e(the_post_thumbnail('delicious-recent-thumbnails')); ?></a>
                                </div>
                                <div class="pt-content">
                                    <p class="my-2"><?php echo e(get_the_author_meta('display_name')); ?> | <?php echo e(get_the_date('d.m.Y')); ?></p>
                                    <p class="mb-0">
                                        <a href="<?php echo e(esc_url(the_permalink())); ?>"><?php echo the_title(); ?></a>
                                    </p>
                                </div>
                            </div>
                            <?php $posts_ids .= get_the_ID().','; ?>
                        <?php endwhile; ?>
                        <?php wp_reset_query() ?>
                    </div>
                </div>

                <?php echo do_shortcode('[ajax_load_more post_format="standard" exclude="'.$posts_ids.'" id="23141325425" container_type="div" max_pages="1" posts_per_page="4" images_loaded="true" button_label="'.__('Load more articles EN', 'f4y').'"]'); ?>


            </div><!-- #content -->
        </div><!-- #primary -->
        <?php //get_sidebar( 'content' ); ?>
    </section><!-- #main-content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>