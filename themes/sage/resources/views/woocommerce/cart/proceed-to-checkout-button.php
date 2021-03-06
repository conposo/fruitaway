<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// esc_html_e( 'ЗАВЪРШИ ПОРЪЧКАТА >', 'woocommerce' );
$label = __('ЗАВЪРШИ ПОРЪЧКАТА >', 'f4y');
if(get_locale() == 'bg_BG') {
	$label = 'ЗАВЪРШИ ПОРЪЧКАТА >';
}
if(get_locale() == 'en_US') {
	$label = 'Proceed to checkout';
}
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-deco btn-deco-red checkout-button button alt wc-forward">
	<?php //esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
	<span class="position-relative text-uppercase"><?php echo $label ?></span>
</a>
