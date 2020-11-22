
@if( wp_is_mobile() )
<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            @php dynamic_sidebar('sidebar-footer') @endphp
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-lg-6 payment-accept text-center text-lg-left">
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ) !!}
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ) !!}
                </div>
                <div class="col-lg-6 d-none d-lg-block text-lg-right lets-be-friends">
                    <p>
                        {{ get_field('social', 'options')['title'] }}
                        @php $links = get_field('social', 'options')['links'] @endphp
                        @foreach($links as $link)
                            <a href="{{ $link['item']['url'] }}" target="{{ $link['item']['target'] }}">
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
                <div class="col-6 col-lg logo">
                    {!! App::logo('big', 'print') !!}
                </div>
                <div class="contact-with-us col-6 col-lg">
                    <h3>{{ get_field('sections', 'options')['contacts']['title'] }}</h3>
                    @php $links = get_field('sections', 'options')['contacts']['links'] @endphp
                    @foreach($links as $link)
                        <a href="{{ $link['item']['url'] }}">
                            {!! $link['item']['title'] !!}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg">
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
                <div class="col-6 col-lg">
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
            </div>
            <div class="row border-top pt-3 ">
                <div class="newsletter col-12 text-center">
                    <h3>{!! get_field('sections', 'options')['newsletter']['title'] !!}</h3>
                    <div>{!! do_shortcode(get_field('sections', 'options')['newsletter']['form']) !!}</div>
                    <p class="text-center">{{ get_field('sections', 'options')['newsletter']['promise'] }}</p>
                </div>
            </div>
            
        </div><!-- END container -->
    </div><!-- END container-fluid -->
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            <div class="row border-bottom pt-3 pb-3">
                <div class="col d-flex justify-content-center">
                    <p class="text-center">
                        @php $links = get_field('special_links', 'options') @endphp
                        @foreach($links as $link)
                            <a href="{{ $link['item']['url'] }}">
                                {!! $link['item']['title'] !!}
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <p class="pt-3 text-center">
                        {{ sprintf( get_field('copyright', 'options') , date("Y") ) }}
                        <br>
                        {!! get_field('authorship', 'options') !!}
                    </p>
                </div>
            </div>

        </div><!-- END container -->
    </div><!-- END container-fluid -->
</footer>
@else
<footer class="content-info">
    <div class="container-fluid  border-top">
        <div class="container -fluid">

            @php dynamic_sidebar('sidebar-footer') @endphp
            <div class="row d-flex justify-content-between align-items-center pt-3 pb-3">
                <div class="col-12 col-lg-6 payment-accept text-center text-lg-left">
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ) !!}
                    {!! wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ) !!}
                </div>
                <div class="col-lg-6 d-none d-lg-block text-lg-right lets-be-friends">
                    <p>
                        {{ get_field('social', 'options')['title'] }}
                        @php $links = get_field('social', 'options')['links'] @endphp
                        @foreach($links as $link)
                            <a href="{{ $link['item']['url'] }}" target="{{ $link['item']['target'] }}">
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
                <div class="col-2 col-xxl">
                    {!! App::logo('big', 'print') !!}
                </div>
                <div class="col-2 col-xxl">
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
                <div class="col-2 col-xxl">
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
                <div class="contact-with-us col-2 col-xxl">
                    <h3>{{ get_field('sections', 'options')['contacts']['title'] }}</h3>
                    @php $links = get_field('sections', 'options')['contacts']['links'] @endphp
                    @foreach($links as $link)
                        <a href="{{ $link['item']['url'] }}">
                            {!! $link['item']['title'] !!}
                        </a>
                    @endforeach
                </div>
                <div class="newsletter col-4 col-xxl-5 ">
                    <h3 class="mb-3">{!! get_field('sections', 'options')['newsletter']['title'] !!}</h3>
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
@endif

@include('partials.hidden-menu')

@if( get_field('gift_baskets', 'option') != get_the_ID() )
<script>
	jQuery( "a.woocommerce-LoopProduct-link.woocommerce-loop-product__link" ).css('cursor', 'default');
	jQuery( "a.woocommerce-LoopProduct-link.woocommerce-loop-product__link" ).click(function( event ) {
        event.preventDefault();
        console.log(5);
	});
</script>
@endif
