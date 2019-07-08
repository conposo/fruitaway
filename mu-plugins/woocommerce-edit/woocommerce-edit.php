<?php
/**
 * Plugin Name: Fruitaway Edit Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: Fruitaway
 * Author URI: http://fruitaway.com
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

// function my_page_template_redirect()
// {
//     if( is_shop() || is_cart() )
//     {
//         wp_redirect( home_url() );
//         die;
//     }
// }
// add_action( 'template_redirect', 'my_page_template_redirect' );

/*
 *  ----------- Checkout ------------
 * 
 *  Checkout page actions and filters
 * 
 *  ---------------------------------
 */



/*
 *
 *  Reove wc_add_to_cart_message_html Notice
 *
 */

 add_filter( 'wc_add_to_cart_message_html', 'remove_add_to_cart_message' );
function remove_add_to_cart_message() {
    return;
}



/*
 *
 *  Move Payment Section
 *
 */

add_action( 'init' , 'eca_remove_checkout_payment' , 15 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 ); // Add the payment options form under the "order notes" section
function eca_remove_checkout_payment()
{
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 ); // Remove the payment options form from default location
}

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' );
function woo_custom_order_button_text() {
    return __( 'COMPLETE YOUR REGISTRATION >', 'eca' ); 
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    // unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    return $fields;
}



/*
 *
 *  Add Confirm Password on some Pages
 *
 */
// ----- add a confirm password fields match on the registration page
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Password Repeat', 'eca' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
}
// ----- validate password match on the registration page
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
// ----- Add a confirm password field to the checkout page
add_action( 'woocommerce_checkout_init', 'lit_woocommerce_confirm_password_checkout', 10, 1 );
function lit_woocommerce_confirm_password_checkout( $checkout ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {

        $fields = $checkout->get_checkout_fields();

        $fields['account']['account_confirm_password'] = array(
            'type'              => 'password',
            'label'             => __( 'Confirm password', 'eca' ),
            'required'          => true,
            'placeholder'       => __( 'Password', 'woocommerce' ) // , 'placeholder'
        );

        $checkout->__set( 'checkout_fields', $fields );
    }
}
// ----- Validate confirm password field match to the checkout page
add_action( 'woocommerce_after_checkout_validation', 'lit_woocommerce_confirm_password_validation', 10, 2 );
function lit_woocommerce_confirm_password_validation( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_confirm_password'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'eca' ), 'error' ); 
        }
    }
}



/*
 *
 *  Apply Coupon Code & Redirect to Checkout Page
 *
 */
add_filter( 'woocommerce_applied_coupon', 'filter_woocommerce_get_shop_coupon_data', 25, 5 );
function filter_woocommerce_get_shop_coupon_data() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    wp_redirect( $checkout_url );
    exit;
}


/*
 *
 *  Redirect to Second ThankYou Page after Checkout
 *
 */
add_action( 'woocommerce_thankyou', 'eca_redirect_to_second_checkout');
function eca_redirect_to_second_checkout( $order_id ){
    $order = new WC_Order( $order_id );
    if ( 'en_US' == get_locale() ) {
        $url = get_home_url().'/checkout-2?language=en_US';
    }
    else
    {
        $url = get_home_url().'/checkout-2';
    }
    
    if ( $order->status != 'failed' ) {
        wp_redirect($url);
        exit;
    }
}

/*
 *
 *  Add Custom Checkout Fields
 *
 */
function eca_custom_checkout_fields( $checkout ) {

    echo '<div id="my_custom_checkout_fields" class="mb-4 checkout-card border"><h3>2. ' . __('Invoice information', 'eca') . '</h3>';

    $ineedinvoice =  __('I need invoice', 'eca');
    echo '
    <label onclick="$(\'#multiCollapseExample1\').collapse(\'toggle\')" class="my-4 d-flex align-items-center">
        <input type="checkbox" id="get_invoice" class="custom" name="eca_get_invoice">
        <span class="checkmark mr-2"></span>
        ' . $ineedinvoice . '
    </label>
    <div class="collapse multi-collapse" id="multiCollapseExample1">
    ';

    woocommerce_form_field( 'eca_company_name', array(
        'type'          => 'text',
        'class'         => array('mb-3 p-0'),
        'label'         => __('Company name', 'eca'),
        'placeholder'   => __(''),
        'required'      => true
        ), $checkout->get_value( 'eca_company_name' ));

    woocommerce_form_field( 'eca_EIK', array(
        'type'          => 'text',
        'class'         => array('mb-3 p-0'),
        'label'         => __('VAT', 'eca'),
        'placeholder'   => __(''),
        'required'      => true
        ), $checkout->get_value( 'eca_EIK' ));

    woocommerce_form_field( 'eca_DDS', array(
        'type'          => 'text',
        'class'         => array('mb-3 p-0'),
        'label'         => __('EU VAT identification number', 'eca'),
        'placeholder'   => __(''),
        'required'      => true
        ), $checkout->get_value( 'eca_DDS' ));

    echo '
    </div>
    </div>';

}
add_action( 'woocommerce_after_checkout_registration_form', 'eca_custom_checkout_fields' );

/**
 * Process the checkout
 */
function my_custom_checkout_field_process() {
    if ( $_POST['eca_get_invoice'] )
    {
        // Check if set, if its not set add an error.
        if ( ! $_POST['eca_company_name'] )
            wc_add_notice( __( 'Pleace enter company name.', 'eca' ), 'error' );
        if ( ! $_POST['eca_EIK'] )
            wc_add_notice( __( 'Pleace enter Company identification number.', 'eca' ), 'error' );
        if ( ! $_POST['eca_DDS'] )
            wc_add_notice( __( 'Pleace enter EU VAT identification number.', 'eca' ), 'error' );
    }
}
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

/**
 * Save/Update Custom fields to the checkout
 */
function my_custom_checkout_field_update_order_meta( $order_id ) {
    $user_id = get_current_user_id();
    if ( ! empty( $_POST['eca_company_name'] ) ) {
        update_post_meta( $order_id, '_billing_eca_company_name', sanitize_text_field( $_POST['eca_company_name'] ) );
        update_user_meta( $user_id, '_billing_eca_company_name', sanitize_text_field( $_POST['eca_company_name'] ) );
    }
    if ( ! empty( $_POST['eca_EIK'] ) ) {
        update_post_meta( $order_id, '_billing_eca_EIK', sanitize_text_field( $_POST['eca_EIK'] ) );
        update_user_meta( $user_id, '_billing_eca_EIK', sanitize_text_field( $_POST['eca_EIK'] ) );
    }
    if ( ! empty( $_POST['eca_DDS'] ) ) {
        update_post_meta( $order_id, '_billing_eca_DDS', sanitize_text_field( $_POST['eca_DDS'] ) );
        update_user_meta( $user_id, '_billing_eca_DDS', sanitize_text_field( $_POST['eca_DDS'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );


add_action( 'woocommerce_admin_order_data_after_order_details', 'eca_show_order_meta' );
function eca_show_order_meta( $order ){  ?>
 
		<br class="clear" />
		<h4 style="font-weight:normal;">Invoice Data</h4>
		<?php 
            echo '<b>Company:</b> ' . get_post_meta( $order->id, '_billing_eca_company_name', true );
            echo '<br>';
			echo '<b>EIK:</b> ' . get_post_meta( $order->id, '_billing_eca_EIK', true );
            echo '<br>';
			echo '<b>DDS:</b> ' . get_post_meta( $order->id, '_billing_eca_DDS', true );
}
