<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="container">
    <?php do_action( 'woocommerce_before_cart' ); ?>
    <div class="woocommerce-cart-page row my-4">
        <div class="col-12">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                <div class="simagar-cart-holder">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                    $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    
                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        ?>
                                        <div class="simagar-cart-item mb-3 d-flex align-items-center position-relative">
                                            <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">حذف</a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        /* translators: %s is the product name */
                                                        esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                            ?>
                                            <?php 
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    
                                            if ( ! $product_permalink ) {
                                                echo $thumbnail; // PHPCS: XSS ok.
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                            }
                                            ?>

                                            <div class="details d-flex align-items-center justify-content-between w-100 me-4">
                                                <div class="d-flex flex-column">
                                                    <div class="title">
                                                        <?php
                                                            if ( ! $product_permalink ) {
                                                                echo wp_kses_post( $product_name . '&nbsp;' );
                                                            } else {
                                                                /**
                                                                 * This filter is documented above.
                                                                 *
                                                                 * @since 2.1.0
                                                                 */
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                            }

                                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                            // Meta data.
                                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                            // Backorder notification.
                                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="price">
                                                        <?php
                                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="quantity">
                                                        <?php
                                                            if ( $_product->is_sold_individually() ) {
                                                                $min_quantity = 1;
                                                                $max_quantity = 1;
                                                            } else {
                                                                $min_quantity = 0;
                                                                $max_quantity = $_product->get_max_purchase_quantity();
                                                            }

                                                            $product_quantity = woocommerce_quantity_input(
                                                                array(
                                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                    'input_value'  => $cart_item['quantity'],
                                                                    'max_value'    => $max_quantity,
                                                                    'min_value'    => $min_quantity,
                                                                    'product_name' => $product_name,
                                                                ),
                                                                $_product,
                                                                false
                                                            );

                                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                        ?>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                }
                            ?>
                            <div class="simagar-cart-coupun">
                                <?php if ( wc_coupons_enabled() ) { ?>
                                    <div class="coupon">
                                        <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text coupon-code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="apply-coupon button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                    </div>
                                <?php } ?>

                                <button type="submit" class="update-cart button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                <?php do_action( 'woocommerce_cart_actions' ); ?>

                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </div>
                        </div>
                         <div class="wrapp-cart-left col-12 col-md-4 d-flex flex-column">  
                            <div class="simagar-cart-collaterals border-b row d-flex flex-column">
                                    <div class="total-cart col-12 col-md-8 d-flex flex-column w-100">
                                        <span class="title">مجموع کل: </span>
                                        <?php wc_cart_totals_order_total_html(); ?>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

            </form>
        </div>
       
    </div>
    <?php do_action( 'woocommerce_after_cart' ); ?>
</div>


