<?php
add_action('after_setup_theme', 'simagar_after_setup_theme');
function simagar_after_setup_theme(){
    add_theme_support('title-tag');
    add_theme_support('woocommerce');

    register_nav_menus(
        array(
            'main-menu' => 'منو اصلی',
            'phone-menu' => 'منو موبایل'
        )
    );
} 
/**
 * Add a sidebar.
 */
function simagar_widgets_init() {
	register_sidebar( array(
		'name'          => 'سایدبار بلاگ',
		'id'            => 'sidebar-blog',
		'description'   => 'تمامی ویجت هایی که در این بخش قرار دهید در سایدبار صفحه بلاگ قرار میگیرد',
		'before_widget' => '<aside id="%1$s" class="widget widget-item-post %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="simagar-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'سایدبار فروشگاه',
		'id'            => 'sidebar-shop',
		'description'   => 'تمامی ویجت هایی که در این بخش قرار دهید در سایدبار صفحه فروشگاه قرار میگیرد',
		'before_widget' => '<aside id="%1$s" class="widget widget-item-post %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="simagar-widget-title">',
		'after_title'   => '</h3>',
	) );
	
}

add_action( 'widgets_init', 'simagar_widgets_init' );

add_filter( 'woocommerce_add_to_cart_fragments', 'simagar_cart_count_fragments' );
function simagar_cart_count_fragments( $fragments ) {

    ob_start();
    ?>
    <span class="count-cart">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['span.count-cart'] = ob_get_clean();

    return $fragments;
}

