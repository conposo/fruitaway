<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>

  <div class="mb-5 container-fluid bg-success">
    <div class="py-3 container">
      <div class="page-header">
        <span class="h4"><?php echo e($sup_header); ?></span>
        <h1><?php echo App::title(); ?></h1>
      </div>
      <?php if( isset($categories) && $categories ): ?>
        <ul class="border-0 nav nav-tabs" id="myTab" role="tablist">
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
            <li class="nav-item mr-4">
              <a class="px-0 border-0 bg-transparent nav-link <?php if(!isset($active)) $active = 1; if($active++ == 1) echo 'active'; ?>" id="<?= $term->slug ?>-tab" data-toggle="tab" href="#<?php echo e($term->slug); ?>" role="tab" aria-controls="<?php echo e(get_term_link( $term )); ?>" aria-selected="true">
                <?php echo e($term->name); ?>

              </a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <section class="container mb-5">
    <div class="row">
      <div class="col-12 col-md-6 pl-0">
        <!-- Content -->
        <?php if( isset($show_the_content_on_screen) && $show_the_content_on_screen ): ?>
          <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
          <?php if( isset($categories) && $categories ): ?>
            <div class="tab-content" id="productsTabs">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
                <div id="<?php echo e($term->slug); ?>"
                    class="tab-pane fade <?php if(!isset($_active)) $_active = 1; if($_active++ == 1) echo 'active show'; ?>"
                    role="tabpanel" aria-labelledby="<?php echo e($term->slug); ?>-tab">
                  <?php $term = get_term_by('id', $term_id, 'product_cat'); ?>
                  <?php echo do_shortcode("[products category='$term->slug' columns=3]"); ?>

                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="_pt-5 col-12 col-md-6">
          <?php echo $__env->make( 'partials.cart' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </div>
  </section>



  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>