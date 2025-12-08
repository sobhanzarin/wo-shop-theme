<?php

use Elementor\Controls_Manager;

class Simagar_Widget_Blog_Slides extends \Elementor\Widget_Base {
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
        return 'blog-slides';
    }

    public function get_title() {
        return 'نمایش اسلایدر مقالات';
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'blog_slides_section',
            [
                'label' => 'تنظیمات اسلایدر مقالات',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
			'count',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => 'تعداد مقالات',
				'range' => [
					'no' => [
						'min' => 1,
						'max' => 100,
                        'steo' => 1
					],
				],
				'default' => [
					'size' => 3,
				],
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
					'5' => 'شش ستونه',
				],
				'default' => '4',
			]
		);

        $this->add_control(
			'category',
			[
				'type' => Controls_Manager::SELECT2,
                'multiple' => true,
				'label' => 'دسته بندی',
				'options' =>simagar_get_terms_select([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ]),
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
    
    $blog_query =  new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $settings['count']['size'],
        'order' => $settings['order'],
        'tax_query' => [
            [
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $settings['category'],
            ]
        ] 
        ]);
    ?>
     
    <div class="owl-carousel owl-theme simagar-blog-slides" data-slider-items="<?php echo $settings['colums'] ?>" data-navigation="true" data-pagination="false" data-loop="true">
            <?php while($blog_query->have_posts()) : $blog_query->the_post() ?>      
               <div class="px-2">
                 <?php get_template_part("templates/post/grid"); ?>
               </div>
            <?php endwhile;
             wp_reset_postdata();
            ?>
    </div>

    <?php
}


}
