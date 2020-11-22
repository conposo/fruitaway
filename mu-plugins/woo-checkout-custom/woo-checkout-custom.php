<?php
/**
 * Plugin Name: F4Y Checkout Custom Fields Woocommerce
 * Description: A plugin that edit Woocommerce Defaults
 * Version: 0.1
 * Author: Sholekov
 * Author URI: http://sholekov.com
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
        $gift_title = 'ИЗПРАТИ КАТО ПОДАРЪК - Получателят ще бъде различен човек';
        $gift_hint = 'Избирайки опцията “ИЗПРАТИ КАТО ПОДАРЪК" имате възможност да укажете друго лице, което да получи доставката, като ние няма да му изпратим никакви документи за плащане, цени на продуктите и т.н.';
        $gift_fields['names'] = 'Име и Фамилия на получателя на подаръка';
        $gift_fields['phone'] = 'Телефон на получателя';

        $card_title = 'Добави картичка с персонално послание (БЕЗПЛАТНО)';
        $card_hint = 'Добавете послание, към вашия подарък. Ние ще го изпишем ръчно върху специална луксозна картичка, която ще прикачим върху вашата кошница.';
        $card_field_label = 'Вашето послание';
        if(get_locale() == 'bg_BG') {
            $gift_title = 'ИЗПРАТИ КАТО ПОДАРЪК - Получателят ще бъде различен човек';
            $gift_hint = 'Избирайки опцията “ИЗПРАТИ КАТО ПОДАРЪК" имате възможност да укажете друго лице, което да получи доставката, като ние няма да му изпратим никакви документи за плащане, цени на продуктите и т.н.';
            $gift_fields['names'] = 'Име и Фамилия на получателя на подаръка';
            $gift_fields['phone'] = 'Телефон на получателя';
            $card_title = 'Добави картичка с персонално послание (БЕЗПЛАТНО)';
            $card_hint = 'Добавете послание, към вашия подарък. Ние ще го изпишем ръчно върху специална луксозна картичка, която ще прикачим върху вашата кошница.';
            $card_field_label = 'Вашето послание';
        }
        if(get_locale() == 'en_US') {
            $gift_title = 'ИЗПРАТИ КАТО ПОДАРЪК - Получателят ще бъде различен човек';
            $gift_hint = 'Избирайки опцията “ИЗПРАТИ КАТО ПОДАРЪК" имате възможност да укажете друго лице, което да получи доставката, като ние няма да му изпратим никакви документи за плащане, цени на продуктите и т.н.';
            $gift_fields['names'] = 'Име и Фамилия на получателя на подаръка';
            $gift_fields['phone'] = 'Телефон на получателя';
            $card_title = 'Добави картичка с персонално послание (БЕЗПЛАТНО)';
            $card_hint = 'Добавете послание, към вашия подарък. Ние ще го изпишем ръчно върху специална луксозна картичка, която ще прикачим върху вашата кошница.';
            $card_field_label = 'Вашето послание';
        }
        ?>
        <div class="border-top">
            <div class="mb-3 pt-3 d-flex justify-content-between">
                <label class="m-0" for="send_as_gift" onclick="jQuery('#send_as_gift_wrapper').collapse('toggle')">
                    <span class="d-flex align-items-center">
                        <input type="checkbox" id="send_as_gift" class="custom" name="send_as_gift">
                        <span class="checkmark custom_checkbox mr-2"></span>
                        <div style="flex-basis: 90%;">
                            <?= $gift_title ?>
                        </div>
                    </span>
                </label>
                <span class="w-auto" onclick="jQuery('#send_as_gift_more_info').collapse('toggle')">
                    <i class="far fa-question-circle"></i>
                </span>
            </div>
            <div class="collapse multi-collapse _show" id="send_as_gift_more_info">
                <p><?= $gift_hint ?></p>
            </div>
            <div class="collapse multi-collapse _show" id="send_as_gift_wrapper">
                <label for="names">
                    <span class="d-block"><?= $gift_fields['names'] ?></span>
                    <input class="d-block w-100" type="text" name="receiver_names">
                </label>
                <label for="phone">
                    <span class="d-block"><?= $gift_fields['phone'] ?></span>
                    <input class="d-block w-100" type="text" name="receiver_phone">
                </label>
            </div>
        </div>
        <div class="border-top">
            <div class="pt-3 d-flex justify-content-between">
                <label class="m-0" for="add_a_message" onclick="jQuery('#add_message_wrapper').collapse('toggle')">
                    <span class="d-flex align-items-center">
                        <input type="checkbox" id="add_a_message" class="custom" name="add_a_message">
                        <span class="checkmark custom_checkbox mr-2"></span>
                        <div style="flex-basis: 90%;">
                            <?= $card_title ?>
                        </div>
                    </span>
                </label>
                <span class="w-auto" onclick="jQuery('#add_a_message_more_info').collapse('toggle')">
                    <i class="far fa-question-circle"></i>
                </span>
            </div>
            <div class="collapse multi-collapse _show" id="add_a_message_more_info">
                <p><?= $card_hint ?></p>
            </div>
            <div class="collapse multi-collapse _show" id="add_message_wrapper">
                <span class="d-block"><?= $card_field_label ?></span>
                <textarea name="message" id="" cols="30" rows="4"></textarea>
            </div>
        </div>
        <?php
    }

    add_action('f4y_print_invoice', '_custom_checkout_invoice_fields');
    function _custom_checkout_invoice_fields() {
        $title = '4. Данни за фактура';
        $Company_name = 'Фирма';
        $VAT = 'ЕИК';
        $Address = 'Адрес';
        $EU_VAT_identification_label = 'Регистрация по ДДС';
        $EU_VAT_identification_number = 'Номер по ЗДДС:';
        if(get_locale() == 'bg_BG') {
            $title = '4. Данни за фактура';
            $idonotneedinvoice =  __('Не желая фактура', 'f4y');
            $ineedinvoice =  __('Желая да ми бъде издадена фактура', 'f4y');
            $Company_name = 'Фирма';
            $VAT = 'ЕИК';
            $Address = 'Адрес';
            $EU_VAT_identification_label = 'Регистрация по ДДС';
        }
        if(get_locale() == 'en_US') {
            $title = '4. Invoice';
            $idonotneedinvoice =  __('I do not need invoice', 'f4y');
            $ineedinvoice =  __('I need invoice', 'f4y');
            $Company_name = 'Company name';
            $VAT = 'VAT';
            $Address = 'Address';
            $EU_VAT_identification_label = 'Has VAT number';
        }
        ?>
        <div id="print_invoice" class="mb-5 p-4 bg-success checkout-card _border">
            <h3 class="pb-3 border-bottom"><?= $title ?></h3>
            <label onclick="jQuery('#multiCollapseExample1').collapse('toggle')" class="my-4 d-flex flex-column align-items-start">
                <span class="d-flex align-items-center">
                    <input value="0" type="radio" id="" class="custom" name="with_invoice" checked>
                    <span class="checkmark mr-2"></span>
                    <?= $idonotneedinvoice; ?>
                </span>
            </label>
            <label onclick="jQuery('#multiCollapseExample1').collapse('toggle')" class="my-4 d-flex flex-column align-items-start">
                <span class="d-flex align-items-center">
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
                    'label'         => $Company_name,
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_EIK', array(
                    'type'          => 'text',
                    'class'         => array('mb-3 p-0'),
                    'label'         => $VAT,
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_address', array(
                    'type'          => 'text',
                    'class'         => array('mb-3 p-0'),
                    'label'         => $Address,
                    'placeholder'   => __(''),
                    'required'      => true
                ));

                woocommerce_form_field( 'eca_DDS', array(
                    'type'          => 'checkbox',
                    'class'         => array('mb-3 p-0'),
                    'label'         => $EU_VAT_identification_label,
                    'placeholder'   => __(''),
                    'required'      => true
                ));
                ?>
                <script>
                    jQuery(document).ready(function(){
                        jQuery('#eca_DDS').addClass('custom')
                        jQuery('#eca_DDS').after('<span class="checkmark custom_checkbox mr-2"></span>')
                    })
                </script>
                <style>
                    
                </style>
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
