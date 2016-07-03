<?php
/**
 * Custom Post Type Vacancy
 */

if ( ! ( class_exists( 'ClassVacancyPost' ) ) ) {

	class ClassVacancyPost {

		function __construct() {

			add_action( 'init', array( &$this, 'resume_post_register' ) );

		}

		/*Register Vacancy Post Type*/
		function resume_post_register() {

			$slug = 'vacancy-post';

			$labels = array(
				'name'               => esc_html__( 'Vacancy', 'wpbootstrap' ),
				'singular_name'      => esc_html__( 'Vacancy Post', 'wpbootstrap' ),
				'add_new'            => esc_html__( 'Add New', 'wpbootstrap' ),
				'add_new_item'       => esc_html__( 'Add New Vacancy Post', 'wpbootstrap' ),
				'edit_item'          => esc_html__( 'Edit Vacancy Post', 'wpbootstrap' ),
				'new_item'           => esc_html__( 'New Vacancy Post', 'wpbootstrap' ),
				'all_items'          => esc_html__( 'All Vacancy Posts', 'wpbootstrap' ),
				'view_item'          => esc_html__( 'View Vacancy Post', 'wpbootstrap' ),
				'search_items'       => esc_html__( 'Search Vacancy', 'wpbootstrap' ),
				'not_found'          => esc_html__( 'Nothing found', 'wpbootstrap' ),
				'not_found_in_trash' => esc_html__( 'Nothing found in Trash', 'wpbootstrap' ),
				'parent_item_colon'  => '',
				'menu_name'          => esc_html__( 'Vacancy', 'wpbootstrap' )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'menu_icon'          => 'dashicons-format-gallery',
				'capability_type'    => 'post',
				'taxonomies'         => array(),
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 8,
				'rewrite'            => array(
					'slug'       => $slug,
					'with_front' => false,
					'feed'       => true,
					'pages'      => true
				),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
			);

			register_post_type( 'vacancy', $args );

		}

	}

}

if ( class_exists( 'ClassVacancyPost' ) ) {
	$ClassVacancyPost = new ClassVacancyPost;
}
