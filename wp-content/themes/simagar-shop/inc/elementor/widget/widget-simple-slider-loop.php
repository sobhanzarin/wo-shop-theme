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
    

        }
protected function render() {
    $settings = $this->get_settings_for_display();

    $autoplay  = !empty($settings['autoplay']) ? $settings['autoplay'] : 3000;
    $loop      = $settings['loop'] === 'yes' ? 'true' : 'false';
    $slidesPerView = !empty($settings['slides_per_view']) ? $settings['slides_per_view'] : 1;

    ?>
    
    <div class="swiper simagar-swiper-slider" data-slides="<?php echo esc_attr($slidesPerView) ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-loop="<?php echo esc_attr($loop); ?>">
        <div class="swiper-wrapper">
            <?php foreach ($settings['slides'] as $slide) : ?>
                <div class="swiper-slide">
                    <a href="<?php echo esc_url($slide['link']['url']); ?>" class="slide-item">
                        <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['title'])?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
         <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>  
    </div>
   

    <?php
}


}
