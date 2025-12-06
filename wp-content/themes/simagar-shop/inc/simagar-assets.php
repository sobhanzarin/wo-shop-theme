<?php 
add_action('wp_enqueue_scripts', 'simagar_enqueue_scripts');
function simagar_enqueue_scripts(){

    $theme_obj = wp_get_theme();
    $theme_version = $theme_obj->get('Version');

     // style 
    wp_enqueue_style('simagar-bootstrap', SIMAGAR_THEME_URL . "assets/css/bootstrap.min.css");
    wp_enqueue_style('simagar-fontawwsome', SIMAGAR_THEME_URL . "assets/css/fontawesome.css");
    wp_enqueue_style('simagar-fontawwsome-light', SIMAGAR_THEME_URL . "assets/css/light.css");
    wp_enqueue_style('simagar-main-style', SIMAGAR_THEME_URL . "assets/css/main.css");
    wp_enqueue_style('simagar-navigation-style', SIMAGAR_THEME_URL . "assets/css/navigation.css");
    wp_enqueue_style('simagar-owl-carousel', SIMAGAR_THEME_URL . "assets/css/owl.carousel.min.css");
    wp_enqueue_style('simagar-owl-carousel-default', SIMAGAR_THEME_URL . "assets/css/owl.theme.default.css");
    wp_enqueue_style('simagar-slick', SIMAGAR_THEME_URL . "assets/css/slick.css");
    wp_enqueue_style('simagar-style', get_stylesheet());

    $font_family = simagar_setting('font-family');
    wp_enqueue_style('simagar-font-family', SIMAGAR_THEME_URL . "assets/fonts/" . $font_family . ".css", null, $theme_version);

    // js
    wp_enqueue_script('simagar-jquery', SIMAGAR_THEME_URL . "assets/js/jquery-3.7.1.min.js", null, true);
    wp_enqueue_script('simagar-popper', SIMAGAR_THEME_URL . "assets/js/popper.min.js", null, $theme_version, true);
    wp_enqueue_script('simagar-owl-carousel', SIMAGAR_THEME_URL . "assets/js/owl.carousel.min.js", null, $theme_version, true);
    wp_enqueue_script('simagar-bootstrap', SIMAGAR_THEME_URL . "assets/js/bootstrap.min.js", null, $theme_version, true);
    wp_enqueue_script('simagar-bootstrap.bundle', SIMAGAR_THEME_URL . "assets/js/bootstrap.bundle.min.js", null, $theme_version, true);
    wp_enqueue_script('simagar-slick', SIMAGAR_THEME_URL . "assets/js/slick.min.js", null, $theme_version, true);
    wp_enqueue_script('simagar-app', SIMAGAR_THEME_URL . "assets/js/app.js", ['jquery'], $theme_version, true);
    wp_localize_script("simagar-app", 'SIMAGAR_DATA', [
        'ajax_url' => admin_url("admin-ajax.php")

    ]);
}