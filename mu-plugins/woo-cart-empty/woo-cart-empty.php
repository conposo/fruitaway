<?php
/**
 * Plugin Name: F4Y Empty Cart Woocommerce
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

    add_action( 'init', function() {
        global $woocommerce;
        if ( isset( $_POST['empty-cart'] ) && $_POST['empty-cart'] !== 'false' && empty($_POST['coupon_code']) ) { 
            $woocommerce->cart->empty_cart();
            $url = $_POST['empty-cart'];            
            if ( filter_var($url, FILTER_VALIDATE_URL) ) {
                if ( wp_redirect( $url ) ) {
                    exit;
                }
            }
        }
    });

}
