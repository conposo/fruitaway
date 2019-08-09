<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div id="carouselExampleCaptions" class="carousel carousel-fade position-relative slide <?php if(!wp_is_mobile()): ?>h-100<?php endif; ?>" data-interval="false" data-ride="carousel"<?php //echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> data-columns="<?php //echo esc_attr( $columns ); ?>" style="__opacity: 0; __transition: opacity .25s ease-in-out;">
	<script>
	jQuery(document).ready(function(){
		var lis = ``;
		jQuery('#woo-product-gallery-carousel > div:first-child').addClass('active');
		if(jQuery('#woo-product-gallery-carousel .carousel-item').length > 1) {
			jQuery('#woo-product-gallery-carousel .carousel-item').each(function(i){
				if(i == 0) active = 'active'; else active = ``;
				lis += `<li
							style="width:16px; height:16px;"
							class="${active} mx-2 rounded-circle"
							data-target="#carouselExampleCaptions"
							data-slide-to="${i}"
							></li>`
			})
			jQuery('#carouselExampleCaptions').prepend(`<ol class="carousel-indicators" style="<?php if(!wp_is_mobile()): ?>bottom: 0-100px;<?php else: ?>top: 100%;<?php endif; ?>">`+lis+`</ol>`)
		}
	})
	</script>
	<figure id="woo-product-gallery-carousel" class="carousel-inner <?php if(!wp_is_mobile()): ?>h-100<?php endif; ?>" style="overflow: unset;">
		<?php
		if ( $product->get_image_id() ) {
			$html = App\custom_wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			// $html  = '<div>';
			// $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			// $html .= '</div>';
			$html = '';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
