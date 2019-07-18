<?php
/**
 * Plugin Name: Remove Product Tabs Woocommerce
 * Description: A plugin that edit some Woocommerce Defaults
 * Version: 0.1
 * Author: I. Sholekov
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
    add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
    function woo_remove_product_tabs( $tabs ) {
        global $product;

        if( $product->has_attributes() && $product->has_weight() || has_term('basket', 'product_cat', $product->get_id()) ) {
            unset( $tabs['description'] );              // Remove the description tab
            unset( $tabs['reviews'] );                  // Remove the reviews tab
            unset( $tabs['additional_information'] );   // Remove the additional information tab
        }

        return $tabs;
    }
}   // END is_plugin_active_for_network || is_plugin_active
    // FOR MORE INFO https://docs.woocommerce.com/document/editing-product-data-tabs/