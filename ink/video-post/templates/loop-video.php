<?php

if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
} else {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
}

$args = array(

	'post_type'      => 'video',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'posts_per_page' => 10,
	'paged'          => $paged

);

$video_post_query = new WP_Query( $args );

if ( $video_post_query->have_posts() ) {

	$i = 0;

	while ( $video_post_query->have_posts() ): $video_post_query->the_post(); ?>
		<div class="col-md-12">

				<?php if ( 0 === $i ) {

					get_template_part('ink/video-post/templates/post-templates/post','featured');

				} else {

					get_template_part('ink/video-post/templates/post-templates/post','normal');

				} ?>

		</div><!--.col-md-12-->
		<?php $i ++;
	endwhile; ?>

<?php }