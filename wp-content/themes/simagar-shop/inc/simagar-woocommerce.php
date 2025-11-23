<?php 

defined("ABSPATH") || exit("No Access !!!");

add_action('init', 'simagar_woo_single_product');

function simagar_woo_single_product()
{
    add_action('woocommerce_single_product_summary', 'simagar_product_features', 15);
}
function simagar_product_features()
{
    $prefix = '_simagar_';
    $original_label = get_post_meta(get_the_ID(), $prefix . 'product_original_label', true);
    $stock_label = get_post_meta(get_the_ID(), $prefix . 'product_stock_label', true);
    $delivery_3days_label = get_post_meta(get_the_ID(), $prefix . 'product_delivery_3days', true);
    $featurse_list = get_post_meta(get_the_ID(), 'product_featurse_group', true);
    global $product;
    ?>
    <div class="product_meta_box d-flex align-items-center justify-content-between">
       <div>
            <?php if($original_label) : ?>
                <span class="product_meta_item ms-3">
                    <i class="fa-sharp fa-solid fa-badge-check"></i>
                    محصول اورجینال
                </span>
            <?php endif; ?>
            <?php if($stock_label) :  ?>
                <span class="product_meta_item">
                    <i class="fa-sharp fa-solid fa-badge-check"></i>
                    محصول استوک
                </span>
            <?php endif; ?>
       </div>
        <div>
            <?php echo wc_get_product_category_list($product->get_id(), ',', '<div class="simagar-product-category d-flex flex-column align-items-center"><div class="title_category mb-2"><i class="fal fa-archive ms-2"></i><span>دسته بندی</span></div><span>', '</span></div>') ?>
        </div>
       
    </div>
    <?php if($delivery_3days_label) : ?>
        <div class="delivery-alert d-flex align-items-center mb-3">
            <i class="fal fa-truck-couch ms-3"></i>
            <div class="d-flex flex-column justify-content-center">
                <span class="title">ارسال 3 روزه</span>
                <span class="content">محصول حداکثر تا 4 روز تحویل می شود.</span>
            </div>
        </div>
    <?php endif; ?>

    <?php if($featurse_list) : ?>

        <div class="row product-featurse-list my-4">
            <div class="title">
                ویژگی محصول
            </div>
            <div class="col-12 col-md-6">
                    <?php foreach($featurse_list as $key => $value) : ?>
                    <?php if($key <= 3) : ?>
                        <ul>
                            <li class="mb-3">
                                <?php echo esc_html($value['featurse_group_title']) ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <div class="col-12 col-md-6">
                <?php foreach($featurse_list as $key => $value) : ?>
                    <?php if($key > 3) : ?>
                        <ul>
                            <li class="mb-3">
                                <?php echo esc_html($value['featurse_group_title']) ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>
    

    <?php 
}
add_action('woocommerce_before_quantity_input_field', 'simagar_display_quantity_plus');
function simagar_display_quantity_plus()
{
    echo '<button type="button" class="plus">+</button>';
}
add_action('woocommerce_after_quantity_input_field', 'simagar_display_quantity_minus');
function simagar_display_quantity_minus()
{
    echo '<button type="button" class="minus">-</button>';
}
add_action('wp_footer', 'cxc_cart_refresh_update_qty', 20);
function cxc_cart_refresh_update_qty()
{
    if (is_cart() || (is_cart() && is_checkout())) {
        ?>
		<script>
			jQuery( function( $ ) {

				let timeout;
				jQuery('.woocommerce').on('change', 'input.qty', function(){
                    $('.update-cart').attr("disabled", false);
                  
					if ( timeout !== undefined ) {
						clearTimeout( timeout );
					}
					timeout = setTimeout(function() {
						jQuery("[name='update_cart']").trigger("click");
                         // trigger cart update
					}, 1000 ); // 1 second delay, half a second (500) seems comfortable too
				});
			} );
		</script>
		<?php
    }
}