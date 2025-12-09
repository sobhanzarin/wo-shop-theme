<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class Simagar_Widget_Category_Slides extends \Elementor\Widget_Base {
    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
        $theme_obj = wp_get_theme();
        $theme_version = $theme_obj->get('Version');
        wp_enqueue_script('simple-slider-owl-carousel', SIMAGAR_THEME_URL . "assets/js/owl.carousel.min.js", null, $theme_version, true);

        wp_enqueue_style('simple-slider-owl', SIMAGAR_THEME_URL . "assets/css/owl.carousel.min.css");
        wp_enqueue_style('simple-slider-owl-default', SIMAGAR_THEME_URL . "assets/css/owl.theme.default.css");
    }
    public function get_script_depends()
    {
        return ['simple-slider-owl-carousel'];
    }
    public function get_style_depends()
    {
        return ['simple-slider-owl', 'simple-slider-owl-default'];
    }
    public function get_name() {
        return 'category-slides';
    }

    public function get_title() {
        return 'نمایش اسلایدر دسته بندی محصولات';
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'category_slides_section',
            [
                'label' => 'تنظیمات اسلایدر دسته بندی محصولات',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'colums',
			[
				'type' => Controls_Manager::SELECT,
				'label' => 'تعداد ستون',
				'options' => [
					'1' => 'تک ستونه',
					'2' => 'دو ستونه',
					'3' => 'سه ستونه',
					'4' => 'چهار ستونه',
					'5' => 'پنج ستونه',
					'6' => 'شش ستونه',
				],
				'default' => '4',
			]
		);
        $this->add_control(
			'active_loop',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'فعال کردن حلقه بی نهایت',
				'default' => 'no',
			]
		);
        $this->add_control(
			'active_pagination',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'فعال کردن صفحه بندی',
				'default' => 'no',
			]
		);
        $this->add_control(
			'active_navigation',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'فعال کردن کنترل کننده',
				'default' => 'no',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'slide_category_section',
            [
                'label'=> 'تنظیمات استایل دسته بندی',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_background',
            [
                'label' => 'رنگ بکگراند',
                'type' => Controls_Manager::COLOR,
                'selector' => [
                    '{{WRAPPER}} .category-box' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => 'حاشیه',
                'selector' => '{{WRAPPER}} .category-box',
            ]
        );
        $this->add_control(
            'box_border_radius',
            [
                'label' => 'گردی گوشه ها',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selector' => [
                    '{{WRAPPER}} .category-box' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRRAPER}} .category-box'
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => 'فاصله داخلی',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selector' => [
                    '{{WRAPPER}} .category-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => 'فاصله خارجی',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selector' => [
                    '{{WRAPPER}} .category-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT }}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();

        // استایل عنوان 
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => "استایل عنوان",
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => "رنگ عنوان",
                'type' => Controls_Manager::COLOR,
                'selector' => [
                    '{{WRAPPER}} .category-box .title-category span' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => 'تایپوگرافی',
                'selector' => '{{WRAPPER}} .category-box .title-category span',
            ]
        );

        $this->end_controls_section();

        // استایل تعداد محصولات        
         $this->start_controls_section(
            'count_style_section',
            [
                'label' => 'استایل تعداد محصول',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'count_color',
            [
                'label' => 'رنگ تعداد',
                'type' => Controls_Manager::COLOR,
                'selector' => [
                    '{{WRAPPER}} .category-box .count-product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'label' => 'تایپوگرافی',
                'selector' => '{{WRAPPER}} .category-box .count-product span',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'arrow_style_section',
            [
                'label' => "استایل پیمایش",
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'arrow_background',
            [
                'label' => 'رنگ بکگراند',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-category-shop .owl-prev,{{WRAPPER}} .simagar-category-shop .owl-next' => 'background-color: {{VALUE}} !important'
                ]
            ]
        );
        $this->add_control(
            'arrow_background_hover',
            [
                'label' => 'رنگ هاور بکگراند',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-category-shop .owl-prev:hover,{{WRAPPER}} .simagar-category-shop .owl-next:hover' => 'background-color: {{VALUE}} !important'
                ]
            ]
        );
        $this->add_control(
            'arrow_colors',
            [
                'label' => 'رنگ آیکون',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-category-shop .owl-next span, {{WRAPPER}} .simagar-category-shop .owl-prev span' => 'color: {{VALUE}} !important',
                ]
            ]
        );
        $this->add_control(
            'arrow_color_hover',
            [
                'label' => 'رنگ هاور آیکون',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-category-shop .owl-prev:hover span ,{{WRAPPER}} .simagar-category-shop .owl-next:hover span' => 'color: {{VALUE}} !important'
                ]
            ]
        );
        $this->add_control(
            'arrow_border_radius',
            [
                'label' => 'گردی گوشه ها',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .simagar-category-shop .owl-prev, {{WRAPPER}} .simagar-category-shop .owl-next' => 'border-radius: {{SIZE}}{{UNIT}} !important'
                ]
            ]
        );
    $this->add_control(
        'arrow_size',
        [
            'label' => 'سایز دکمه‌ها',
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .simagar-category-shop .owl-prev, {{WRAPPER}} .simagar-category-shop .owl-next' => '
                    width: {{SIZE}}{{UNIT}} !important;
                    height: {{SIZE}}{{UNIT}} !important;
                '
            ],
        ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'label' => 'تایپوگرافی',
                'selectors' => '{{WRAPPER}} .simagar-category-shop .owl-next span, {{WRAPPER}} .simagar-category-shop .owl-prev span'
            ]
        );

    $this->end_controls_section();



    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $terms = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'exclude'    => [], 
    ]); 
    $is_active_navigation = ($settings['active_navigation'] === 'no') ? false : true;
    $is_active_pagination = ($settings['active_pagination'] === 'no') ? false : true;
    $is_active_loop = ($settings['active_loop'] === 'no') ? false : true;
    ?>
<div class="container">
	<div class="owl-carousel owl-theme simagar-category-shop mb-3" data-slider-items="<?php echo $settings['colums'] ?>" data-navigation="<?php echo $is_active_navigation ?>" data-pagination="<?php echo $is_active_pagination  ?>" data-loop="<?php echo $is_active_loop ?>">
		<?php foreach($terms as $term): ?>
			<?php if($term->slug === 'uncategorized') continue; ?>
			<?php 
				$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
				$image_url = wp_get_attachment_url($thumbnail_id);
			?>
			<div class="category-box d-flex flex-column align-items-center">
				<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($term->name) ?>">
				<div class="title-category my-3">
					<span><?php echo esc_html($term->name) ?></span>
				</div>
				<div class="count-product d-flex align-items-center">
					تعداد محصولات: 
					<span class="d-flex align-items-center justify-content-center me-2">
						<?php echo esc_html($term->count) ?>
					</span>
			    </div>
	</div>
		<?php endforeach; ?>
			
	 	</div>
</div>

 <?php
}


}
