<?php

use Elementor\Controls_Manager;

class Simagar_Widget_Blog_Horizontal extends \Elementor\Widget_Base {

    public function get_name() {
        return 'blog-post-horizontal';
    }

    public function get_title() {
        return 'نمایش مقالات افقی';
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'blog_horizontal_section',
            [
                'label' => 'تنظیمات مقالات افقی',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
			'count',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => ' تعداد مقالات افقی',
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
					'col-md-12' => 'تک ستونه',
					'col-md-6' => 'دو ستونه',
				],
				'default' => 'col-md-6',
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
     
    <div class="row">
            <?php while($blog_query->have_posts()) : $blog_query->the_post() ?>
            <div class="col-12 <?php echo esc_attr($settings['colums']) ?>">
                <?php get_template_part("templates/post/grid-horizontal"); ?>
            </div>
            <?php endwhile;
             wp_reset_postdata();
            ?>

    </div>

    <?php
}


}
