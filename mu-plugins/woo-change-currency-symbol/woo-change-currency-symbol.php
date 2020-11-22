<?php
/**
 * Plugin Name: F4Y Change Currency Symbol Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: Sholekov
 * Author URI: http://sholekov.com
 * License: GPL2
 */

/*  Copyright 2019  I.Sholekov  (email : sholeka@gmail.com) */


/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    if(get_locale() == 'en_US') {
        $currency_symbol = __('BGN', 'f4y');
        switch( $currency ) {
             case 'BGN': $currency_symbol = 'BGN'; break;
        }
    }
    return $currency_symbol;
}