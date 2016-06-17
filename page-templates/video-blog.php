<?php
/**
 * Template Name: Video Posts
 *
 */

get_header(); ?>

	<section id="content">
		<div class="row">

			<?php get_template_part( 'ink/video-post/templates/loop', 'video' ); ?>

		</div>

	</section>

<?php get_footer();