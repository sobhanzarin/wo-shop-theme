<?php

use Elementor\Controls_Manager;

class Simagar_Widget_Heading extends \Elementor\Widget_Base {

    public function get_name(){
        return 'heading-section';
    }

    public function get_title(){
        return 'عنوان سیماگر';
    }

    public function get_icon(){
        return 'eicon-e-heading';
    }

    public function get_categories(){
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'title_section',
            [
                'label' => 'تنظیمات  عنوان سفارشی',
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان آیتم',
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_bold',
            [
               'label' => 'عنوان بولد',
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );


        $this->end_controls_section();

    }

     protected function render() {
        $settings = $this->get_settings_for_display(); 
        ?> 
        <div class="simagar-title-section">
            <?php echo esc_html($settings['title']) ?>
            <span class="bold-title"><?php echo esc_html($settings['title_bold']) ?></span>
        </div>
        <style>
            .simagar-title-section::before{
                content: '';
                display: inline-block;
                width: 35px;
                height: 6px;
                margin-left: 7px;
                background-color: #008ecc;
            }
            span.bold-title{
                font-size: 20px;
                font-weight: 600;
            }
        </style>

    <?php 
    }
}