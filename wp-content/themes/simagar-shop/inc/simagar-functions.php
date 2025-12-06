<?php

if (! defined('ABSPATH')) {
    exit;
}


function simagar_main_menu()
{

    $menu_output = "";

    $main_menu_args = array(
        'theme_location' => 'main-menu',
        'echo' => false,
        'walker' => new simagar_mega_menu_walker(),
    );

    if (has_nav_menu('main-menu')) {
        $menu_output .= '<nav class="simagar-navigation">';
        $menu_output .= wp_nav_menu($main_menu_args);
        $menu_output .= '</nav>';
    } else {
        $menu_output .= '<p>از بخش فهرست های وردپرس یک منوی اصلی ایجاد کنید</p>';
    }

    return $menu_output;


}

function simagar_wishlist_btn($bg = null, $color = null, $radius = null)
{
    $url =  WPcleverWoosw::get_url();

    return '<a href="' . $url . '" class="bookmark-btn ms-3" style="border-radius: ' . $radius . 'px !important; background: ' . $bg . ' !important; color: ' . $color . ' !important"><i class="fal fa-heart"></i></a>';

}


function simagar_is_shop_archive()
{
    return (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_singular('product')));
}

function simagar_timezone_offset($countdowntime)
{
    $timeOffset = 0;
    if (get_option('timezone_string') != '') :
        $timezone = get_option('timezone_string');
        $dateTimeZone = new DateTimeZone($timezone);
        $dateTime = new DateTime("now", $dateTimeZone);
        $timeOffset = $dateTimeZone->getOffset($dateTime);
    else :
        $dateTime = get_option('gmt_offset');
        $dateTime = intval($dateTime);
        $timeOffset = $dateTime * 3600;
    endif;
    $offset = ($timeOffset < 0) ? '-' . gmdate("H:i", abs($timeOffset)) : '+' . gmdate("H:i", $timeOffset);

    $date = date('Y/m/d H:i:s', $countdowntime);
    $date1 = new DateTime($date);
    $cd_date = $date1->format('Y-m-d H:i:s') . $offset;

    return strtotime($cd_date);
}


function simagar_page_title()
{
    $search = get_query_var('s');
    $title = '';


    // If there is a post
    if ((is_home() && !is_front_page()) || (is_page() && !is_front_page()) || is_front_page()) {
        $title = single_post_title('', false);
    }

    if (is_single()) {

        if (get_post_type(get_the_ID()) == 'post') {
            $title = the_title();
        }
    }


    // If there's a category or tag
    if (is_category() || is_tag()) {
        $title = single_term_title('', false);
    }

    // If there's a taxonomy
    if (is_tax()) {
        $term = get_queried_object();
        if ($term) {
            $tax = get_taxonomy($term->taxonomy);
            $title = single_term_title('', false);
        }
    }


    // If it's a search
    if (is_search()) {
        /* translators: 1: separator, 2: search phrase */
        $title = esc_html__('Search Results', 'emperor');
    }

    // If it's a 404 page
    if (is_404()) {
        $title = esc_html__('Page not found', 'emperor');
    }


    echo esc_html($title);

}
// get terms dropdown
function simagar_get_terms_dropdown_array($args = [], $key = 'term_id', $value = 'name')
{
    $options = [];
    $terms = get_terms($args);

    if (is_wp_error($terms)) {
        return [];
    }

    foreach ((array) $terms as $term) {
        $options[$term->{$key}] = $term->{$value};
    }

    return $options;
}

add_filter('body_class', function($classes) {
    if ( !is_user_logged_in() && is_account_page() ) {
        $classes[] = 'not-logged-in';
    }
    return $classes;
});


function simagar_get_terms_select($args)
{
    $terms = get_terms($args);
    $options = [];
    foreach($terms as $term) {
        $options[$term->term_id] = $term->name;
    }
    return $options;

}

function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');
