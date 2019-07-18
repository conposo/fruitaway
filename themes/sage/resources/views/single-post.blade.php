@extends('layouts.app-fluid')

@section('content')
  <article id="primary" class="content-area">
    <div class="container-fluid post-bg"></div>
      <div class="container site-content" id="content" role="main">
        <div class="row post-container mx-auto">
          @while(have_posts()) @php the_post() @endphp
            @php the_content() @endphp
          @endwhile
          <div class="col-12 col-md-2 pb-5">
            @include( 'partials.social-sharing' )
          </div>
        </div>
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
