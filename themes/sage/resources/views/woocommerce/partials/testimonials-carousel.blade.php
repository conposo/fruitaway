
    <div class="testimonials-wrapper mb-5 mb-md-0 py-5 bg-success container-fluid position-relative">
    @php
        $testimonials = App::get(App::testimonialsNumber());
    @endphp

    @if($testimonials->have_posts())
        @if($testimonialsHeader = App::testimonialsHeader())
            <h2 class="mb-5 text-center">{{ $testimonialsHeader }}</h2>
        @endif
        <div class="container">
            <div id="testimonials_carousel" class="pb-5 carousel _carousel-fade slide" data-ride="carousel">
                <ol class="carousel-indicators" style="bottom: -25px;">
                    @for($i = 0; $i < $testimonials->found_posts; $i++)
                        <li style="width:16px; height:16px;" class="@if($i == 0) active @endif mx-2 rounded-circle" data-target="#testimonials_carousel" data-slide-to="{{$i}}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @php $counter = 1; @endphp
                    @while($testimonials->have_posts()) @php $testimonials->the_post(); @endphp
                    <div class="carousel-item @if($counter == 1) active @endif">
                        <div class="row flex-column flex-md-row align-items-center">
                            <div class="pr-0 col-12 col-md-3 text-center text-md-right">
                                @if( $_image = get_post_thumbnail_id( get_the_ID() ) )
                                <figure class="m-0 text-left">
                                    {!! wp_get_attachment_image( $_image, [165, 165], '', ['class' => 'rounded-circle border h-auto'] ) !!}
                                </figure>
                                @endif
                            </div>
                            <div class="pl-0 col-12 col-md-9 d-flex flex-column justify-content-center text-center text-md-left">
                                <p class="order-2 order-md-1">
                                    {!! get_the_content() !!}
                                </p>
                                <h2 class="order-1 order-md-2">
                                    {!! get_the_title() !!}
                                </h2>
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp
                    @endwhile
                    @php wp_reset_postdata(); @endphp
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
    @else
        not has any testimonials
    @endif
    </div>

