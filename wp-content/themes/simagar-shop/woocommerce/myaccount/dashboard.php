<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="simagar-profile-badges mb-4">
	<div class="row">
		<div class="col-6 col-md-3">
			<div class="badges-item d-flex align-items-center">
				<i class="fal fa-box"></i>
				<div class="d-flex flex-column me-2">
					<span class="value mb-2"><?php echo wp_count_posts('product')->publish; ?></span>
					<span>تعداد کل محصولات</span>
				</div>
			</div>
		</div>
			<div class="col-6 col-md-3">
			<div class="badges-item d-flex align-items-center">
				<i class="fal fa-box"></i>
				<div class="d-flex flex-column me-2">
					<?php
						// GET USER ORDERS (COMPLETED + PROCESSING)
						$customer_orders = get_posts(array(
							'numberposts' => -1,
							'meta_key' => '_customer_user',
							'meta_value' => $current_user->ID,
							'post_type' => wc_get_order_types(),
							'post_status' => array('wc-completed'),
						));


						// LOOP THROUGH ORDERS AND GET PRODUCT IDS
						$product_ids = array();
						foreach ($customer_orders as $customer_order) {
							$order = new WC_Order($customer_order->ID);
							$items = $order->get_items();
							foreach ($items as $item) {
								$product_id = $item->get_product_id();
								$product_ids[] = $product_id;
							}
						}
						$product_ids = array_unique($product_ids);

						// QUERY PRODUCTS
						$args = array(
							'post_type' => 'product',
							'post__in' => $product_ids,
						);
						?>
					<span class="value mb-2"><?php echo count($product_ids); ?></span>
					<span>محصولات خریداری شده</span>
				</div>
			</div>
		</div>
			<div class="col-6 col-md-3">
			<div class="badges-item d-flex align-items-center">
				<i class="fal fa-box"></i>
				<div class="d-flex flex-column me-2">
					<span class="value mb-2">
						<?php echo WC()->cart->get_cart_contents_count(); ?>
					</span>
					<span>در انتظار پرداخت</span>
				</div>
			</div>
		</div>
			<div class="col-6 col-md-3">
			<div class="badges-item d-flex align-items-center">
				<i class="fal fa-box"></i>
				<div class="d-flex flex-column me-2">
					<span class="value mb-2">
						<?php echo woo_wallet()->wallet->get_wallet_balance(get_current_user()) ?>
					</span>
					<span>موجودی کیف پول</span>
				</div>
			</div>
		</div>
	</div>
</div>

<p>
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	if ( wc_shipping_enabled() ) {
		/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	}
	printf(
		wp_kses( $dashboard_desc, $allowed_html ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
