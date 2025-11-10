<?php
function simagar_header_post_type() {
	register_post_type('simagarheader',
		array(
			'labels'      => array(
				'name'          => 'هدر',
				'singular_name' => 'آیتم هدر',
                'add_new_item' => 'افزودن هدر'
			),
				'public'      => true,
				'has_archive' => true,
                'menu_icon' => SIMAGAR_THEME_URL . 'assets/img/header.svg',
                'rewrite' => array('slug' => 'simagarheader')
		)
	);
}
add_action('init', 'simagar_header_post_type');