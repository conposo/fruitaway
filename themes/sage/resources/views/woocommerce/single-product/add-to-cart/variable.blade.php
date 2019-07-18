<?php
/**
 * Variable product add to cart
 * 
 * !!! EDITED from developer !!!
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	@if( empty( $available_variations ) && false !== $available_variations )
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	@else
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<?php $sanitized_name = sanitize_title( $attribute_name ); ?>
					<tr>
						<?php
						if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
							$checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
						} elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
							$checked_value = $selected_attributes[ $sanitized_name ];
						} else {
							$checked_value = '';
						}
						$rand_attribute = '_'.rand();
						?>
						<td>
							<div class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( ($attribute_name == 'wines') ? __('Изберете вино:', 'f4y') : $attribute_name ); // WPCS: XSS ok. ?></label></div>
							<div class="value">
								<div class="d-none">
								<?php
									wc_dropdown_variation_attribute_options( array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									) );
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
								?>
								</div>
								<script>
								jQuery(document).on('change', '.choices input', function() {
									console.log(jQuery(this).attr('name'));
								jQuery('select[name="'+jQuery(this).attr('name')+'"]').val(jQuery(this).val()).trigger('change');
								});
								</script>
								<?php
									if ( ! empty( $options ) ) {
										if ( taxonomy_exists( $attribute_name ) ) {
											// Get terms if this is a taxonomy - ordered. We need the names too.
											// $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );

											// foreach ( $terms as $term ) {
											// 	if ( ! in_array( $term->slug, $options ) ) {
											// 		continue;
											// 	}
											// 	print_attribute_radio_or_dropdown( $checked_value, $term->slug, $term->name, $sanitized_name );
											// }
										} else {
											if($product->get_id() == $GLOBALS['the_product_id']):
												?>
												<div class="d-flex justify-content-around choices attribute_<?php echo $rand_attribute; ?>">
													<?php
													foreach ( $options as $option ) {
														App\print_attribute_radio_or_dropdown( $checked_value, $option, $option, $sanitized_name, $available_variations, $rand_attribute );
													}
													?>
												</div>
												<?php
											else:
												?>
												<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
												<script>
												$(document).ready(function(){
													$('.custom-dropdown-toggle span.text').text( $('.dropdown-menu > div:first-child label').text() )
												})
												</script>
												<div class="select-choices attribute_<?php echo $rand_attribute; ?>">
													<div class="dropdown">
														<span class="pl-2 custom-dropdown-toggle d-flex justify-content-between align-items-center" id="dropdownMenuChooseWine" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="text"><?php _e('Избери вино', 'f4y'); ?></span>
															<span class="ml-2 d-flex justify-content-center align-items-center toggle-dropdown">V</span>
														</span>
														<div class="p-0 dropdown-menu" aria-labelledby="dropdownMenuChooseWine">
															<?php
															foreach ( $options as $option ) {
																App\print_attribute_radio_or_dropdown( $checked_value, $option, $option, $sanitized_name, $available_variations, $rand_attribute );
															}
															?>
														</div>
													</div>
												</div>
												<?php
											endif;
										}
									}
									// wc_dropdown_variation_attribute_options( array(
									// 	'options'   => $options,
									// 	'attribute' => $attribute_name,
									// 	'product'   => $product,
									// ) );
									// echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
								?>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="single_variation_wrap d-flex flex-column flex-md-row align-items-center">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	@endif

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
