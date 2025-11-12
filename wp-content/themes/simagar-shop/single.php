<?php
    get_header(); ?>


<div class="post-single-wrapper">

    <div class="container">

        <div class="breadcrumb-section">
            <?php bcn_display(); ?>
        </div>

        <div class="row md-5">
            <div class="col-lg-9 col-md-8">
                <div class="col-12 md-3">
                    <div class="post-content-wrapper">
                        <article class="single-post-article" ></article>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4"></div>
        </div>
    </div>


</div>

<div class="top-section-post">
    <div class="container">
        <div class="breadcrumbs" ><?php bcn_display(); ?></div>
    </div>
</div>

<div class="main-page-wraper single-post">
    <div class="content-section">
        <div class="container">
            <article>
                    <h1 class="title-post-single" >
                        <?php the_title(); ?>
                    </h1>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if(has_post_thumbnail()) :  ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif;?>
                    <?php endwhile; ?>
            </article>
        </div>
    </div>
</div>








<?php get_footer(); ?>