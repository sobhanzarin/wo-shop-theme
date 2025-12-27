<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
remove_action('woocommerce_review_before_comment_meta','woocommerce_review_display_rating',10);
?>
<div class="simagar-comment-product">
<li <?php comment_class( 'simagar-review-item' ); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>" class="simagar-review-container">

		<!-- Avatar -->
		<div class="simagar-review-avatar">
			<?php
			do_action( 'woocommerce_review_before', $comment );
			?>
		</div>

		<!-- Content -->
		<div class="simagar-review-content">

			<!-- Rating -->
			<div class="simagar-review-rating">
				<?php
				do_action( 'woocommerce_review_before_comment_meta', $comment );
				?>
			</div>

			<!-- Meta (name, date, verified) -->
			<div class="simagar-review-meta">
				<?php
				do_action( 'woocommerce_review_meta', $comment );
				?>
			</div>

			<!-- Text -->
			<div class="simagar-review-text">
				<?php
				do_action( 'woocommerce_review_comment_text', $comment );
				?>
			</div>

			<!-- After text (custom actions) -->
			<div class="simagar-review-footer">
				<?php
				do_action( 'woocommerce_review_after_comment_text', $comment );
				?>
			</div>

		</div>

	</div>
</div>