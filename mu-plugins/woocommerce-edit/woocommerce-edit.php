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

/*
 * Custom Functions for Woo
 */
if ( ! function_exists( 'custom_wc_cart_totals_coupon_html' ) ) {
    function custom_wc_cart_totals_coupon_html( $coupon ) {
        if ( is_string( $coupon ) ) {
            $coupon = new WC_Coupon( $coupon );
        }
    
        $discount_amount_html = '';
    
        $amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
        $discount_amount_html = '-' . wc_price( $amount );
    
        if ( $coupon->get_free_shipping() && empty( $amount ) ) {
            $discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
        }
    
        $discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
        $coupon_html          = $discount_amount_html; // . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', rawurlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '"><i class="fas fa-times text-danger mr-2" style="font-size: 12px;"></i></a>';
    
        echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) ); // phpcs:ignore PHPCompatibility.PHP.NewFunctions.array_replace_recursiveFound

        // return 'custom_wc_cart_totals_coupon_html';
    }
}
}