<!--Hidden menu-->

<?php
$box_with_fruits =__( 'Кутия със сезонни плодове', 'f4y' );
$subscribe =__( 'Абонаментна доставка на сезонни плодове', 'f4y' );
$choose_and_order =__( 'ИЗБЕРИ И ПОРЪЧАЙ', 'f4y' );
$make_ =__( 'НАПРАВИ ЗАПИТВАНЕ', 'f4y' );
if(get_locale() == 'bg_BG') {
    $box_with_fruits = 'Кутия със сезонни плодове';
    $subscribe = 'АБОНАМЕНТ ЗА ДОСТАВКА НА КУТИЯ ПЛОДОВЕ';
    $choose_and_order = 'ИЗБЕРИ И ПОРЪЧАЙ';
    $make_ = 'НАПРАВИ ЗАПИТВАНЕ';
}
if(get_locale() == 'en_US') {
    $box_with_fruits = 'Fruit boxes';
    $subscribe = 'SUBSCRIPTION TO OUR FRUIT BOX DELIVERY';
    $choose_and_order = ' CHOOSE AND ORDER';
    $make_ = 'SEND REQUEST';
}

// dd( get_field('do_it_yourself', 'option') );
// dd( !is_cart(), !is_checkout(), !is_page( get_field('do_it_yourself', 'option') ) );
?>

<?php if( !is_cart() && !is_checkout() && !is_page( get_field('do_it_yourself', 'option') ) ): ?>
<script>
jQuery(document).ready(function() {
});
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
</script>
<div id="hidden-menu" class="hide navbar local_nav banner px-4 secondary-nav bg-white position-fixed w-100 d-none d-xl-flex justify-content-between align-items-center">
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
        <a id="go_to_cart2" class="text-right d-none d-md-block" href="<?= wc_get_cart_url(); ?>">
            <?php echo wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ); ?>

        </a>
    </div>
    <script>
    jQuery(document).ready(function(){
      jQuery('#go_to_cart2').width( jQuery('.brand img').width() )
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
                <div class="headline ml-3"><?php echo e($box_with_fruits); ?></div>
            <?php elseif(get_the_ID() == get_field('subscription', 'option')): ?>
                <div class="headline ml-3"><?php echo e($subscribe); ?></div>
            <?php endif; ?>
        </div>
        <?php if(get_the_ID() == get_field('box_with_fruits', 'option')): ?>
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#top">
                <span class="position-relative"><?php echo e($choose_and_order); ?></span>
            </a>
        <?php elseif(get_the_ID() == get_field('subscription', 'option')): ?>
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#contact_form">
                <span class="position-relative"><?php echo e($make_); ?></span>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<!--Hidden menu End-->