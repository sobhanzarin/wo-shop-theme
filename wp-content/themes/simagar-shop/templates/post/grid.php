<article id="post-<?php the_ID() ?>" <?php post_class() ?>> 
    <div class="post-inner">
        <?php if(has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
            <div class="simagar-post-content">
                <div class="post-title">
                    <h3>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </div>
                <div class="simagar-post-excerpt">
                    <?php if(has_excerpt()) : ?>
                        <?php the_excerpt(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="simagar-post-footer d-flex align-items-center">
                    <div class="d-flex align-items-center ms-2">
                        <i class="fa-solid fa-list ms-1"></i>
                        <span><?php echo get_the_category(get_the_ID())[0]->name    ?></span>
                    </div>
                    <div class="d-flex align-items-center ms-2">
                        <i class="fa-solid fa-calendar ms-1"></i>
                        <span><?php echo get_the_date();?></span>
                    </div>
            </div>
        <?php endif; ?>
    </div>
</article>