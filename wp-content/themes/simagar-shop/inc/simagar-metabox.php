<?php 

defined("ABSPATH") || exit("No Access !!!");

add_action('cmb2_admin_init', 'simagar_metaboxes');

function simagar_metaboxes()
{
    $prefix = '_simagar_';

    $product_box = new_cmb2_box( array(
            'id' => 'product_metabox',
            'title' => 'تنظیمات اضافی محصول',
            'object_types' => array('product',),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
        ));
     $product_box->add_field(array(
        'name' => 'زیر عنوان',
        'desc' => 'شما میتوانید در این بخش عنوان لاتین محصول را وارد نمایید',
        'id' => $prefix . 'product_subtitle',
        'type' => 'text'
     ));
}