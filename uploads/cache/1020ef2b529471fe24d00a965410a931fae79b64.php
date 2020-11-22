
    <div class="testimonials-wrapper _mb-5 mb-md-0 py-5 bg-success container-fluid position-relative">
    <?php
        $testimonials = App::get(App::testimonialsNumber());
    ?>

    <?php if($testimonials->have_posts()): ?>
        <?php if($testimonialsHeader = App::testimonialsHeader()): ?>
            <h2 class="mb-5 text-center"><?php echo e($testimonialsHeader); ?></h2>
        <?php endif; ?>
        <div class="container">
            <div id="testimonials_carousel" class="pb-5 carousel _carousel-fade slide" data-ride="carousel">
                <ol class="carousel-indicators" style="bottom: -25px;">
                    <?php for($i = 0; $i < $testimonials->found_posts; $i++): ?>
                        <li style="width:16px; height:16px;" class="<?php if($i == 0): ?> active <?php endif; ?> mx-2 rounded-circle" data-target="#testimonials_carousel" data-slide-to="<?php echo e($i); ?>"></li>
                    <?php endfor; ?>
                </ol>
                <div class="carousel-inner">
                    <?php $counter = 1; ?>
                    <?php while($testimonials->have_posts()): ?> <?php $testimonials->the_post(); ?>
                    <div class="carousel-item <?php if($counter == 1): ?> active <?php endif; ?>">
                        <div class="row flex-column flex-md-row align-items-center">
                            <div class="mb-3 mb-lg-0 pr-lg-0 col-12 col-md-3 text-center text-md-right">
                                <?php if( $_image = get_post_thumbnail_id( get_the_ID() ) ): ?>
                                <figure class="<?php if(wp_is_mobile()): ?> w-50 <?php endif; ?> mx-auto m-0 text-center text-lg-left">
                                    <?php echo wp_get_attachment_image( $_image, [165, 165], '', ['class' => 'rounded-circle border h-auto'] ); ?>

                                </figure>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-9 d-flex flex-column justify-content-center text-center text-md-left">
                                <p class="order-2 order-md-1">
                                    <?php echo get_the_content(); ?>

                                </p>
                                <h2 class="order-1 order-md-2">
                                    <?php echo get_the_title(); ?>

                                </h2>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#testimonials_carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#testimonials_carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    <?php else: ?>
        not has any testimonials
    <?php endif; ?>
    </div>

