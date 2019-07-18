
    <div class="fruits-in-box">
        
        <div class="mb-3 mb-md-5 pt-5 row">
            <div class=" text-center col-12">
                <h2><?php echo e($fruits_in_the_box->section_with_fruits_heading); ?></h2>
                <?php echo $fruits_in_the_box->section_with_fruits_text; ?>

            </div>
        </div>

        <?php if( $fruits = $fruits_in_the_box->fruits ): ?>
            <div class="mb-5 row">
                <?php
                    global $post;
                ?>

                <?php $__currentLoopData = $fruits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        setup_postdata($post);
                    ?>
                    <div class="fruit text-center col-4 col-md-2">
                        <div class="mb-4 product-thumbnail">
                            <?php if( has_post_thumbnail() ): ?>
                                <?php the_post_thumbnail( 'additional-product' ); ?>
                            <?php endif; ?>
                        </div>
                        <p class="title"><?php echo get_the_title(); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php
                    wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
        
    </div>