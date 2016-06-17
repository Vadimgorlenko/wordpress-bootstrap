<?php
require get_template_directory() . '/ink/video-post/classes/ClassVideoPost.php';
require get_template_directory() . '/ink/video-post/classes/ClassVideoPostMetaboxes.php';

function theme_do_post_tags() {

	$post_taxonomies = get_the_terms( get_the_ID(), 'video-tag' );

	$video_tags = array();

	$html = '';

	if ( ! is_wp_error( $post_taxonomies ) ) {


		$html .= '<span class="post-tags">';

		foreach ( $post_taxonomies as $single_taxonomy ) {

			$video_tags[] = '<a href="' . esc_url( get_term_link( $single_taxonomy->term_id ) ) . '">' . $single_taxonomy->name . '</a>';

		}

		$html .= implode( ' / ', $video_tags );

		$html .= '</span><!--.post-tags-->';

	}

	echo apply_filters( 'video_tags_output', $html );

}

function theme_do_post_excerpt() {

	$excerpt_field = get_post_field( 'post_excerpt', get_the_ID() );
	if ( isset( $excerpt_field ) && ! empty( $excerpt_field ) ) {
		$post_excerpt = $excerpt_field;
	} else {
		$post_excerpt = '';
	}

	echo wp_trim_excerpt( $post_excerpt );

}