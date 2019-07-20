<?php
/**
 * Plugin Name: F4Y Checkout Custom Fields Woocommerce
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

    /**
     * Add Custom Checkout Fields
     */

    add_action('woocommerce_after_checkout_billing_form', '_custom_checkout_send_as_gift_add_a_message_fields');
    function _custom_checkout_send_as_gift_add_a_message_fields() {
        ?>
        <div>
            <div class="d-flex justify-content-between">
                <label for="send_as_gift" onclick="jQuery('#send_as_gift_wrapper').collapse('toggle')">
                    <span>
                        <input type="checkbox" id="send_as_gift" name="send_as_gift">
                        ИЗПРАТИ КАТО ПОДАРЪК - Получателят ще бъде различен човек
                    </span>
                </label>
                <span class="w-auto" onclick="jQuery('#send_as_gift_more_info').collapse('toggle')"><i class="far fa-question-circle"></i></span>
            </div>
            <div class="collapse multi-collapse _show" id="send_as_gift_more_info">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem assumenda quos ipsum, doloremque dolor eaque quod voluptates obcaecati amet tempora reiciendis, eveniet iste maxime quam unde distinctio adipisci veniam ex.</p>
            </div>
            <div class="collapse multi-collapse _show" id="send_as_gift_wrapper">
                <label for="names">
                    <span class="d-block">Име и Фамилия на получателя на подаръка</span>
                    <input class="d-block w-100" type="text" name="receiver_names">
                </label>
                <label for="phone">
                    <span class="d-block">Телефон на получателя</span>
                    <input class="d-block w-100" type="text" name="receiver_phone">
                </label>
            </div>
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <label for="add_a_message" onclick="jQuery('#add_message_wrapper').collapse('toggle')">
                    <input type="checkbox" id="add_a_message" name="add_a_message">
                    Добави картичка с персонално послание (БЕЗПЛАТНО)
                </label>
                <span class="w-auto" onclick="jQuery('#add_a_message_more_info').collapse('toggle')"><i class="far fa-question-circle"></i></span>
            </div>
            <div class="collapse multi-collapse _show" id="add_a_message_more_info">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem assumenda quos ipsum, doloremque dolor eaque quod voluptates obcaecati amet tempora reiciendis, eveniet iste maxime quam unde distinctio adipisci veniam ex.</p>
            </div>
            <div class="collapse multi-collapse _show" id="add_message_wrapper">
                <span class="d-block">Вашето послание</span>
                <textarea name="message" id="" cols="30" rows="4"></textarea>
            </div>
        </div>
        <?php
    }

    add_action('f4y_print_invoice', '_custom_checkout_invoice_fields');
    function _custom_checkout_invoice_fields() {
        ?>
        <div id="print_invoice" class="mb-5 p-4 checkout-card _border">
            <h3>4. <?php _e('Данни за фактура', 'eca'); ?></h3>
            <?php
            $idonotneedinvoice =  __('Не желая фактура', 'f4y');
            $ineedinvoice =  __('Желая да ми бъде издадена фактура', 'f4y');
            ?>
            <label onclick="jQuery('#multiCollapseExample1').collapse('toggle')" class="my-4 d-flex flex-column align-items-start">
                <span class="d-block">
                    <input value="0" type="radio" id="" class="custom" name="with_invoice" checked>
                    <span class="checkmark mr-2"></span>
                    <?= $idonotneedinvoice; ?>
                </span>
            </label>
            <label onclick="jQuery('#multiCollapseExample1').collapse('toggle')" class="my-4 d-flex flex-column align-items-start">
                <span class="d-block">
                    <input value="1" type="radio" id="" class="custom" name="with_invoice">
                    <span class="checkmark mr-2"></span>
                    <?= $ineedinvoice; ?>
                </span>
            </label>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <?php
                woocommerce_form_field( 'eca_company_name', array(
                    'type'          => 'text',
                    'class'         => array('mb-3 p-0'),
                    'label'         => __('Company name', 'eca'),
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_EIK', array(
                    'type'          => 'text',
                    'class'         => array('mb-3 p-0'),
                    'label'         => __('VAT', 'eca'),
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_address', array(
                    'type'          => 'text',
                    'class'         => array('mb-3 p-0'),
                    'label'         => __('Address', 'eca'),
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_DDS', array(
                    'type'          => 'checkbox',
                    'class'         => array('mb-3 p-0'),
                    'label'         => __('EU VAT identification number', 'eca'),
                    'placeholder'   => __(''),
                    'required'      => true
                ));
                ?>
            </div>
        </div>
        <?php
    }
    


    /**
     * Process the checkout
     */
    // function my_custom_checkout_field_process() {
    //     if ( isset($_POST['eca_get_invoice']) )
    //     {
    //         // Check if set, if its not set add an error.
    //         if ( ! $_POST['eca_company_name'] )
    //             wc_add_notice( __( 'Pleace enter company name.', 'eca' ), 'error' );
    //         if ( ! $_POST['eca_EIK'] )
    //             wc_add_notice( __( 'Pleace enter Company identification number.', 'eca' ), 'error' );
    //         if ( ! $_POST['eca_DDS'] )
    //             wc_add_notice( __( 'Pleace enter EU VAT identification number.', 'eca' ), 'error' );
    //     }
    // }
    // add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');


    /**
     * Save or Update Custom fields
     */
    function save_fields( $order_id ) {
        if ( !empty($_POST['send_as_gift']) && $_POST['send_as_gift'] ) {
            update_post_meta( $order_id, '_order_send_as_gift', sanitize_text_field( $_POST['send_as_gift'] ) );
            update_post_meta( $order_id, '_order_receiver_names', sanitize_text_field( $_POST['receiver_names'] ) );
            update_post_meta( $order_id, '_order_receiver_phone', sanitize_text_field( $_POST['receiver_phone'] ) );
        }
        if ( ! empty( $_POST['message'] ) ) {
            update_post_meta( $order_id, '_order_message', sanitize_text_field( $_POST['message'] ) );
        }
        if ( ! empty( $_POST['with_invoice'] ) ) {
            update_post_meta( $order_id, '_billing_eca_with_invoice', sanitize_text_field( $_POST['with_invoice'] ) );
        }
        if ( ! empty( $_POST['eca_company_name'] ) ) {
            update_post_meta( $order_id, '_billing_eca_company_name', sanitize_text_field( $_POST['eca_company_name'] ) );
        }
        if ( ! empty( $_POST['eca_EIK'] ) ) {
            update_post_meta( $order_id, '_billing_eca_EIK', sanitize_text_field( $_POST['eca_EIK'] ) );
        }
        if ( ! empty( $_POST['eca_address'] ) ) {
            update_post_meta( $order_id, '_billing_eca_address', sanitize_text_field( $_POST['eca_address'] ) );
        }
        if ( ! empty( $_POST['eca_DDS'] ) ) {
            update_post_meta( $order_id, '_billing_eca_DDS', sanitize_text_field( $_POST['eca_DDS'] ) );
        }
    }
    add_action( 'woocommerce_checkout_update_order_meta', 'save_fields' );


    /**
     * Show Fields Saved Data on Admin
     */
    add_action( 'woocommerce_admin_order_data_after_order_details', 'eca_show_order_meta' );
    function eca_show_order_meta( $order )
    {
        $has_gift = get_post_meta( $order->get_id(), '_order_send_as_gift', true );
        if($has_gift):
            ?>
            <br class="clear">
            <h4 style="font-weight:normal;">Send as Gift</h4>
            <b>Names:</b> <?= get_post_meta( $order->get_id(), '_order_receiver_names', true ); ?>
            <br>
            <b>Phone:</b> <?= get_post_meta( $order->get_id(), '_order_receiver_phone', true ); ?>
            <br>
            <b>Messge:</b> <?= get_post_meta( $order->get_id(), '_order_message', true ); ?>
            <?php
        endif;
        $has_invoice = get_post_meta( $order->get_id(), '_billing_eca_with_invoice', true );
        if($has_invoice):
            ?>
            <br class="clear">
            <h4 style="font-weight:normal;">Invoice Data</h4>
            <b>Company name:</b> <?= get_post_meta( $order->get_id(), '_billing_eca_company_name', true ); ?>
            <br>
            <b>EIK:</b> <?= get_post_meta( $order->get_id(), '_billing_eca_EIK', true ); ?>
            <br>
            <b>Address:</b> <?= get_post_meta( $order->get_id(), '_billing_eca_address', true ); ?>
            <br>
            <?php
            if(get_post_meta( $order->get_id(), '_billing_eca_DDS', true )):
                ?>
                Has DDS registration
                <?php
            endif;
        endif;
    }

}
