<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';

$order_options = apply_filters( 'woocommerce_catalog_orderby', array(
	'menu_order' => __( 'مرتب سازی:', 'woocommerce' ),
	'date'       => __( 'جدیدترین', 'woocommerce' ),
	'price'      => __( 'ارزان‌ترین', 'woocommerce' ),
	'price-desc' => __( 'گران‌ترین', 'woocommerce' ),
	'rating'     => __( 'بالاترین امتیاز', 'woocommerce' ),
) );
?>

<div class="simagar-orderby mb-4">
	<ul class="d-flex align-items-center">
	<?php foreach ( $order_options as $id => $label ) : 
		$active = $current_orderby === $id ? 'active' : '';
		$url = add_query_arg( 'orderby', $id );
	?>
		<li class="orderby-item <?php echo esc_attr( $active ); ?> ms-3">
			<a href="<?php echo esc_url( $url ); ?>">
				<?php echo esc_html( $label ); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
</div>