
    <div class="fruits-in-box">
        
        <div class="mb-3 mb-md-5 pt-5 row">
            <div class=" text-center col-12">
                <h2>{{ $fruits_in_the_box->section_with_fruits_heading }}</h2>
                {!! $fruits_in_the_box->section_with_fruits_text !!}
            </div>
        </div>

        @if( $fruits = $fruits_in_the_box->fruits )
            <div class="mb-5 row">
                @php
                    global $post;
                @endphp

                @foreach( $fruits as $post )
                    @php
                        setup_postdata($post);
                    @endphp
                    <div class="fruit text-center col-4 col-md-2">
                        <div class="mb-4 product-thumbnail">
                            @if ( has_post_thumbnail() )
                                @php the_post_thumbnail( 'additional-product' ); @endphp
                            @endif
                        </div>
                        <p class="title">{!! get_the_title() !!}</p>
                    </div>
                @endforeach

                @php
                    wp_reset_postdata();
                @endphp
            </div>
        @endif
        
    </div>