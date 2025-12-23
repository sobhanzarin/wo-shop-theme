<?php
/**
 * Product Grid Item Template
 *
 * Used for widgets, sliders and custom product grids
 */

defined( 'ABSPATH' ) || exit;

global $product;

// اطمینان از معتبر بودن محصول
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php wc_product_class( 'product-grid-item', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>

	<div class="product-thumb">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</div>

	<div class="product-content">

		<?php
		// دسته‌بندی محصول
		echo wc_get_product_category_list(
			$product->get_id(),
			', ',
			'<span class="product-category">',
			'</span>'
		);
		?>

		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item_title
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>

	</div>

</li>
