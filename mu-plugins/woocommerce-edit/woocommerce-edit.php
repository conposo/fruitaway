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
    * 
    */
    add_filter('woocommerce_product_single_add_to_cart_text', function() {
        return __('Поръчай', 'woocommerce');
    });
    /*
    * 
    */
    // add_filter( 'woocommerce_loop_add_to_cart_link', function( $button, $product  ) {
    //     global $product;
    //     var_dump( is_product_tag( 'gift' ), get_the_ID() );
    //     if( false || is_product_tag( 'gift-basket' ) || false || basename(get_page_template()) == 'template-gift-baskets.blade.php' )
    //     {
    //         $button_text = __('Виж повече >', 'f4y');
    //         $button = '<a class="button" href="' . $product->get_permalink() . '">' . $button_text . '</a>';
    //     }
    //     return $button;
    // }, 10, 2 );


    add_filter( 'woocommerce_get_price_html', function ( $price, $instance ){
        // var_dump(get_field('gift_baskets', 'option'), $instance->is_type( 'variation' ), $instance->get_type(), $instance->is_type( 'variable' ));
        if( $instance->is_type( 'variable' ) )
        {
            $is_default_variation = false;
            $default_attributes = $instance->get_default_attributes();
            foreach($instance->get_available_variations() as $variation_values ){
                foreach($variation_values['attributes'] as $key => $attribute_value ){
                    $attribute_name = str_replace( 'attribute_', '', $key );
                    $default_value = $instance->get_variation_default_attribute($attribute_name);
                    if( $default_value == $attribute_value ){
                        $is_default_variation = true;
                    } else {
                        $is_default_variation = false;
                        break; // Stop this loop to start next main lopp
                    }
                }
                if( $is_default_variation ){
                    $variation_id = $variation_values['variation_id'];
                    break; // Stop the main loop
                }
            }
    
            // Now we get the default variation data
            if( $is_default_variation ){
                $default_variation = wc_get_product($variation_id);
                $price = $default_variation->get_price_html();
            }
        } // ref for this if() - https://stackoverflow.com/questions/47727653/get-the-product-variation-related-to-default-attribute-values-in-woocommerce
        else if ( !is_admin() && !is_page(get_field('gift_baskets', 'option')) && $instance->is_type( 'variation' ) )
        {
            $price = '<span class="d-block price-label">'.__('Цена', 'f4y').'</span>' . $price;
        }
        return apply_filters( 'woocommerce_get_price', $price );
    }, 100, 2 );
}