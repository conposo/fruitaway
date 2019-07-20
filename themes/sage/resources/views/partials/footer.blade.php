<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            @php dynamic_sidebar('sidebar-footer') @endphp
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-md-6 payment-accept text-center text-md-left">
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ) !!}
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ) !!}
                </div>
                <div class="col-md-6 d-none d-md-block text-md-right lets-be-friends">
                    <p>
                        {{ get_field('social', 'options')['title'] }}
                        @php $links = get_field('social', 'options')['links'] @endphp
                        @foreach($links as $link)
                            <a href="{{ $link['item']['url'] }}">
                                {!! $link['item']['title'] !!}
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row py-3">
                <div class="col-6 col-md">
                    {!! App::logo('big', 'print') !!}
                </div>
                <div class="col-6 col-md">
                    <h3>{{ get_field('sections', 'options')['products']['title'] }}</h3>
                    @php $links = get_field('sections', 'options')['products']['links'] @endphp
                    <ul>
                        @foreach($links as $link)
                        <li>
                            <a href="{{ $link['item']['url'] }}">
                                {!! $link['item']['title'] !!}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h3>{{ get_field('sections', 'options')['info']['title'] }}</h3>
                    @php $links = get_field('sections', 'options')['info']['links'] @endphp
                    <ul>
                        @foreach($links as $link)
                        <li>
                            <a href="{{ $link['item']['url'] }}">
                                {!! $link['item']['title'] !!}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="contact-with-us col-6 col-md">
                    <h3>{{ get_field('sections', 'options')['contacts']['title'] }}</h3>
                    @php $links = get_field('sections', 'options')['contacts']['links'] @endphp
                    @foreach($links as $link)
                        <a href="{{ $link['item']['url'] }}">
                            {!! $link['item']['title'] !!}
                        </a>
                    @endforeach
                </div>
                <div class="newsletter col-6 col-md-5 ">
                    <h3>{!! get_field('sections', 'options')['newsletter']['title'] !!}</h3>
                    <div>{!! do_shortcode(get_field('sections', 'options')['newsletter']['form']) !!}</div>
                    <p class="text-center">{{ get_field('sections', 'options')['newsletter']['promise'] }}</p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row bottom-line pt-3 pb-3">
                <div class="col d-flex justify-content-between">
                    <p>
                        {{ sprintf( get_field('copyright', 'options') , date("Y") ) }}
                        @php $links = get_field('special_links', 'options') @endphp
                        @foreach($links as $link)
                            <a href="{{ $link['item']['url'] }}">
                                {!! $link['item']['title'] !!}
                            </a>
                        @endforeach
                    </p>
                    <p class="text-right">
                        {!! get_field('authorship', 'options') !!}
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
        <a class="mr-0 brand navbar-brand position-relative" href="{{ home_url('/') }}">
            {!! App::logo('regular', 'print') !!}
        </a>
        <nav class="nav-primary">
        @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'nav navbar-nav flex-row',
            'depth' => 2,
            'container' => 'div',
            'container_class' => '',
            'container_id' => '',
            ]) !!}
        @endif
        </nav>
        <a id="go_to_cart" class="text-right d-none d-md-block" href="<?= wc_get_cart_url(); ?>">
        {!! wp_get_attachment_image( get_field('basket_icon_id', 'options'), [32, 32] ) !!}
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
            {!! App::logo('regular', 'print') !!}
            @if(get_the_ID() == get_field('box_with_fruits', 'option'))
                <div class="headline ml-3">Кутия със сезонни плодове</div>
            @elseif(get_the_ID() == get_field('subscription', 'option'))
                <div class="headline ml-3">Абонаментна доставка на сезонни плодове</div>
            @endif
        </div>
        @if(get_the_ID() == get_field('box_with_fruits', 'option'))
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#top">
                <span class="position-relative">ИЗБЕРИ И ПОРЪЧАЙ</span>
            </a>
        @elseif(get_the_ID() == get_field('subscription', 'option'))
            <a class="d-flex justify-content-center align-items-center btn-deco btn-deco-red" href="#contact_form">
                <span class="position-relative">НАПРАВИ ЗАПИТВАНЕ</span>
            </a>
        @endif
    </div>
</div>
<?php endif; ?>

<!--Hidden menu End-->