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

	<?php $i = 1; ?>

	<div class="row">
	<?php while ( $vacancy_query->have_posts() ):
		$vacancy_query->the_post(); ?>

		<div class="col-md-6">
			<div class="vacancy">
				<h5 class="vacancy-title">
					<a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ) ?>"><?php echo esc_attr( get_the_title( get_the_ID() ) ) ?></a>
				</h5>
				<div class="vacancy-excerpt">
					<?php echo get_the_excerpt(); ?>
				</div>
			</div>
		</div>
		<?php if ( 0 === $i % 2 ) { ?>
		</div>
		<div class="row">
	<?php } ?>

		<?php $i ++; ?>
		<?php
	endwhile; ?>
	</div>

<?php }