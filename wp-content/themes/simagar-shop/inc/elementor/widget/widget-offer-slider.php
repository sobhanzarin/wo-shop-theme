<?php

use Elementor\Controls_Manager;

class Simagar_Widget_Offer_Slider extends \Elementor\Widget_Base {
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
        return 'offer-slider';
    }

    public function get_title() {
        return 'پیشنهاد شگفت انگیز';
    }

    public function get_icon() {
        return 'eicon-product-rating';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'offer_slider_section',
            [
                'label' => 'تنظیمات پیشنهاد شکفت انگیز',
                'tab' => Controls_Manager::TAB_CONTENT, 
            ]
        );

       $this->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'عنوان',
				'default' => 'پیشنهاد شگفت انگیز'
			]
		);

        $this->add_control(
			'description',
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'توضیح',
				'default' => 'شما در این بخش تمام محصولاتی که در سایت ما دارای تخفیف ویژه است را مشاهده میکنید.'
			]
		);

        $this->add_control(
			'show_offer',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'فقط محصولات دارای تخفیف نمایش داده شود.',
				'default' => 'no',
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
				],
				'default' => '4',
			]
		);

        $this->add_control(
			'count',
			[
				'type' => Controls_Manager::SLIDER, 
				'label' => 'تعداد محصولات',
				'range' => [
					'no' => [
						'min' => 1,
						'max' => 100,
                        'step' => 1
					],
				],
				'default' => [
					'size' => 3,
				],
			]
		);

        $this->add_control(
			'order',
			[
				'type' => Controls_Manager::SELECT,
				'label' => 'مرتب سازی',
				'options' => [
                    'ASC' => 'صعودی',
                    'DESC' => 'نزولی',
                ],
				'default' => 'DESC',
			]
		);

        $this->end_controls_section();
    }
protected function render() {
    $settings = $this->get_settings_for_display();
    
    $args =  [
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => $settings['count']['size'],
        'order' => $settings['order'],
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' =>   '_simagar_product_special',
                'compare' => '=',
                'value' => 'on',
            ]
            ],
        ];
        $product_sale = wc_get_product_ids_on_sale();

        if($settings['show_offer'] === 'yes') {
            $args['post__in'] = $product_sale;
         }

        $offer_query = new WP_Query($args);
    ?>

    <div class="simagar-offer-slider">
        <div class="slider-holder row">
            <div class="col-md-12">
                <div class="left-slider">
                    <div class="owl-carousel owl-theme" data-slider-items="<?php echo $settings['colums'] ?>" data-navigation="true" data-pagination="false" data-loop="false">
                         <?php while($offer_query->have_posts()) : $offer_query->the_post() ?>      
                            <div class="px-2">
                                <?php get_template_part("woocommerce/content-product"); ?>
                            </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
     

    <?php
}


}
