<?php
    get_header(); ?>
<?php $list_categories = get_categories(); ?>


<div class="post-single-wrapper">

    <div class="container">
        <div class="breadcrumb-section p-4 mb-3">
            <?php bcn_display(); ?>
        </div>
        <div class="row mb-5">
            <div class="col-lg-9 col-md-8">
                <div class="col-12 md-3">
                    <div class="post-content-wrapper">
                        <article class="single-post-article">
                         <?php while ( have_posts()) : the_post();?>
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
                            <?php endwhile; ?>



                        </article>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="post-sidebar">
                    <div class="category-sidebar">
                        <span class="title-category">دسته بندی مقالات</span>
                        <div class="list-categories mt-3">
                            <ul>
                                <li>دسته بندی <span>1</span> </li>
                                <li>دسته بندی 2</li>
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>


</div>




<?php get_footer(); ?>