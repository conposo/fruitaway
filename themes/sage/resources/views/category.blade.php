@extends('layouts.app-fluid')

@section('content')
  
  <!-- @include('partials.page-header') -->

    <section id="main-content" class="main-content">

        <?php

        ?>
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                @include('partials.header-blog')
                <div class="container">
                    <div class="row pt-5 pb-5">
                        @foreach( ( get_the_category() ) as $category )
                            @php $the_query = Home::the_query($category->category_nicename); @endphp
                            @while ($the_query->have_posts()) @php $the_query->the_post() @endphp
                                <div class="col-6 col-md-3 pb-3">
                                    <div class="post-thumbnail">
                                        <a href="{{esc_url(the_permalink())}}">{{the_post_thumbnail('delicious-recent-thumbnails')}}</a>
                                    </div>
                                    <div class="pt-content">
                                        <p class="my-2">{{get_the_author_meta('display_name')}} | {{get_the_date('d.m.Y')}}</p>
                                        <p class="mb-0">
                                            <a href="{{esc_url(the_permalink())}}">{!! the_title() !!}</a>
                                        </p>
                                    </div>
                                </div>
                            @endwhile
                            @php wp_reset_query() @endphp
                        @endforeach
                    </div>
                </div>



            </div><!-- #content -->
        </div><!-- #primary -->
        <?php //get_sidebar( 'content' ); ?>
    </section><!-- #main-content -->

@endsection
