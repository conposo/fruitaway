
    <div class="testimonials-wrapper mb-5 mb-md-0 py-5 bg-success container-fluid position-relative">
    <?php
        $testimonials = App::get(App::testimonialsNumber());
    ?>

    <?php if($testimonials->have_posts()): ?>
        <?php if($testimonialsHeader = App::testimonialsHeader()): ?>
            <h2 class="mb-3 text-center"><?php echo e($testimonialsHeader); ?></h2>
        <?php endif; ?>
        <div class="container">
            <div id="testimonials_carousel" class="carousel _carousel-fade slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $counter = 1; ?>
                    <?php while($testimonials->have_posts()): ?> <?php $testimonials->the_post(); ?>
                    <div class="carousel-item <?php if($counter == 1): ?> active <?php endif; ?>">
                        <div class="row flex-column flex-md-row align-items-center">
                            <div class="col-4 text-md-right">
                                <?php if( $_image = get_post_thumbnail_id( get_the_ID() ) ): ?>
                                <figure>
                                    <?php echo wp_get_attachment_image( $_image, 'thumbnail', '', ['class' => 'rounded-circle border h-auto'] ); ?>

                                </figure>
                                <?php endif; ?>
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-center">
                                <?php echo get_the_content(); ?>

                                <h2>
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

