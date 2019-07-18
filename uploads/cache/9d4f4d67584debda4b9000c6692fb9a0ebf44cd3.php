<footer class="content-info">
  <div class="container">
  
    <?php dynamic_sidebar('sidebar-footer') ?>
    <div class="row d-flex justify-content-between align-items-center border-top border-bottom pt-3 pb-3">
        <div class="col-12 col-md-6 payment-accept text-center text-md-left">
            <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_1_id'] ); ?>

            <?php echo wp_get_attachment_image( get_field('payment_methods_icons', 'options')['method_2_id'] ); ?>

        </div>
        <div class="col-md-6 d-none d-md-block text-md-right lets-be-friends">
            <p>
                <?php echo e(get_field('social', 'options')['title']); ?>

                <?php $links = get_field('social', 'options')['links'] ?>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($link['item']['url']); ?>">
                        <?php echo $link['item']['title']; ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
        </div>
    </div>

    <div class="row border-bottom py-3">
        <div class="col-6 col-md">
            <?php echo App::logo('big', 'print'); ?>

        </div>
        <div class="col-6 col-md">
            <h3><?php echo e(get_field('sections', 'options')['products']['title']); ?></h3>
            <?php $links = get_field('sections', 'options')['products']['links'] ?>
            <ul>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($link['item']['url']); ?>">
                        <?php echo $link['item']['title']; ?>

                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h3><?php echo e(get_field('sections', 'options')['info']['title']); ?></h3>
            <?php $links = get_field('sections', 'options')['info']['links'] ?>
            <ul>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($link['item']['url']); ?>">
                        <?php echo $link['item']['title']; ?>

                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="contact-with-us col-6 col-md">
            <h3><?php echo e(get_field('sections', 'options')['contacts']['title']); ?></h3>
            <?php $links = get_field('sections', 'options')['contacts']['links'] ?>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link['item']['url']); ?>">
                    <?php echo $link['item']['title']; ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="newsletter col-6 col-md-5 ">
            <h3><?php echo get_field('sections', 'options')['newsletter']['title']; ?></h3>
            <div><?php echo do_shortcode(get_field('sections', 'options')['newsletter']['form']); ?></div>
            <p class="text-center"><?php echo e(get_field('sections', 'options')['newsletter']['promise']); ?></p>
        </div>
    </div>
    <div class="row bottom-line pt-3 pb-3">
        <div class="col d-flex justify-content-between">
            <p>
                <?php echo e(sprintf( get_field('copyright', 'options') , date("Y") )); ?>

                <?php $links = get_field('special_links', 'options') ?>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($link['item']['url']); ?>">
                        <?php echo $link['item']['title']; ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p class="text-right">
                <?php echo get_field('authorship', 'options'); ?>

            </p>
        </div>
    </div>

  </div>
</footer>
