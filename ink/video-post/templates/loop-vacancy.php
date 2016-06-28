<?php

if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
} else {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
}

$args = array(

	'post_type'      => 'vacancy',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'posts_per_page' => 10,
	'paged'          => $paged

);

$vacancy_query = new WP_Query( $args );

if ( $vacancy_query->have_posts() ) { ?>

	<div class="col-md-3"></div>

	<?php while ( $vacancy_query->have_posts() ): $vacancy_query->the_post(); ?>

		<div class="col-md-9">


		</div>
		<?php
	endwhile; ?>

<?php }