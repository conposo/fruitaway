<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    
    <!-- Content -->
    <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
      <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <!-- Main Section -->
    <?php if( isset($show_main_section) && $show_main_section ): ?>
    <div class="mb-5 pb-5 container product-det">
      <div class="row pt-5 pb-5">
        <div class="col-12 col-md-6">
          <?php if($main_section->content): ?>
            <?php echo $main_section->content; ?>

          <?php endif; ?>
        </div>
        <div class="col-12 col-md-6 product-special-image">
          <?php if( $images = $main_section->gallery ): ?>
            <div id="carousel_images" class="h-100 carousel carousel-fade slide" data-ride="carousel">
                <script>
                $(document).ready(function(){
                    var lis = ``;
                    $('#woo-product-gallery-carousel > div:first-child').addClass('active');

                    $('#woo-product-gallery-carousel .carousel-item').each(function(i){
                        if(i == 0) active = 'active'; else active = ``;
                        lis += `<li style="width:16px; height:16px;" data-target="#carousel_images" data-slide-to="${i}" class="${active} bg-success mx-2 rounded-circle"></li>`
                    })
                    $('#carousel_images').prepend(`<ol class="carousel-indicators" style="bottom: -100px;">`+lis+`</ol>`)
                })
                </script>
                <figure id="woo-product-gallery-carousel" class="carousel-inner h-100" style="overflow: unset;">
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        ($image === reset($images)) ? $active = 'active' : $active = '';
                      ?>
                      <div class="carousel-item <?php echo e($active); ?>">
                        <?php echo wp_get_attachment_image( $image->ID, 'medium', '', ['class' => 'd-block w-100'] ); ?>

                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </figure>
            </div>
            <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- How work -->
    <?php if( isset($show_how_work) && $show_how_work ): ?>
    <div class="pink-bg how-it-works">
      <div class="container text-center">
        <div class="row pt-5 pb-5">
        <?php if( isset($how_work_header) && $how_work_header ): ?>
          <div class="col-12">
            <h2><?php echo e($how_work_header); ?></h2>
          </div>
        <?php endif; ?>
        <?php if( have_rows('how_work_sections') ): ?>
          <?php while( have_rows('how_work_sections') ): ?> <?php the_row(); ?>
            <div class="col-12 col-md-3">
              <span class="d-block"><?php echo e(get_sub_field('title')); ?></span>
              <?php echo get_sub_field('text'); ?>

            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <!-- no rows found -->
        <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Fruits in the Box -->
    <?php if( isset($fruits_in_the_box) && $fruits_in_the_box ): ?>
      <div class="container">
        <?php if( $fruits_in_the_box->section_with_fruits ): ?>
          <?php echo $__env->make('partials.fruits_in_the_box.section_with_fruits', ['fruits_in_the_box' => $fruits_in_the_box], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if( $fruits_in_the_box->section_with_image ): ?>
          <?php echo $__env->make('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $fruits_in_the_box], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Additional Products -->
    <?php if( isset($show_additional_products) && $show_additional_products ): ?>
    <div class="container text-center">
        <div class="row pt-5 pb-5">
        <?php if( isset($additional_products_header) && $additional_products_header ): ?>
          <div class="mb-3 col-12">
            <h2><?php echo e($additional_products_header); ?></h2>
            <?php echo e($additional_products_description); ?>

          </div>
        <?php endif; ?>
        <?php if( have_rows('items') ): ?>
          <?php while( have_rows('items') ): ?> <?php the_row(); ?>
            <div class="col-12 col-md-3">
                <figure>
                  <?php echo wp_get_attachment_image( get_sub_field('image'), 'thumbnail', '', ['class' => 'img-responsive'] ); ?>

                </figure>
                <?php echo get_sub_field('description'); ?>

            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <!-- no rows found -->
        <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Why to choose Us / same like fruits_in_the_box->section_with_image on Box with Fruits template-->
    <?php if( isset($show_why_to_choose_us) && $show_why_to_choose_us ): ?>
    <div id="why-f4y" class="mb-5 pb-5 container">
      <?php echo $__env->make('partials.fruits_in_the_box.section_with_image', ['fruits_in_the_box' => $section_with_image], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <?php endif; ?>
    
    <!-- Contact Form -->
    <?php if( isset($contact_form_shortcode) && $contact_form_shortcode ): ?>
      <?php $__env->startSection('contact_form'); ?>
        <div id="contact_form" class="d-flex">
          <div class="mx-auto"><?php echo do_shortcode($contact_form_shortcode); ?></div>
        </div>
      <?php $__env->stopSection(); ?>
    <?php endif; ?>

  <?php endwhile; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>