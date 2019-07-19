<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap container" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @if( isset($show_testimonials) && $show_testimonials )
      @include('partials.testimonials-carousel')
    @elseif( is_product() )
      @include('partials.testimonials-carousel')
      @php
        do_action('custom_woocommerce_related_product');
      @endphp
    @endif
    @yield('contact_form')
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
