<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>

    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
        <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
    <section id="primary" class="content-area">
        <div class="container" role="main">
            <div class="row">
                <div class="col py-3 py-md-5">
                    <h1><?php echo get_the_title(); ?></h1>
                </div>
            </div>
            <div class="row flex-column-reverse flex-md-row pb-5">
                <!-- Contact Form -->
                <?php if( isset($contact_form_shortcode) && $contact_form_shortcode ): ?>
                    <div class="mb-3 mb-lg-0 col-12 col-lg-6">
                        <?php echo do_shortcode($contact_form_shortcode); ?>

                        <!-- <div id="contact_form" class="d-flex">
                        </div> -->
                    </div>
                <?php endif; ?>
                <div class="mb-3 mb-md-0 col-12 col-lg-6">
                    <div class="mb-3 contact-ctas">
                        <?php if($phone): ?>
                        <a href="tel:0889600113"><?php echo e($phone->title); ?></a><br>
                        <?php endif; ?>
                        <?php if($email): ?>
                        <a href="<?php echo e($email->url); ?>"><?php echo e($email->title); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 company-info">
                        <p><?php echo $company; ?></p>
                    </div>
                    <div class="mb-3 company-address">
                        <p><?php echo $address->label; ?></p>
                        <p><?php echo $address->text; ?></p>
                    </div>
                    <div>
                        <?php echo $address->map; ?>

                    </div>
                </div>
            </div>
        </div><!-- #content -->
    </section><!-- #primary -->
    <?php endif; ?>

    <?php endwhile; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>