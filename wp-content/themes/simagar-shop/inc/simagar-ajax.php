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
                        <li class="d-flex align-items-center">
                            <a href="<?php esc_url(the_permalink()) ?>">
                                <?php the_post_thumbnail(); ?>
                                <?php the_title(); ?>
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