<?php
/**
 * Plugin Name: F4Y Edit Cart Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: eCommerceAcademy
 * Author URI: http://ecommercebg.com
 * License: GPL2
 */

if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) )
{

    add_action( 'woocommerce_before_cart_table', 'change_cart_header', 10 );
    add_action( 'woocommerce_checkout_before_order_review', 'change_cart_header', 10 );
    function change_cart_header(){
        echo '<h2 class="d-flex justify-content-between w-100 _text-uppercase" style="line-height: 1;">';
        echo __('Твоята кошница', 'f4y');
        if(!is_checkout())
        {
            // if() $value = 'false'; else
            $value = get_permalink();
            echo '<input type="hidden" name="empty-cart" value="'.$value.'" />';
            echo '<button type="submit" class="m-0 p-0 btn d-flex align-items-end" style="font-size: 11px;"><i class="fas fa-times text-danger mr-2" style="font-size: 12px;"></i>изтрий всички</button>';
        }
        echo '</h2>';
    }

    /**
     * Add Image for Every Item on Cart
     */
    add_filter( 'woocommerce_cart_item_name', function( $product_name, $cart_item, $cart_item_key ) { 
        $id = ($cart_item["variation_id"]) ? $cart_item["variation_id"] : $cart_item["product_id"];
        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ),'full' );
        $image = '<div style="width: 87px;"><img class="mx-auto my-1 d-block" src="'.$image_url[0].'" style="width: auto; max-height: 87px;"></div>';
        return $image.'<span class="ml-3 d-inline-block" style="color:#272727; font-size:12px;">'.$product_name.'</span>';
    }, 10, 3 );

    add_action( 'woocommerce_after_cart_table', function(){
        echo '<div class="pt-3 pb-2 w-100 text-center" style="font-weight: 300; color:#272727; font-size:10px;">';
        echo 'Всички цени са с включен ДДС';
        echo '</div>';
    }, 10 );

    add_action( 'woocommerce_checkout_after_order_review', function(){
        echo '<div class="pt-3 pb-2 w-100 text-center" style="font-weight: 300; color:#272727; font-size:10px;">';
        echo 'Всички цени са с включен ДДС';
        echo '</div>';
    }, 10 );

}