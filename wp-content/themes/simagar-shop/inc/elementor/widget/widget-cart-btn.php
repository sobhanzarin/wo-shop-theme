<?php 

class Simagar_Widget_Cart_Btn extends \Elementor\Widget_Base {
    public function get_name(){
        return 'cart-btn';
    }
    public function get_title(){
        return 'دکمه سبد خرید';
    }
    public function get_icon(){
        return 'eicon-cart';
    }
    public function get_categories(){
        return ['simagar-header-widget'] ;
    }
    protected function register_controls() {

        $this->start_controls_section(
            'cart_btn_section',
        [
            'label' => 'تنظیمات دکمه سبد خرید',
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );
        
        $this->add_control(
            'border',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => "گوشه های گرد به پیکسل",
                'placeholder' => 'به پیکسل وراد شود'
            ]
            );
         $this->add_control(
            'back',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => "پس از زمینه"
            ]
            );
        $this->add_control(
            'color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => "رنگ متن"
            ]
            );
        $this->add_control(
            'color-icon',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => "رنگ آیکون"
            ]
            );
        $this->end_controls_section();
    }

	protected function render() {
        $setting = $this->get_settings_for_display();
        ?>
                <a class="me-2 cart-holder" href="" style="border-radius: <?php echo $setting['border'] ?>px; color: <?php echo $setting['color'] ?>; background: <?Php echo $setting['back']?> ">
                    <i class="icon-header fa-regular fa-cart-shopping" style="color: <?php echo $setting['color-icon']?>" ></i>
                </a>
    <?php }
}