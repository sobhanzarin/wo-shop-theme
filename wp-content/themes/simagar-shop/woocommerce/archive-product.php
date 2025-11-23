<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?> 
<div class="simagar-archiv-products mb-5">
	<div class="container">
		<?php if(woocommerce_product_loop()) :  ?>
		<div class="row">
			<div class="d-flex align-items-center justify-content-end">
						<?php 
						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked woocommerce_output_all_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						remove_action('woocommerce_before_shop_loop','woocommerce_output_all_notices', 10);
						remove_action('woocommerce_before_shop_loop','woocommerce_result_count', 20);
						do_action( 'woocommerce_before_shop_loop' );
						?>

					</div>
			<div class="sidebar-shop col-12 col-md-3">
				<?php dynamic_sidebar('sidebar-shop') ?>
			</div>
			<div class="col-12 col-md-9">
				<div class="simagar-notices-shop">
					<?php woocommerce_output_all_notices(); ?>
				</div>
					
				<?php 
				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );
						?>
								<div class="col-12 col-md-4">
									<?php wc_get_template_part( 'content', 'product' ); ?>
								</div>
						<?php		
					}
				}

				woocommerce_product_loop_end();
				?>

				<div>
					<?php
					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
					?>
				</div>
				</div>
			</div>
		</div>
		<?php else :?>
			<?php 
			/**
			* Hook: woocommerce_no_products_found.
			*
			* @hooked wc_no_products_found - 10
			*/
			do_action( 'woocommerce_no_products_found' );
			?>
		<?php endif; ?>
	</div>

</div>


<?php
get_footer( 'shop' );
