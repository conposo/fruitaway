
<?php if( wp_is_mobile() ): ?>
<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <?php dynamic_sidebar('sidebar-footer') ?>
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-lg-6 payment-accept text-center text-lg-left">
                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ); ?>

                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ); ?>

                </div>
                <div class="col-lg-6 d-none d-lg-block text-lg-right lets-be-friends">
                    <p>
                        <?php echo e(get_field('social', 'options')['title']); ?>

                        <?php $links = get_field('social', 'options')['links'] ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['item']['url']); ?>" target="<?php echo e($link['item']['target']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row py-3">
                <div class="col-6 col-lg logo">
                    <?php echo App::logo('big', 'print'); ?>

                </div>
                <div class="contact-with-us col-6 col-lg">
                    <h3><?php echo e(get_field('sections', 'options')['contacts']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['contacts']['links'] ?>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($link['item']['url']); ?>">
                            <?php echo $link['item']['title']; ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg">
                    <h3><?php echo e(get_field('sections', 'options')['products']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['products']['links'] ?>
                    <ul>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="col-6 col-lg">
                    <h3><?php echo e(get_field('sections', 'options')['info']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['info']['links'] ?>
                    <ul>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div class="row border-top pt-3 ">
                <div class="newsletter col-12 text-center">
                    <h3><?php echo get_field('sections', 'options')['newsletter']['title']; ?></h3>
                    <div><?php echo do_shortcode(get_field('sections', 'options')['newsletter']['form']); ?></div>
                    <p class="text-center"><?php echo e(get_field('sections', 'options')['newsletter']['promise']); ?></p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row border-bottom pt-3 pb-3">
                <div class="col d-flex justify-content-center">
                    <p class="text-center">
                        <?php $links = get_field('special_links', 'options') ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <p class="pt-3 text-center">
                        <?php echo e(sprintf( get_field('copyright', 'options') , date("Y") )); ?>

                        <br>
                        <?php echo get_field('authorship', 'options'); ?>

                    </p>
                </div>
            </div>

        </div><!-- END container -->
    </div><!-- END container-fluid -->
</footer>
<?php else: ?>
<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <?php dynamic_sidebar('sidebar-footer') ?>
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-lg-6 payment-accept text-center text-lg-left">
                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ); ?>

                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ); ?>

                </div>
                <div class="col-lg-6 d-none d-lg-block text-lg-right lets-be-friends">
                    <p>
                        <?php echo e(get_field('social', 'options')['title']); ?>

                        <?php $links = get_field('social', 'options')['links'] ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['item']['url']); ?>" target="<?php echo e($link['item']['target']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row py-3">
                <div class="col-2 col-xxl">
                    <?php echo App::logo('big', 'print'); ?>

                </div>
                <div class="col-2 col-xxl">
                    <h3><?php echo e(get_field('sections', 'options')['products']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['products']['links'] ?>
                    <ul>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="col-2 col-xxl">
                    <h3><?php echo e(get_field('sections', 'options')['info']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['info']['links'] ?>
                    <ul>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="contact-with-us col-2 col-xxl">
                    <h3><?php echo e(get_field('sections', 'options')['contacts']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['contacts']['links'] ?>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($link['item']['url']); ?>">
                            <?php echo $link['item']['title']; ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="newsletter col-4 col-xxl-5 ">
                    <h3 class="mb-3"><?php echo get_field('sections', 'options')['newsletter']['title']; ?></h3>
                    <div><?php echo do_shortcode(get_field('sections', 'options')['newsletter']['form']); ?></div>
                    <p class="text-center"><?php echo e(get_field('sections', 'options')['newsletter']['promise']); ?></p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row bottom-line pt-3 pb-3">
                <div class="col d-flex justify-content-between">
                    <p>
                        <?php echo e(sprintf( get_field('copyright', 'options') , date("Y") )); ?>

                        <?php $links = get_field('special_links', 'options') ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['item']['url']); ?>">
                                <?php echo $link['item']['title']; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <p class="text-right">
                        <?php echo get_field('authorship', 'options'); ?>

                    </p>
                </div>
            </div>

        </div><!-- END container -->
    </div><!-- END container-fluid -->
</footer>
<?php endif; ?>

<?php echo $__env->make('partials.hidden-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if( get_field('gift_baskets', 'option') != get_the_ID() ): ?>
<script>
	jQuery( "a.woocommerce-LoopProduct-link.woocommerce-loop-product__link" ).css('cursor', 'default');
	jQuery( "a.woocommerce-LoopProduct-link.woocommerce-loop-product__link" ).click(function( event ) {
        event.preventDefault();
        console.log(5);
	});
</script>
<?php endif; ?>
