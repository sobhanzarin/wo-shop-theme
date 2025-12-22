<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class Simagar_Widget_Slider_Loop extends \Elementor\Widget_Base {
    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
        $theme_obj = wp_get_theme();
        $theme_version = $theme_obj->get('Version');
        wp_enqueue_script('simple-slider-loop-swiper', SIMAGAR_THEME_URL . "assets/js/swiper-bundle.min.js", null, $theme_version, true);

        wp_enqueue_style('simple-slider-swiper-bundle', SIMAGAR_THEME_URL . "assets/css/swiper-bundle.min.css");
    }

    public function get_script_depends()
    {
        return ['simple-slider-loop-swiper'];
    }
    public function get_style_depends()
    {
        return ['simple-slider-swiper-bundle'];
    }

    public function get_name() {
        return 'simple-slider-loop';
    }

    public function get_title() {
        return 'اسلایدشو';
    }

    public function get_icon() {
        return 'eicon-carousel-loop';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'simple_slide_loop',
            [
                'label' => 'تنظیمات اسلایدرشو',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => "عنوان",
            ]
        );
        $repeater->add_control(
            'link',
            [
                'type' => Controls_Manager::URL,
                'label' => "لینک",
            ]
        );
        $repeater->add_control(
			'image',
			[
				'label' => 'انتخاب تصویر',
				'type' => Controls_Manager::MEDIA,
                
			]
		);

        $this->add_control(
            'slides',
            [
                'type' => Controls_Manager::REPEATER,
                'label' => 'آیتم‌های اسلایدر',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
            ]
        );
        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => "تعداد ستون",
                'type' => Controls_Manager::NUMBER,
                'default' =>  1,
                'min' => 1,
                'max' => 6,
                'step' => 1,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section',
            [
                'label' => 'تنظیمات اسلایدشو',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => 'تأخیر پخش خودکار (میلی‌ثانیه)',
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => 'حلقه',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'setting_style_arrow',
            [
                'label' => 'استایل کنترل کننده ها',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_background',
            [
                'label' => 'بکگراند',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-prev, {{WRAPPER}} .simagar-swiper-slider .swiper-button-next' => 'background-color: {{VALUE}} !important'
                ]
            ]
        );
        
        $this->add_control(
            'arrow_color',
            [
                'label' => 'رنگ',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-next::after, {{WRAPPER}} .simagar-swiper-slider .swiper-button-prev::after' => 'color: {{VALUE}} !important'
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
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-prev, {{WRAPPER}} .simagar-swiper-slider .swiper-button-next' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-prev, {{WRAPPER}} .simagar-swiper-slider .swiper-button-next' => '
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
                'selectors' => [
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-next' => '
                        font-family: {{FONT_FAMILY}} !important;
                        font-size: {{SIZE}}{{UNIT}} !important;
                        font-weight: {{WEIGHT}} !important;
                        line-height: {{LINE_HEIGHT}}{{UNIT}} !important;
                        letter-spacing: {{LETTER_SPACING}}{{UNIT}} !important;
                    ',
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-prev' => '
                        font-family: {{FONT_FAMILY}} !important;
                        font-size: {{SIZE}}{{UNIT}} !important;
                        font-weight: {{WEIGHT}} !important;
                        line-height: {{LINE_HEIGHT}}{{UNIT}} !important;
                        letter-spacing: {{LETTER_SPACING}}{{UNIT}} !important;
                    ',
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_padding',
            [
                'label' => 'فاصله داخلی',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .simagar-swiper-slider .swiper-button-prev, {{WRAPPER}} .simagar-swiper-slider .swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important'
                ]
            ]
        );

        $this->end_controls_section();
    

        }
protected function render() {
    $settings = $this->get_settings_for_display();

    $autoplay  = !empty($settings['autoplay']) ? $settings['autoplay'] : 3000;
    $loop      = $settings['loop'] === 'yes' ? 'true' : 'false';
    $slidesPerView = !empty($settings['slides_per_view']) ? $settings['slides_per_view'] : 1;

    ?>
    
    <div class="swiper simagar-swiper-slider" data-slides="<?php echo esc_attr($slidesPerView) ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>">
        <div class="swiper-wrapper">
             <?php if(!empty($settings['slides'])): ?>
            <?php foreach ($settings['slides'] as $slide) : ?>
                <div class="swiper-slide">
                    <?php $url = !empty($slide['link']['url']) ? $slide['link']['url'] : '#'; ?>
                    <a href="<?php echo esc_url($url);?>" class="slide-item">
                        <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['title'] ? $slide['title'] : 'slide'); ?>">
                    </a>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
         <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>  
    </div>
   

    <?php
}


}
