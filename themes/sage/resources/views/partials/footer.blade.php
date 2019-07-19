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
