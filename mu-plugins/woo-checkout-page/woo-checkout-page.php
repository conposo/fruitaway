<?php
/**
 * Plugin Name: F4Y Checkout Page Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: eCommerceAcademy
 * Author URI: http://ecommercebg.com
 * License: GPL2
 */

if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

// __( 'ЗАВЪРШИ ПОРЪЧКАТА >', 'f4y' )
// __('Допълнителна информация', 'f4y')

$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) )
{
    add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );

    add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 ); // Add the payment options form under the "order notes" section
    add_action( 'init' , function() {
        remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 ); // Remove the payment options form from default location
    }, 15 );

    // useless - see payment.php
    // add_filter( 'woocommerce_order_button_text', function(){
    //     return __( 'ЗАВЪРШИ ПОРЪЧКАТА >', 'f4y' );
    // });

    add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
    function custom_override_default_address_fields( $address_fields ) {
        $address_fields['city']['required'] = false;
        $address_fields['address_1']['required'] = false;
        return $address_fields;
    }

    /**
     * Unset fields and change Labels and Priority
     */
    add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');
    function wpb_custom_billing_fields( $fields = array() ) {
        unset($fields['billing_company']);
        unset($fields['billing_address_1']);
        unset($fields['billing_address_2']);
        unset($fields['billing_state']);
        unset($fields['billing_city']);
        // unset($fields['billing_phone']);
        unset($fields['billing_postcode']);
        unset($fields['billing_country']);
        return $fields;
    }

    add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
    function custom_override_checkout_fields( $fields ) {
        unset($fields['shipping']['shipping_first_name']);    
        unset($fields['shipping']['shipping_last_name']);  
        unset($fields['shipping']['shipping_company']);
        // unset($fields['shipping']['shipping_address_1']);
        unset($fields['shipping']['shipping_address_2']);
        // unset($fields['shipping']['shipping_city']);
        unset($fields['shipping']['shipping_postcode']);
        unset($fields['shipping']['shipping_country']);
        unset($fields['shipping']['shipping_state']);
        // unset($fields['order']['order_comments']);

        $fields['shipping']['shipping_address_1']['priority'] = 70;
        $fields['shipping']['shipping_city']['priority'] = 50;
        
        $fields['order']['order_comments']['label'] = __('Допълнителна информация', 'f4y');
        $fields['order']['order_comments']['placeholder'] = '';

        return $fields;
    }

}

/**
 * References
 * 
 * https://docs.woothemes.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
 * 
 */