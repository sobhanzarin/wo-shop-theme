<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

class Simagar_Widget_Simple_Slider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'simple-slider';
    }

    public function get_title() {
        return 'اسلایدر تصویر';
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'simple_slides',
            [
                'label' => 'تنظیمات اسلایدر تصویر',
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

        $this->end_controls_section();
    }
protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
     <div class="owl-carousel owl-theme simagar-simple-slider" data-slider-items="1" data-navigation="true" data-pagination="false" data-loop="true">
           <?php foreach($settings['slides'] as $slide) : ?>
            <a href="<?php echo esc_url($slide['link']['url']); ?>" class="slide-item">
                <img src="<?php echo esc_attr($slide['image']['url']) ?>" alt="<?php echo esc_attr($slide['title']) ?>">
            </a>
           <?php endforeach; ?>
        </div>
    <?php
}


}
