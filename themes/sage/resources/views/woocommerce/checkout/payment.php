<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}

$title = '3. Данни за плащане';
if(get_locale() == 'bg_BG') {
	$title = '3. Данни за плащане';
}
if(get_locale() == 'en_US') {
	$title = '3. Payments data';
}
?>
<div id="payment" class="woocommerce-checkout-payment" style="
    margin-left: -15px;
">
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<div class="mb-5 p-4 bg-success">
			<h3 class="pb-3 border-bottom"><?php echo $title; ?></h3>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
				}
				?>
			</ul>
		</div>
		<?php do_action( 'f4y_print_invoice' ); ?>
	<?php endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
		
		<?php		
		$label = __('ЗАВЪРШИ ПОРЪЧКАТА >', 'f4y');
		if(get_locale() == 'bg_BG') {
			$label = 'ЗАВЪРШИ ПОРЪЧКАТА >';
		}
		if(get_locale() == 'en_US') {
			$label = 'COMPLETE PURCHASE';
		}
		?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '
				<button
					id="place_order"
					class="mt-3 mx-auto btn-deco btn-deco-red button alt"
					type="submit"
					name="woocommerce_checkout_place_order"
					__value="' . $label . '" __data-value="' . $label . '"><span class="position-relative">' . $label . '</span></button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
