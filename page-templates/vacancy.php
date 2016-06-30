<?php
/**
* Template Name: Vacancy Posts
*
*/

get_header(); ?>

<section id="content">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<?php get_template_part( 'ink/video-post/templates/loop', 'vacancy' ); ?>
		</div>
	</div>

</section>

<?php get_footer();