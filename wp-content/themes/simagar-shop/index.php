<?php get_header(); ?>
<div class="main-page-wrapper single-page">
    <div class="content-section">
        <div class="container">
            <div class="row">
                <div class="simagar-sidebar-post col-12 col-md-2 mt-2">
                    <?php dynamic_sidebar('sidebar-blog'); ?>
                </div>
                <div class="col-12 col-md-10">
                    <div class="row">
                        <?php if(have_posts()) : ?>
                            <?php while(have_posts()) : the_post(); ?>
                                <div class="col-12 col-md-4">
                                    <?php get_template_part('/templates/post/grid'); ?>
                                </div>
                            <?php endwhile ?>
                        <?php endif; ?>
                    </div>

                    <div class="simagar-pagination p-4">
                            <?php echo paginate_links([
                                'type' => 'list',
                                'prev_text' => '<i class="fal fa-angle-right"></i>',
                                'next_text' => '<i class="fal fa-angle-left"></i>',
                            ]); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>