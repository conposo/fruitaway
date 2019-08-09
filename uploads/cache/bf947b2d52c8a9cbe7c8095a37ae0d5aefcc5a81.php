<div style="top:30px;" class="position-sticky">
	<form class="w-100 mx-auto row bg-white woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<div id="order_review" class="border col position-relative">
			<div class="p-2 row shop_table woocommerce-checkout-review-order-table">
				<div class="col">
					<div class="row">
						<div class="px-0 col-6 product-name">
							<?php _e( 'Products', 'woocommerce' ); ?>
						</div>
						<div class="px-0 col-6 d-flex justify-content-between">
							<div class="d-flex justify-content-between w-100">
								<div class="px-0 col-4 product-count text-right">
									<?php _e( 'Count', 'slk' ); ?>
								</div>
								<div class="px-0 col-4 product-price text-right">
									<span class="product-price">
										&nbsp;&nbsp;&nbsp;<?php _e( 'Price', 'woocommerce' ); ?>
									</span>
								</div>
								<div class="px-0 col-4 product-total text-right">
									<?php _e( 'Total', 'woocommerce' ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="border-bottom row ">
						<?php
							do_action( 'woocommerce_review_order_before_cart_contents' );

							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
									<div class="col-12 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										<div class="border-top row">
											<div class="px-0 col-6 product-name">
												<div class="d-flex justify-content-start align-items-center">
													<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
												</div>
											</div>
											<div class="px-0 col-6 d-flex justify-content-between"  style="color:#272727; font-size:12px;">
												<div class="d-flex justify-content-between w-100">
													<!-- count -->
													<div class="px-0 col-4 d-flex align-items-center justify-content-end product-count">
														<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
														<?php // echo wc_get_formatted_cart_item_data( $cart_item ); ?>
													</div>
													<!-- price -->
													<div class="px-0 col-4 d-flex align-items-center justify-content-end product-price">
														<span class="product-price">
															<?php echo $_product->get_price(); ?>
															<?php echo get_woocommerce_currency_symbol(); ?>
														</span>
													</div>
													<!-- total -->
													<div class="px-0 col-4 d-flex align-items-center justify-content-end product-total">
														<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
								}
							}
							do_action( 'woocommerce_review_order_after_cart_contents' );
						?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-6" style="opacity:0; cursor: default;">
					<form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="d-none coupon under-proceed d-flex">
								<label for="" class="d-block">
									<span class="d-block mb-2" style="font-weight: 300; font-size: 13px;">
										<?php esc_attr_e( 'Въведи промокод', 'f4y' ); ?>
									</span>
									<input style="border: 2px solid rgba(238, 238, 238, 1);" type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php //esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
									<button type="submit" style="
background: #FE3E49;
font-size: 13px;
" class="text-dark button apply_coupon text-white" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" >
										<?php //esc_attr_e( 'Apply coupon', 'eca' ); ?>
										<?php _e( 'Приложи', 'f4y' ); ?>
									</button>
								</label>
							</div>
						<?php } ?>
					</form>
				</div>
				<div class="strange-area col-12 col-lg-6 pl-0">
					<style>
					.strange-area {
						font-size: 11px;
					}
					</style>
					<div class="w-100 text-right">
						<div class="d-flex cart-subtotal">
							<div class="w-75  pr-2"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
							<div class="w-25 font-weight-normal"><?php wc_cart_totals_subtotal_html(); ?></div>
						</div>

						<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
							<div class="py-1 my-1 border-top border-bottom d-flex cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
								<div class="w-75  pr-2"><?php _e( 'Coupon Discount', 'eca' ); ?>:</div>
								<div class="w-25 font-weight-normal"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
							</div>
						<?php endforeach; ?>

						<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

							<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

							<?php wc_cart_totals_shipping_html(); ?>

							<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

						<?php endif; ?>

						<?php if($shipping): ?>
							<div class="my-1 py-1 border-top border-bottom d-flex fee">
								<div class="w-75  pr-2"><?php echo e($shipping->label); ?></div>
								<div class="w-25"><?php echo e($shipping->amount); ?></div>
							</div>
						<?php endif; ?>

						<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
							<div class="border-bottom d-flex fee">
								<div class="w-75  pr-2"><?php echo esc_html( $fee->name ); ?></div>
								<div class="w-25"><?php wc_cart_totals_fee_html( $fee ); ?></div>
							</div>
						<?php endforeach; ?>

						<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
							<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
								<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
									<div class="d-flex tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
										<div class="w-50"><?php echo esc_html( $tax->label ); ?></div>
										<div class="w-50"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<div class="d-flex tax-total">
									<div class="w-50"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
									<div class="w-50"><?php wc_cart_totals_taxes_total_html(); ?></div>
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

						<div class="d-flex order-total">
							<div class="w-75  pr-2 font-weight-bold"><?php _e( 'Total', 'woocommerce' ); ?></div>
							<div class="w-25"><?php wc_cart_totals_order_total_html(); ?></div>

							<!-- <span class="dynamic_price"><?php //echo WC()->cart->total; //wc_cart_totals_order_total_html(); ?></span> -->
							<!-- <strong><?php //echo get_woocommerce_currency_symbol(); ?></strong> -->
						</div>

						<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
					</div>

				</div>
				
				<?php do_action( 'woocommerce_after_cart_table' ); ?>
				
			</div>
		</div>

<div class="mt-5 customadditional-button text-center">
	<?php $order_button_text = __( 'ПОРЪЧАЙ >', 'f4y' ); ?>
	<?php echo apply_filters( 'woocommerce_order_button_html', '<a href="'.wc_get_checkout_url().'" class="px-5 btn-deco btn-deco-red button alt px-0" ><span class="position-relative">' . esc_html( $order_button_text ) . '</span></a>' ); // @codingStandardsIgnoreLine ?>
</div>

	</form>
</div>