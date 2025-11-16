<?php if(class_exists("WooCommerce") &&  (is_singular('product')) || is_product_tag() || is_product_category()) :?>
    <div class="woo-brad">
        <div class="container d-flex align-items-center">
            <i class="fal fa-location-dot ms-2"></i>
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </div>
<?php else : ?>
    <div>
         <div class="breadcrumb-section p-4 mb-3">
                <?php bcn_display(); ?>
            </div>
    </div>
<?php endif; ?>