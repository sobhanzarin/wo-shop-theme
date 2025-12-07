<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
    <div class="post-horizontal row">
        <?php if(has_post_thumbnail()) : ?>
        <div class="col-12 col-md-4 horizontal-img">
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-8 horizontal-content">
            <div class="horizontal-title mb-2">
                <h2>
                    <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                    </a>
                </h2>
            </div>
            <div class="horizontal-excerpt">
                <?php if(has_excerpt()) : ?>
                        <?php the_excerpt(); ?>
                <?php endif; ?>
            </div>

            <div class="horizontal-footer d-flex align-items-center justify-content-between mt-2">
                <div class="horizontal-footer-info">
                    <span class="info-views">
                        <i class="fa-slab-press fa-regular fa-eye"></i>
                        42
                    </span>
                    <span class="info-date">
                        <i class="fa-sharp fa-regular fa-timer"></i>
                        2 ماه قبل
                    </span>
                </div>
                <a class="btn-post-horizontal d-flex align-items" href="<?php the_permalink(); ?>">
                    بیشتر بخوانید
                    <i class="fa-solid fa-arrow-left-from-arc me-2"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</article>