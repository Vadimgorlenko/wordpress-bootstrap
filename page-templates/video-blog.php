<?php
/**
 * Template Name: Video Posts
 *
 */

get_header(); ?>

	<section id="content">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<?php get_template_part( 'ink/video-post/templates/loop', 'video' ); ?>
			</div>
			<div class="col-md-3"></div>
		</div>

	</section>

<?php get_footer();