<?php
    get_header(); ?>



<div class="post-single-wrapper">

    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-9 col-md-8">
                <div class="col-12 md-3">
                    <div class="post-content-wrapper">
                        <?php while ( have_posts()) : the_post();?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="single-post-header mb-5">
                                <h1 class="title-single-post">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="single-post-meta d-flex align-items mt-4">
                                    <div class="item-post-meta ms-3">
                                      <i class="fa-solid fa-calendar-lines-pen"></i>
                                      <span>تاریخ انتشار : <?php echo get_the_date(); ?></span>
                                    </div>
                                    <div class="item-post-meta ms-3">
                                        <i class="fa-solid fa-eye"></i>
                                        <span>تعداد بازدید : 5</span>
                                    </div>
                                     <div class="item-post-meta ms-3">
                                        <i class="fa-solid fa-user"></i>
                                        <span>نویسنده : <?php echo get_the_author(); ?></span>
                                    </div>
                                    <div class="item-post-meta ms-3">
                                        <i class="fa-solid fa-list"></i>
                                        <span>دسته بندی : <?php echo get_the_category_list('.');?></span>
                                    </div>
                                </div>
                            </div>
                                <?php if(has_post_thumbnail()) : ?>
                                    <div class="single-post-image md-4">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>



                            <div class="single-post-content mt-4">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="related-post">
                            <?php get_template_part("/templates/post/related-post"); ?>
                        </div>
                            <div class="comment-post mt-5">
                                <div class="section-title position-relative">
                                    <div class="title">
                                        <div class="d-flex align-items-center">
                                            <i class="fal fa-comment-alt-lines ms-3"></i>
                                            <span>دیدگاه ها</span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(comments_open() || get_comments_number()) : ?>
                                    <div class="form-wrapper mt-3">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="post-sidebar">
                    <div class="search-single-post">
                        <form action="" class="search-handler-post">
                           <input class="form-control post-search-box" type="text" placeholder="جستجو...">
                            <button class="btn-search-post" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="category-sidebar box-sidebar mt-3">
                        <span class="title-box-sidebar">دسته بندی مقالات</span>
                        <div class="list-categories mt-3">
                            <ul>
                            <?php
                            $list_categories = get_categories();
                            ?>
                            <?php foreach ($list_categories as $item) { 
                                $category_link = get_category_link($item->term_id);
                                ?>
                                <li class="d-flex align-items-center justify-content-between"><a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($item->name); ?></a><span class="count-category d-flex align-items-center justify-content-center"><?php echo intval($item->count);?></span> </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="social-share box-sidebar mt-3">
                        <span class="title-box-sidebar">اشتراک گذاری</span>
                        <div class="social-share-wrapper d-flex align-items-center justify-content-center mt-3">
                            <div class="item-social-share">
                                <i class="fa-brands fa-square-instagram"></i>
                                <span>اینستاگرام</span>
                            </div>
                             <div class="item-social-share">
                                <i class="fa-brands fa-square-instagram"></i>
                                <span>واتساپ</span>
                            </div>
                             <div class="item-social-share">
                                <i class="fa-brands fa-square-instagram"></i>
                                <span>تلگرام</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


</div>

<?php get_footer(); ?>