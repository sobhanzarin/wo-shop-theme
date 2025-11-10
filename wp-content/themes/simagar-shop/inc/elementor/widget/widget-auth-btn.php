<?php 

class Simagar_Widget_Auth_Btn extends \Elementor\Widget_Base {
    public function get_name(){
        return 'auth-btn';
    }
    public function get_title(){
        return 'دکمه حساب کاربری';
    }
    public function get_icon(){
        return 'eicon-user-circle-o';
    }
    public function get_categories(){
        return ['simagar-header-widget'] ;
    }
    protected function register_controls() {

        $this->start_controls_section(
            'auth_btn_section',
        [
            'label' => 'تنظیمات دکمه حساب کاربری',
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

        $this->end_controls_section();
    }

	protected function render() {
        $setting = $this->get_settings_for_display();
        $header_type = simagar_setting('header-type');
        $auth_btn_link = simagar_setting('auth-btn-link');
        $auth_btn_type = simagar_setting('auth-btn-type');
        $auth_btn_text = simagar_setting('auth-btn-text');
        $account_link = get_permalink(get_option("woocommerce_myaccount_page_id"));
        ?>
                <?php if($auth_btn_type == 'link'): ?>
                          <!-- check login user  -->
                        <?php if(is_user_logged_in()): ?>
                            <a class="auth-holder" href="<?php echo esc_url($account_link);?>" style="border-radius: <?php echo $setting['border'] ?>px; color: <?php echo $setting['color'] ?>; background: <?Php echo $setting['back'] ?> ">
                                <i class="icon-header fa-regular fa-user"></i>
                               حساب کاربری
                            </a>
                        <?php else: ?>
                            <a class="auth-holder" href="<?php echo esc_attr($auth_btn_link); ?>" style="border-radius: <?php echo $setting['border'] ?>px; color: <?php echo $setting['color'] ?>; background: <?Php echo $setting['back']?> ">
                                <i class="icon-header fa-regular fa-user"></i>
                                <?php echo esc_html($auth_btn_text); ?>
                            </a>
                        <?php endif; ?>
                   
                    <?php else: ?>
                        <!-- check login user  -->
                        <?php if(is_user_logged_in()): ?>
                            <a class="auth-holder" href="<?php echo esc_url($account_link); ?>" style="border-radius: <?php echo $setting['border'] ?>px; color: <?php echo $setting['color'] ?>; background: <?Php echo $setting['back']?> ">
                                <i class="icon-header fa-regular fa-user"></i>
                               حساب کاربری
                            </a>
                        <?php else: ?>
                          <a class="auth-holder" id="btn-auth" href="" style="border-radius: <?php echo $setting['border'] ?>px; color: <?php echo $setting['color'] ?>; background: <?Php echo $setting['back']?> ">
                            <i class="icon-header fa-regular fa-user"></i>
                            ورود | ثبت نام
                        </a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
    <?php }
}