<div class="my-lg-5 pt-lg-5 info-section-2-col row">
	<figure class="col-12 col-lg-6 position-relative d-none d-lg-block">
		@php
		$image_id = $fruits_in_the_box->image;
		@endphp
		{!! wp_get_attachment_image( $image_id, 'full', '', ['class' => ''] ) !!}
	</figure>
	<div class="col-12 col-lg-6 my-md-5 py-md-5">
		<h2 class="mb-5 pb-4">{{ $fruits_in_the_box->section_with_image_heading }}</h2>
		{!! $fruits_in_the_box->section_with_image_text !!}
	</div>
</div>