<?php
define("SIMAGAR_THEME_DIR", get_theme_file_path() . '/');
define("SIMAGAR_THEME_URL", get_theme_file_uri() . '/');
require_once(SIMAGAR_THEME_DIR . 'inc/codestar/codestar-framework.php');
require_once(SIMAGAR_THEME_DIR . 'inc/simagar-setting.php');
require_once(SIMAGAR_THEME_DIR . 'inc/post-type/header.php');
require_once(SIMAGAR_THEME_DIR . 'inc/post-type/footer.php');
require_once(SIMAGAR_THEME_DIR . 'inc/post-type/mega-menu.php');
require_once(SIMAGAR_THEME_DIR . 'inc/elementor/simagar-elementor.php');
require_once(SIMAGAR_THEME_DIR . 'inc/simagar-actions.php');
require_once(SIMAGAR_THEME_DIR . 'inc/megamenu/megamenu.php');
require_once(SIMAGAR_THEME_DIR . 'inc/megamenu/mega_menu_custom_walker.php');
require_once(SIMAGAR_THEME_DIR . 'inc/simagar-metabox.php');
require SIMAGAR_THEME_DIR . 'inc/simagar-assets.php';

/* پشتیبانی از تصویر شاخص */
add_theme_support('post-thumbnails');

/* پشتیبانی از فرمت WebP در آپلود */
add_filter('upload_mimes', function($types){
    $types['webp'] = 'image/webp';
    return $types;
});

/* اجازه دادن به وردپرس برای نمایش WebP */
add_filter('file_is_displayable_image', function($result, $path){
    if ($result === false) {
        $info = @getimagesize($path);
        if ($info && $info['mime'] === 'image/webp') {
            return true;
        }
    }
    return $result;
}, 10, 2);

add_action( 'user_new_form', 'my_add_user_phone_field' );
function my_add_user_phone_field( $form_type ) {
    if ( 'add-new-user' !== $form_type ) {
        return;
    }
    ?>
    <h3>اطلاعات تماس</h3>   
    <table class="form-table">
        <tr>
            <th><label for="user_phone">شماره تماس</label></th>
            <td>
                <input type="text" name="user_phone" id="user_phone" value="" class="regular-text" />
                <p class="description">شماره موبایل کاربر را وارد کنید.</p>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'user_register', 'my_save_user_phone_field' );
function my_save_user_phone_field( $user_id ) {
    if ( isset( $_POST['user_phone'] ) ) {
        update_user_meta( $user_id, 'user_phone', sanitize_text_field( $_POST['user_phone'] ) );
    }
}