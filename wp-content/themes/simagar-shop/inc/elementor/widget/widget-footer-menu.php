<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Simagar_Widget_Footer_Menu extends \Elementor\Widget_Base {

    public function get_name() {
        return 'footer-menu';
    }

    public function get_title() {
        return 'منوی فوتر';
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return ['simagar-footer-widget'];
    }

    protected function register_controls() {

        // Section محتوای منو
        $this->start_controls_section(
            'footer_menu_section',
            [
                'label' => 'تنظیمات منوی فوتر',
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
            'url',
            [
                'type' => Controls_Manager::URL,
                'label' => "لینک",
            ]
        );

        $repeater->add_control(
            'item_icon_class',
            [
                'label' => "آیکن",
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'links',
            [
                'type' => Controls_Manager::REPEATER,
                'label' => 'آیتم‌های منو',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Section استایل منو
        $this->start_controls_section(
            'footer_style_menu',
            [
                'label' => 'استایل آیتم منو',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ متن
        $this->add_control(
            'text_color',
            [
                'label' => 'رنگ متن',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // تایپوگرافی متن
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => 'تایپوگرافی متن',
                'selector' => '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-item a',
            ]
        );

        // رنگ آیکن
        $this->add_control(
            'icon_color',
            [
                'label' => 'رنگ آیکن',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // اندازه آیکن
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => 'اندازه آیکن',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ],
            ]
        );

        // فاصله آیکن از متن
        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => 'فاصله آیکن از متن',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // فاصله بین آیتم‌ها
        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => 'فاصله بین آیتم‌ها',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .simagar-footer-menu .elementor-icon-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="simagar-footer-menu elementor-widget-icon-list">
        <ul class="elementor-icon-list-items">
            <?php foreach ( $settings['links'] as $item ) : ?>

                <li class="elementor-icon-list-item d-flex align-items">

                    <?php
                    // اگر آیکن انتخاب شده بود
                    if ( ! empty( $item['item_icon']['value'] ) ) {

                        $icon_value = $item['item_icon']['value'];

                        echo '<span class="elementor-icon-list-icon">';

                        // اگر آیکن فونت است (مثل FontAwesome) → رشته است
                        if ( is_string( $icon_value ) ) {
                            echo '<i class="' . esc_attr( $icon_value ) . '"></i>';
                        }

                        // اگر آیکن SVG بود → فعلاً نمایش نده (یا بعداً هندل کنیم)
                        // چون SVG یک آرایه است و باعث Array to string می‌شود

                        echo '</span>';
                    }
                    ?>

                    <a href="<?php echo esc_url( $item['url']['url'] ); ?>">
                        <span class="elementor-icon-list-text">
                            <?php echo esc_html( $item['title'] ); ?>
                        </span>
                    </a>

                </li>

            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}


}
