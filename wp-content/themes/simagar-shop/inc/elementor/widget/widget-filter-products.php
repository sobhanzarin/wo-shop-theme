<?php

use Elementor\Controls_Manager;

class Simagar_Widget_Filter_Products extends \Elementor\Widget_Base {

    public function get_name() {
        return 'filter_products';
    }

    public function get_title() {
        return 'نمایش تب محصولات ';
    }

    public function get_icon() {
        return 'eicon-product-tabs';
    }

    public function get_categories() {
        return ['simagar-widgets'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'filter_products_section',
            [
                'label' => 'تنظیمات تب محصولات',
                'tab' => Controls_Manager::TAB_CONTENT,
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
                        'steo' => 1
					],
				],
				'default' => [
					'size' => 3,
				],
			]
		);
        $this->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'عنوان',
				'default' => 'محصولات پیشنهادی'
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
					'col-md-4' => 'سه ستونه',
					'col-md-3' => 'چهار ستونه',
					'col-md-2' => 'شش ستونه',
				],
				'default' => 'col-md-4',
			]
		);

         $this->add_control(
			'category',
			[
				'type' => Controls_Manager::SELECT2,
                'multiple' => true,
				'label' => 'دسته بندی',
				'options' =>simagar_get_terms_select([
                    'taxonomy' => 'product_cat',
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
    
    $product_query =  new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => $settings['count']['size'],
        'order' => $settings['order'],
        'tax_query' => [
            [
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $settings['category'],
            ]
        ] 
        ]);
    ?>
     
  <div class="simagar-filter-products">
    <div class="categories d-flex align-items-center justify-content-between mb-3">
        <div>
            <span class="title"><?php echo esc_html($settings['title'])?></span>
        </div>
        <ul class="d-flex align-items-center">
            <li data-product-cate="<?php 
            foreach($settings['category'] as $cat){
                echo get_term_by('id', $cat, 'product_cat')->slug . ',';
            }
            ?>" class="category-item select">همه دسته ها</li>
            <?php if($settings['category']) : ?>
                <?php foreach ($settings['category'] as $cat) : ?>
                    <li data-product-cate="<?php echo esc_html(get_term_by('id', $cat, 'product_cat')->slug)?>" class="category-item"><?php echo esc_html(get_term_by('id', $cat, 'product_cat')->name)?></li>
            
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="row product-item ">
        <?php while($product_query->have_posts()) : $product_query->the_post();?>
            <div class="col-12 <?php echo esc_attr($settings['colums']) ?>">
                <?php get_template_part("woocommerce/content-product"); ?>
            </div>
        <?php endwhile; 
        wp_reset_postdata();
        ?>
        
    </div>
  </div>

    <?php
}


}
