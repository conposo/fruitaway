<?php
/**
 * Plugin Name: Edit Woocommerce Defaults
 * Description: Edit Woocommerce Defaults
 * Version: 0.1
 * Author: Sholekov
 * Author URI: http://sholekov.com
 * License: GPL2
 */

/*  Copyright 2019  I.Sholekov  (email : sholeka@gmail.com) */

/**
 * Makes sure the plugin is defined before trying to use it
 */
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) )
{

    /*
    *  Reove wc_add_to_cart_message_html Notice
    */
    add_filter( 'wc_add_to_cart_message_html', function() {
        return;
    });



    /*
    *  Apply Coupon Code & Redirect to Checkout Page
    */
    add_filter( 'woocommerce_applied_coupon', function() {
        global $woocommerce;
        $checkout_url = $woocommerce->cart->get_checkout_url();
        wp_redirect( $checkout_url );
        exit;
    }, 25, 5 );

}