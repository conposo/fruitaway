<div class="col-6 col-md-3 pb-3">
                                    <div class="post-thumbnail">
                                        <a href="<?php esc_url(the_permalink()) ?>"><?php the_post_thumbnail('delicious-recent-thumbnails') ?></a>
                                    </div>
                                    <div class="pt-content">
                                        <p class="my-2"><?php echo get_the_author_meta('display_name') ?> | <?php echo get_the_date('d.m.Y') ?></p>
                                        <p class="mb-0">
                                            <a href="<?php echo esc_url(the_permalink()) ?>"><?php the_title() ?></a>
                                        </p>
                                    </div>
                                </div>