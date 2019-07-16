@extends('layouts.app')

@section('content')
  <article id="primary" class="content-area">
    <div class="container-fluid post-bg"></div>
    <div class="container site-content" id="content" role="main">
      @while(have_posts()) @php the_post() @endphp
        @include('partials.content-single-'.get_post_type())
      @endwhile
      <?php get_template_part( 'templates/partials/social-sharing' ); ?></div></div><!-- Closing Row and Col - View theme-setup -->
    </div><!-- #content -->
    <div class="container-fluid rp-bg">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center pb-5">
                <h2>Подобни статии</h2>
            </div>
            <div class="row">
                @php
                SinglePost::related_posts();
                @endphp
            </div>
        </div>
    </div>
  </article><!-- #primary -->
@endsection
