@extends('layouts.app-fluid')

@section('content')
  
  <!-- @include('partials.page-header') -->

    <section id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                @include('partials.header-blog')
                <div class="container">
                    <div class="row pt-5 _pb-5">
                        @php $the_query = Home::the_query(get_queried_object()->term_id); $posts_ids = ''; @endphp
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
                            @php $posts_ids .= get_the_ID().','; @endphp
                        @endwhile
                        @php wp_reset_query() @endphp
                    </div>
                </div>

                {!! do_shortcode('[ajax_load_more category="'.get_queried_object()->term_id.'" post_format="standard" exclude="'.$posts_ids.'" id="23141325425" container_type="div" max_pages="1" posts_per_page="4" images_loaded="true" button_label="'.__('Load more articles', 'f4y').'"]') !!}

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php //get_sidebar( 'content' ); ?>
    </section><!-- #main-content -->

@endsection
