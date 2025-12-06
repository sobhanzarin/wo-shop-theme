<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class Simagar_Widget_Category_Slides extends \Elementor\Widget_Base {

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
                'selectors' => [
                    '{{WRAPPER}} .category-box' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => 'حاشیه',
                'selectors' => '{{WRAPPER}} .category-box',
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
                'selectors' => [
                    '{{WRAPPER}} .category-box' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selectors' => '{{WRRAPER}} .category-box'
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => 'فاصله داخلی',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
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
                'selectors' => [
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
                'selectors' => [
                    '{{WRAPPER}} .category-box .title-category span' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => 'تایپوگرافی',
                'selectors' => '{{WRAPPER}} .category-box .title-category span',
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
                'selectors' => [
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

    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $terms = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'exclude'    => [], 
    ]); 
    $active_navigation = ($settings['active_navigation'] === 'no') ? false : true;
    $active_pagination = ($settings['active_pagination'] === 'no') ? false : true;
    $active_loop = ($settings['active_pagination'] === 'no') ? false : true;
    ?>
<div class="container">
	<div class="owl-carousel owl-theme simagar-category-shop mb-3" data-slider-items="<?php echo $settings['colums'] ?>" data-navigation="<?php echo $active_navigation ?>" data-pagination="<?php ($settings['active_pagination'] === 'no') ? false : true  ?>" data-loop="<?php echo ($settings['active_loop'] === 'no') ? false : true ?>">
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
