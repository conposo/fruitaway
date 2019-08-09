{{--
  Template Name: Do It Yourself Template
--}}

@extends('layouts.app-fluid')

@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div class="mb-5 container-fluid bg-success">
    <div class="py-3 container">
      <div class="page-header">
        <span class="h4">{{$sup_header}}</span>
        <h1>{!! App::title() !!}</h1>
      </div>
      @if( isset($categories) && $categories )
        <ul class="border-0 nav nav-tabs" id="myTab" role="tablist">
          @foreach( $categories as $term_id )
            @php $term = get_term_by('id', $term_id->category, 'product_cat'); @endphp
            <li class="nav-item mr-4">
              <a class="px-0 border-0 bg-transparent nav-link <?php if(!isset($active)) $active = 1; if($active++ == 1) echo 'active'; ?>" id="<?= $term->slug ?>-tab" data-toggle="tab" href="#{{ $term->slug }}" role="tab" aria-controls="{{get_term_link( $term )}}" aria-selected="true">
                {{$term->name}}
              </a>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>

  <section class="container mb-5">
    <div class="row">
      <div class="col-12 col-md-6 pl-0">
        <!-- Content -->
        @if( isset($show_the_content_on_screen) && $show_the_content_on_screen )
          @include('partials.page-header')
          @include('partials.content-page')
        @else
          @if( isset($categories) && $categories )
            <div class="tab-content" id="productsTabs">
              @foreach( $categories as $term_id )
                @php $term = get_term_by('id', $term_id->category, 'product_cat'); @endphp
                <div id="{{ $term->slug }}"
                    class="tab-pane fade <?php if(!isset($_active)) $_active = 1; if($_active++ == 1) echo 'active show'; ?>"
                    role="tabpanel" aria-labelledby="{{ $term->slug }}-tab">
                  @php $term = get_term_by('id', $term_id->category, 'product_cat'); @endphp
                  {!! do_shortcode("[products category='$term->slug' columns=3]") !!}
                </div>
              @endforeach
            </div>
          @endif
        @endif
      </div>
      <div class="_pt-5 col-12 col-md-6">
          @include( 'partials.cart' )
      </div>
    </div>
  </section>



  @endwhile
@endsection
