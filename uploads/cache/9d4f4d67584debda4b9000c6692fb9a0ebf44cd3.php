<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <?php dynamic_sidebar('sidebar-footer') ?>
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-md-6 payment-accept text-center text-md-left">
                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ); ?>

                    <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ); ?>

                </div>
                <div class="col-md-6 d-none d-md-block text-md-right lets-be-friends">
                    <p>
                        <?php echo e(get_field('social', 'options')['title']); ?>

                        <?php $links = get_field('social', 'options')['links'] ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['item']['url']); ?>">
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
                <div class="col-6 col-md">
                    <?php echo App::logo('big', 'print'); ?>

                </div>
                <div class="col-6 col-md">
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
                <div class="col-6 col-md">
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
                <div class="contact-with-us col-6 col-md">
                    <h3><?php echo e(get_field('sections', 'options')['contacts']['title']); ?></h3>
                    <?php $links = get_field('sections', 'options')['contacts']['links'] ?>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($link['item']['url']); ?>">
                            <?php echo $link['item']['title']; ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="newsletter col-6 col-md-5 ">
                    <h3><?php echo get_field('sections', 'options')['newsletter']['title']; ?></h3>
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


<!--Hidden menu-->

<script>
jQuery(document).ready(function() {
    jQuery(window).scroll(function() {
        if(jQuery(document).scrollTop() > 100) {
            jQuery('.secondary-nav').addClass('shown');
        } else {
            jQuery('.secondary-nav').removeClass('shown');
        }
        if(jQuery('.secondary-nav').hasClass('shown') && jQuery(document).scrollTop() < 151) {
            jQuery('.secondary-nav').addClass('hide');
        }
    });
});
</script>
<div id="hidden-menu" class="local_nav banner px-4 secondary-nav bg-white position-fixed w-100 d-none d-xl-flex justify-content-between align-items-center">
    <div class="container d-flex justify-content-between">
        <a class="mr-0 brand navbar-brand position-relative" href="<?php echo e(home_url('/')); ?>">
            <?php echo App::logo('regular', 'print'); ?>

        </a>
        <nav class="nav-primary">
        <?php if(has_nav_menu('primary_navigation')): ?>
            <?php echo wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'nav navbar-nav flex-row',
            'depth' => 2,
            'container' => 'div',
            'container_class' => '',
            'container_id' => '',
            ]); ?>

        <?php endif; ?>
        </nav>
        <a id="go_to_cart" class="text-right d-none d-md-block" href="<?= wc_get_cart_url(); ?>">
        <?php echo wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ); ?>

        </a>
    </div>
    <script>
    jQuery(document).ready(function(){
      jQuery('#go_to_cart').width( jQuery('.brand img').width() )
    });
    </script>
</div>

<?php //dd( get_field('subscription', 'option'), get_field('box_with_fruits', 'option') ) ; ?>
<?php if( get_the_ID() == get_field('subscription', 'option') || get_the_ID() == get_field('box_with_fruits', 'option') ) : ?>
<div id="hidden-menu" class="local_nav banner px-4 secondary-nav bg-white position-fixed w-100 d-none d-xl-flex justify-content-between align-items-center">
    <div class="py-1 container d-flex align-items-center justify-content-between">
        <div class="brand d-flex align-items-center">
            <?php echo App::logo('regular', 'print'); ?>

            <?php if(get_the_ID() == get_field('box_with_fruits', 'option')): ?>
                <div class="headline ml-3">Кутия със сезонни плодове</div>
            <?php elseif(get_the_ID() == get_field('subscription', 'option')): ?>
                <div class="headline ml-3">Абонаментна доставка на сезонни плодове</div>
            <?php endif; ?>
        </div>
        <?php if(get_the_ID() == get_field('box_with_fruits', 'option')): ?>
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#top">
                <span class="position-relative">ИЗБЕРИ И ПОРЪЧАЙ</span>
            </a>
        <?php elseif(get_the_ID() == get_field('subscription', 'option')): ?>
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#contact_form">
                <span class="position-relative">НАПРАВИ ЗАПИТВАНЕ</span>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!--Hidden menu End-->