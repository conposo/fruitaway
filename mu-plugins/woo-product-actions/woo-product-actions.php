<?php
/**
 * Plugin Name: F4Y Product Actions Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: eCommerceAcademy
 * Author URI: http://ecommercebg.com
 * License: GPL2
 */

/*  Copyright 2019  I.Sholekov  (email : sholeka@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) )
{
    function red( $evolve_woocommerce_after_single_product_summary )
    {
        if( get_field('whats_inside_description') ):
        ?>
        <div class="container mt-md-5 p-5 w-100 text-center whats_inside">
            <h3 class="mt-md-5 pt-5"><?php echo get_field('whats_inside_title'); ?></h3>
            <p><?php echo get_field('whats_inside_description'); ?></p>
            <div class="row justify-content-center">
                <?php
                if( have_rows('products') ):
                    while ( have_rows('products') ) : the_row();
                        $image_id = get_sub_field('image');
                        ?>
                        <div class="col-6 col-md-2">
                        <?php echo wp_get_attachment_image( $image_id, 'thumbnail', "", array( "class" => "img-responsive" ) ); ?>
                        <span class="d-block description"><?php the_sub_field('description'); ?></span>
                        </div>
                    <?php
                    endwhile;
                else :
                // no rows found
                endif;
                ?>
            </div>
        </div>
        <div class="container w-100 text-center package">
            <h3 class="mt-md-5 pt-5"><?php echo get_field('package_title'); ?></h3>
            <p><?php echo get_field('package_description'); ?></p>
            <div class="row justify-content-md-center">
                <?php
                if( have_rows('package') ):
                    while ( have_rows('package') ) : the_row();
                        $image_id = get_sub_field('image');
                        ?>
                        <div class="col-6 col-md-2">
                        <?php if(get_sub_field('flip')) : ?>
                            <?php $image_flipped_side = get_sub_field('image_flipped_side'); ?>
                            <style>
                            .flip-card {
                            background-color: transparent;
                            perspective: 1000px;
                            }

                            .flip-card-inner {
                            position: relative;
                            width: 100%;
                            height: 100%;
                            text-align: center;
                            transition: transform 0.6s;
                            transform-style: preserve-3d;
                            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                            }

                            .flip-card:hover .flip-card-inner {
                            transform: rotateY(180deg);
                            }

                            .flip-card-front, .flip-card-back {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            backface-visibility: hidden;
                            }

                            .flip-card-front {
                            background-color: #bbb;
                            color: black;
                            }

                            .flip-card-back {
                            background-color: #2980b9;
                            color: white;
                            transform: rotateY(180deg);
                            }
                            </style>
                            <div>
                                <div class="flip-card">
                                    <div class="flip-card-inner">
                                        <div class="flip-card-front">
                                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'thumbnail' ); ?>" >
                                        </div>
                                        <div class="flip-card-back">
                                            <img src="<?php echo wp_get_attachment_image_url( $image_flipped_side, 'thumbnail' ); ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div style="opacity:0; position:relative; z-index:-1;"><img src="<?php echo wp_get_attachment_image_url( $image_id, 'thumbnail' ); ?>" ></div>
                            </div>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image( $image_id, 'thumbnail', "", array( "class" => "img-responsive" ) ); ?>
                        <?php endif; ?>
                        <span class="d-block description"><?php the_sub_field('description'); ?></span>
                        </div>
                    <?php
                    endwhile;
                else :
                // no rows found
                endif;
                ?>
            </div>
        </div>
        <?php
        endif;
    };
    add_action( 'woocommerce_after_single_product_summary', 'red', 10, 2 ); 

}