<?php 
$args = [
    'posts+per_page' => 6,
    'post__not_in' => [$post->ID] 
];
$query = new WP_Query($args);
?>
<?php if($query->have_posts()): ?>

<div class="related-post mt-5">
    <div class="section-title position-relative">
        <div class="title">
            <div class="d-flex align-items-center">
                <i class="fal fa-arrows-retweet ms-3"></i>
                <span>پست های مرتبط</span>
            </div>
        </div>
    </div>
    <div>
        <div class="owl-carousel owl-theme mt-3" data-slider-items="4" data-navigation="true" data-pagination="true" data-loop="true">
            <?php while($query->have_posts()) : $query->the_post(); ?>
            <div class="item post-inner">
                <div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
                    <div class="post-thumb position-relative">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <div class="post-hover-img simagar-related-meta d-flex align-items-end justify-content-between">
                               <div class="d-flex align-items-center ms-2">
                                    <i class="fa-solid fa-list ms-1"></i>
                                    <span><?php echo get_the_category(get_the_ID())[0]->name    ?></span>
                                </div>
                                <div class="d-flex align-items-center ms-2">
                                    <i class="fa-solid fa-calendar ms-1"></i>
                                    <span><?php echo get_the_date();?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="simagar-post-content d-flex flex-column justify-content-between">
                        <span class="title-carosel-item mt-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                        <div class="simagar-post-excerpt">
                            <?php if(has_excerpt()) : ?>
                                <?php the_excerpt(); ?>
                            <?php endif; ?>
                        </div>
                             
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif;
wp_reset_postdata();
?>