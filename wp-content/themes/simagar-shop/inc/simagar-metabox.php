<?php 

defined("ABSPATH") || exit("No Access !!!");

add_action('cmb2_admin_init', 'simagar_metaboxes');

function simagar_metaboxes()
{
   $prefix = '_simagar_';
   $page_title_box = new_cmb2_box( array(
         'id' => 'page_title_metabox',
         'title' => 'تنظیمات عنوان برگه',
         'object_types' => array('page',),
         'context' => 'normal',
         'priority' => 'high',
         'show_names' => true,
      ));
   $page_title_box->add_field(array(
        'name' => ' غیرفعال سازی عنوان صفحه',
        'desc' => 'با فعال کردن این گزینه عنوان اختصاصی قالب غیرفعال میشود.',
        'id' => $prefix . 'disable_title',
        'type' => 'checkbox'
     ));

   $product_box = new_cmb2_box( array(
         'id' => 'product_metabox',
         'title' => 'تنظیمات اضافی محصول',
         'object_types' => array('product',),
         'context' => 'normal',
         'priority' => 'high',
         'show_names' => true,
      ));

   $product_box->add_field(array(
        'name' => 'پیشنهاد شگفت انگیز',
        'desc' => 'با فعال کردن این گزینه، محصول در اسلایدر شگفت انگیز مشاهده نمود.',
        'id' => $prefix . 'product_special',
        'type' => 'checkbox'
     ));
     $product_box->add_field(array(
        'name' => 'زیر عنوان',
        'desc' => 'شما میتوانید در این بخش عنوان لاتین محصول را وارد نمایید',
        'id' => $prefix . 'product_subtitle',
        'type' => 'text'
     ));
     $product_box->add_field(array(
        'name' => 'برچسب اورجینال',
        'desc' => 'نمایش برچسب اورجینال محصول',
        'id' => $prefix . 'product_original_label',
        'type' => 'checkbox'
     ));
     $product_box->add_field(array(
        'name' => 'برچسب استوک',
        'desc' => 'نمایش برچسب محصول استوک   ',
        'id' => $prefix . 'product_stock_label',
        'type' => 'checkbox'
     ));
     $product_box->add_field(array(
        'name' => 'تحویل 3 روزه',
        'desc' => 'نمایش برچسب 3 روزه',
        'id' => $prefix . 'product_delivery_3days',
        'type' => 'checkbox'
     ));

     $featurse_box = new_cmb2_box( array(
            'id' => 'product_featurse_metabox',
            'title' => 'ویژگی های محصول',
            'object_types' => array('product',),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
        ));
      $product_featurse_group = $featurse_box->add_field( array(
        'id'          => 'product_featurse_group',
        'type'        => 'group',
        'description' => 'اضافه کردن ویژگی جدید',
        'options'     => array(
            'group_title'   => 'ویژگی ها', 
            'add_button'    => 'ویژگی جدید',
            'remove_button' => 'حذف ویژگی',
            'sortable'      => true,
        ),
    ) );
    $featurse_box->add_group_field($product_featurse_group, array(
      'name' => 'عنوان ویژگی',
      'id' => 'featurse_group_title',
      'type' => 'text'
    ));
}