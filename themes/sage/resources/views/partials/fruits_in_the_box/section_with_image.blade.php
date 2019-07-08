
    <div class="row">
        <figure class="col-12 col-md-6 product-img-left position-relative">
            @php
                $image_id = $fruits_in_the_box->image;
            @endphp
            {!! wp_get_attachment_image( $image_id, 'medium', '', ['class' => 'img-responsive'] ) !!}
        </figure>
        <div class="col-12 col-md-6">
            <h2>{{ $fruits_in_the_box->section_with_image_heading }}</h2>
            {!! $fruits_in_the_box->section_with_image_text !!}
        </div>
    </div>
    