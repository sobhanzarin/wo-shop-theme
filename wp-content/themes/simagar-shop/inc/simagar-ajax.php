<?php 

function simagar_search_ajax()
{
    $the_query = new WP_Query([
        'posts_per_page' => 10,
        's' => esc_html($_POST['keyword']),
        'post_type' => 'product',
    ]);
    if($the_query->have_posts()){
        ?>
        <div>
            <ul class="ajax-search-result">
                <?php 
                    while($the_query->have_posts()){
                    $produc = wc_get_product(get_the_ID());
                    $the_query->the_post() ?>
                        <li class="d-flex align-items-center mb-3">
                            <a href="<?php esc_url(the_permalink()) ?>">
                                <?php the_post_thumbnail(); ?>
                                <span class="title-search-result me-3"><?php the_title(); ?></span>
                            </a>

                        </li>
                    <?php   
                    }
            ?>
            </ul>
        </div>

    <?php
    }else{
        ?>
            <p>هیچ محصولی یافت نشد.</p>
        <?php
    }

    wp_reset_postdata();
    die();

}

add_action('wp_ajax_simagar_search_ajax', 'simagar_search_ajax');
add_action('wp_ajax_nopriv_simagar_search_ajax', 'simagar_search_ajax');

function simagar_filter_product(){
    $category = $_POST['category'];
    $product_query =  new WP_Query([
        'product_cat' => $category,
        'post_type' => 'product',
        'posts_per_page' => 5,
        'order' => "DESC",
    ]);
    if($product_query->have_posts()){
        while($product_query->have_posts()) : $product_query->the_post();?>
               <div class="col-12 col-md-3">
                   <?php get_template_part("woocommerce/content-product"); ?>
               </div>
           <?php endwhile; 
    }else{ 
    ?>  
    <p>آیتمی یافت نشد...</p>
    
    <?php
    }
    die();
}
add_action('wp_ajax_simagar_filter_product', 'simagar_filter_product');
add_action('wp_ajax_nopriv_simagar_filter_product', 'simagar_filter_product');