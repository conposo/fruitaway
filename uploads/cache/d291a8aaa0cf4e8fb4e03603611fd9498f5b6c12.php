<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <!-- <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->

    <?php if( isset($slider) && $slider ): ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/onepage-scroll/1.3.1/jquery.onepage-scroll.min.js" integrity="sha256-ebDxrwt7kMPVFDyByLPRX8aoDawYgA8b32EwRsV1Avg=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/onepage-scroll/1.3.1/onepage-scroll.min.css" integrity="sha256-jrnMvkWCUmibf9tHVn9ULsNdyRRje3IfO/elUnU/8m8=" crossorigin="anonymous" />
        
        <div id="one_page_scroll" class="vh-100">
        <?php if( have_rows('slider') ): ?>
            <?php while( have_rows('slider') ): ?> <?php the_row(); ?>
                <section class="d-flex align-items-center">
                    <div class="container">
                        <div class="container-inner d-flex flex-column-reverse flex-md-row">
                            <div class="col-lg-6 content d-flex align-items-center">
                                <div>
                                    <?php if( $heading = get_sub_field('heading') ): ?>
                                        <h1 class="mb-3 mb-md-4"><?php echo e($heading); ?></h1>
                                    <?php endif; ?>
                                    <p class="mb-3 mb-md-4 d-block"><?php echo e(get_sub_field('text')); ?></p>
                                    <a class="text-uppercase btn-deco btn-deco-green" href="<?php echo e(get_sub_field('cta')); ?>">
                                        <span class="position-relative"><?php echo e(__('виж повече', 'f4y')); ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 pt-lg-3 pt-md-0 image">
                                <?php
                                    $image_id = get_sub_field('image');
                                ?>
                                <?php echo wp_get_attachment_image( $image_id, ['700', '600'], "", ["class" => "img-responsive"] ); ?>

                            </div>
                        </div>
                    </div>
                </section>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- no rows found -->
        <?php endif; ?>
        </div><!-- END #one_page_scroll -->
        
        <script>
        jQuery('#one_page_scroll').onepage_scroll({
            afterMove: function(index) {
                if(index == 3) {
                    console.log(index);
                }
            },
            sectionContainer: 'section',
            loop: false,
            updateURL: false,
        });
        </script>
    <?php else: ?>
        <!-- no $slider, print the content -->
        <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>