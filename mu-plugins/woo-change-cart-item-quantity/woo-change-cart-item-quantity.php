<?php
/**
 * Plugin Name: Woocommerce Change Item Quantity AJAX
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: eCommerceAcademy
 * Author URI: http://sholekov.com
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

// Makes sure the plugin is defined before trying to use it
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) )
{
    if ( is_admin() ) {
        add_action( 'wp_ajax_my_frontend_action', 'my_frontend_action' );
        add_action( 'wp_ajax_nopriv_my_frontend_action', 'my_frontend_action' );
        // add_action( 'wp_ajax_my_backend_action', 'my_backend_action' );
    
        function my_frontend_action()
        {
            global $woocommerce;
            $woocommerce->cart->set_quantity($_POST['cart_item_key'], $_POST['cart_item_value']);
            echo 'updated: '. $_POST['cart_item_key']. ' - '. $_POST['cart_item_value'];
            die();
        }

        add_action( 'wp_ajax_remove_item', 'remove_item' );
        add_action( 'wp_ajax_nopriv_remove_item', 'remove_item' );
        function remove_item()
        {
            WC()->cart->remove_cart_item($_POST['cart_item_key']);
            echo 'item removed ';
            die();
        }
    } else {
        // Add non-Ajax front-end action hooks here
    }

    add_filter( 'woocommerce_checkout_cart_item_quantity', 'customizing_checkout_item_quantity', 10, 3);
    function customizing_checkout_item_quantity( $quantity_html, $cart_item, $cart_item_key ) {
        // global $woocommerce;
        // $woocommerce->cart->set_quantity($cart_item_key, '1');
        $cart_item_price = $cart_item['data']->get_price();
        $nonce = wp_create_nonce( 'helloworld' );
        $quantity_html = '
        <script>
            jQuery("#order_review").prepend("<div id=loading><img src=\''.plugin_dir_url( __FILE__ ).'/assets/images/loading.gif\'></div>");
            jQuery(document).ready(function(){
                jQuery(".remove_item").on("click", function(){
                    _this = jQuery(this);
                    jQuery.ajax({
                        type: "post",
                        url: \''.admin_url( 'admin-ajax.php' ).'\',
                        data: {
                            action: \'remove_item\',
                            cart_item_key: $(_this).attr("data-key"),
                        },
                        beforeSend: function() {
                            console.log(\'beforeSend\');
                            jQuery("#loading").show();
                        },
                        complete: function() {
                            console.log(\'removed\');
                            // jQuery("#loading").hide();
                        },
                        success: function(html){
                            console.log(html);
                            removeParamAndRedirect("add-to-cart", location.href);
                        }
                    });
                });

                jQuery("#input_' . $cart_item_key . '").on("blur", function(){
                    _this = jQuery(this);
                    console.log($(_this).val());
                    jQuery.ajax({
                        type: "post",
                        url: \''.admin_url( 'admin-ajax.php' ).'\',
                        data: {
                            action: \'my_frontend_action\',
                            cart_item_key: "' . $cart_item_key . '",
                            cart_item_value: $(_this).val()
                        },
                        beforeSend: function() {
                            jQuery("#loading").show();
                        },
                        complete: function() {
                            // jQuery("#loading").hide();
                        },
                        success: function(html){
                            jQuery("#input_' . $cart_item_key . '").val(jQuery(_this).val());
                            el_add = ".change_quantity_' . $cart_item_key . '.add";
                            el_subtract = ".change_quantity_' . $cart_item_key . '.subtract";
                            if( jQuery(_this).attr("data-action") == "add" ) {
                                jQuery(el_add).attr("data-quantity", parseInt(jQuery(el_add).attr("data-quantity"))+1);
                                jQuery(el_subtract).attr("data-quantity", parseInt(jQuery(el_subtract).attr("data-quantity"))+1);
                            }
                            else if( jQuery(_this).attr("data-action") == "subtract" ) {
                                jQuery(el_add).attr("data-quantity", parseInt(jQuery(el_add).attr("data-quantity"))-1);
                                jQuery(el_subtract).attr("data-quantity", parseInt(jQuery(el_subtract).attr("data-quantity"))-1);
                            }
                            removeParamAndRedirect("add-to-cart", location.href);
                        }
                    });
                });

                jQuery(".change_quantity_' . $cart_item_key . '").on("click", function(){
                    _this = jQuery(this);
                    console.log(jQuery(_this).attr("data-quantity"));
                    jQuery.ajax({
                        type: "post",
                        url: \''.admin_url( 'admin-ajax.php' ).'\',
                        data: {
                            action: \'my_frontend_action\',
                            cart_item_key: jQuery(_this).attr("data-key"),
                            cart_item_value: jQuery(_this).attr("data-quantity")
                        },
                        beforeSend: function() {
                            jQuery("#loading").show();
                        },
                        complete: function() {
                            // jQuery("#loading").hide();
                        },
                        success: function(html){
                            console.log(html)
                            jQuery("#input_' . $cart_item_key . '").val(jQuery(_this).attr("data-quantity"));
                            el_add = ".change_quantity_' . $cart_item_key . '.add";
                            el_subtract = ".change_quantity_' . $cart_item_key . '.subtract";
                            if( jQuery(_this).attr("data-action") == "add" ) {
                                jQuery(el_add).attr("data-quantity", parseInt(jQuery(el_add).attr("data-quantity"))+1);
                                jQuery(el_subtract).attr("data-quantity", parseInt(jQuery(el_subtract).attr("data-quantity"))+1);
                            }
                            else if( jQuery(_this).attr("data-action") == "subtract" ) {
                                jQuery(el_add).attr("data-quantity", parseInt(jQuery(el_add).attr("data-quantity"))-1);
                                jQuery(el_subtract).attr("data-quantity", parseInt(jQuery(el_subtract).attr("data-quantity"))-1);
                            }
                            result = parseFloat(jQuery(".dynamic_price").html()) - parseFloat(jQuery(_this).attr("data-price"));
                            if( Number.isInteger(result) ) {
                                result += ".00";
                            }
                            // console.log( result, parseFloat(jQuery(".dynamic_price").html()), parseFloat(jQuery(_this).attr("data-price")) );
                            // $(".dynamic_price").html( "<strong>"+result+"</strong>" );
                            removeParamAndRedirect("add-to-cart", location.href);
                        }
                    });
                });
            });

            function removeParamAndRedirect(key, sourceURL) {
                var rtn = sourceURL.split("?")[0],
                    param,
                    params_arr = [],
                    queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
                if (queryString !== "") {
                    params_arr = queryString.split("&");
                    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                        param = params_arr[i].split("=")[0];
                        if (param === key) {
                            params_arr.splice(i, 1);
                        }
                    }
                    rtn = rtn + "?" + params_arr.join("&");
                }
                window.location.replace( rtn );
                return rtn;
            }
        </script>
        <style>
            .add,
            .subtract,
            .remove_item {
                cursor: pointer;
            }
        </style>
        <div id="_' . $cart_item_key . '" class="border mr-2 px-2 product-quantity position-relative d-flex justify-content-end align-items-center">
            <div class="current-quantity text-center flex-fill">
                <input id="input_' . $cart_item_key . '" style="font-size:12px; max-width:25px; border-width: 0 !important;" class="m-auto p-0 text-center" type="text" value="' . $cart_item['quantity'] . '">
            </div>
            <div class="change-quantity" class="d-flex flex-column">
                <span class="d-block px-1 add change_quantity_' . $cart_item_key . '" data-price="'.$cart_item_price.'" data-action="add" data-quantity="' . ((int)$cart_item['quantity'] + 1) . '" data-key="' . $cart_item_key . '">+</span>
                <span class="d-block px-1 subtract change_quantity_' . $cart_item_key . '" data-price="'.$cart_item_price.'" data-action="subtract" data-quantity="' . ((int)$cart_item['quantity'] - 1) . '" data-key="' . $cart_item_key . '">-</span>
            </div>
        </div>
        <span class="remove_item" data-key="' . $cart_item_key . '"><i class="fas fa-times"></i></span>
        ';
        return $quantity_html;
    }

} // END is_plugin_active_for_network || is_plugin_active
