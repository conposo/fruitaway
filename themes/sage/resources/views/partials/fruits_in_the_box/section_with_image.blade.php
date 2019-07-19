<div class="my-5 pt-5 info-section-2-col row">
	<figure class="col-12 col-md-6 position-relative">
		@php
		$image_id = $fruits_in_the_box->image;
		@endphp
		{!! wp_get_attachment_image( $image_id, 'full', '', ['class' => ''] ) !!}
	</figure>
	<div class="col-12 col-md-6">
		<h2>{{ $fruits_in_the_box->section_with_image_heading }}</h2>
		{!! $fruits_in_the_box->section_with_image_text !!}
	</div>
</div>