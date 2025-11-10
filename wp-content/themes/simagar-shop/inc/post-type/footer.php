<?php
function simagar_footer_post_type() {
	register_post_type('simagarfooter',
		array(
			'labels'      => array(
				'name'          => 'فوتر',
				'singular_name' => 'آیتم فوتر',
                'add_new_item' => 'افزودن فوتر'
			),
				'public'      => true,
				'has_archive' => true,
				'menu_icon' => SIMAGAR_THEME_URL .'assets/img/footer.svg',
                'rewrite' => array('slug' => 'simagarfooter')
		)
	);
}
add_action('init', 'simagar_footer_post_type');