<div class="article post-video">
	<div class="video-post-title">
		<?php the_title( '<h3>', '</h3>' ) ?>
	</div><!--.video-post-title-->
	<!--Display featured post video of image, if video not set-->
	<div class="video-post-featured">
		<?php
		$post_featured_video = get_post_meta( get_the_ID(), 'video_source_embed', true );

		if ( isset( $post_featured_video ) && ! empty( $post_featured_video ) ) {

			echo apply_filters( 'the_content', $post_featured_video );

		} elseif ( has_post_thumbnail( get_the_ID() ) ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

			<img src="<?php echo esc_url( $thumb ) ?>">

		<?php }

		?>
	</div><!--.video-post-featured-->
	<!--Display tags of post-->
	<div class="video-post-meta">

		<?php

		theme_do_post_tags();

		?>

	</div><!--.video-post-meta-->
	<!--Display short excerpt-->
	<div class="video-post-excerpt">

		<?php

		theme_do_post_excerpt()

		?>

	</div><!--.video-post-excerpt-->

</div><!--.article-->