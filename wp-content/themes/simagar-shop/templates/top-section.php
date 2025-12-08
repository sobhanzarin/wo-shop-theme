<?php 
$post_id = get_the_ID();
$prefix = '_simagar_';
$disable_title = get_post_meta($post_id, $prefix . 'disable_title', true);

if(!$disable_title){ ?>
    <?php if(class_exists("WooCommerce") &&  (is_singular('product')) || is_product_tag() || is_shop() || is_product_category())  :?>
    <div class="woo-brad">
        <div class="container d-flex align-items-center">
            <i class="fal fa-location-dot ms-2"></i>
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </div>
<?php else : ?>
    <div>
         <div class="breadcrumb-section container mb-3">
                <?php bcn_display(); ?>
                <h1 class="main-title">
                    <?php simagar_page_title(); ?>
                </h1>
                <div class="separator-main-title"></div>
        </div>
    </div>
<?php endif; ?>

<?php }