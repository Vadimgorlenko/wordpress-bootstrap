<?php
add_action( "after_switch_theme", "_themename_add_table" );

function _themename_add_table() {
	global $wpdb;
	$table     = $wpdb->prefix . "_themename_resume";
	$structure = "CREATE TABLE $table (
        id INT(9) NOT NULL AUTO_INCREMENT,
        vacancy_name VARCHAR(200) NOT NULL,
        resume_author VARCHAR(200) NOT NULL,
        author_email VARCHAR(200) NOT NULL,
        resume_filename VARCHAR(200) NOT NULL,
	UNIQUE KEY id (id)
    );";
	$wpdb->query( $structure );
}

require get_template_directory() . '/ink/vacancy-post/classes/ClassVacancyPost.php';

function _theme_custom_excerpt( $length ) {
	return 30;
}

add_filter( 'excerpt_length', '_theme_custom_excerpt' );

function frontend_ajax() {

	wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/ink/vacancy-post/js/upload.js', array( 'jquery' ) );

	wp_localize_script( 'ajax-script', 'themename_ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'frontend_ajax' );

function themename_resume_data() {

	global $wpdb;

	$vacancy_name  = $_POST['vacancy'];
	$resume_author = $_POST['name'];
	$resume_email  = $_POST['email'];
	$resume_file   = $_POST['file'];

	var_dump( $resume_author );

	$wpdb->query( "insert into " . $wpdb->prefix . "_themename_resume (vacancy_name, resume_author, author_email, resume_filename) values ('" . esc_attr( $vacancy_name ) . "', '" . esc_attr( $resume_author ) . "', '" . esc_attr( $resume_email ) . "','" . esc_attr( $resume_file ) . "')" );

}

add_action( 'wp_ajax_themename_resume_data', 'themename_resume_data' );

function themename_resume_upload() {

	$vacancy = $_POST['vacancy'];
	$file    = $_POST['file'];

	$uploads = wp_upload_dir();
	$path    = trailingslashit( $uploads['basedir'] ) . 'resume/' . $vacancy;
	if ( ! is_dir( $path ) ) {
		wp_mkdir_p( $path );
	}
	@chmod( $path, 0777 );
	move_uploaded_file( $file, $path );

}

add_action( 'wp_ajax_themename_resume_upload', 'themename_resume_upload' );

function themename_vacancy_navigation( $home_id ) {

	$args = array(
		'post_type' => 'vacancy'
	);

	$vacancy_query = new WP_Query( $args );

	$output = '';

	$current_page = get_the_ID();

	if ( $vacancy_query->have_posts() ) {

		$output .= '<ul class="vacancies-nav">';

		if ( $home_id === get_the_ID() ) {
			$active = 'active';
		} else {
			$active = '';
		}

		$output .= '<li class="vacancy-item ' . esc_attr( $active ) . '">';
		$output .= '<a href="' . esc_url( get_the_permalink( $home_id ) ) . '">' . esc_html__( 'All', 'wpbootstrap' ) . '</a>';
		$output .= '</li>';

		while ( $vacancy_query->have_posts() ): $vacancy_query->the_post();

			if ( $current_page === get_the_ID() ) {
				$active = 'active';
			} else {
				$active = '';
			}

			$output .= '<li class="vacancy-item ' . esc_attr( $active ) . '">';
			$output .= '<a href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '">' . esc_attr( get_the_title( get_the_ID() ) ) . '</a>';
			$output .= '</li>';

		endwhile;

		wp_reset_query();

		$output .= '</ul>';

	}

	echo apply_filters( 'themename_vacancies_navigation', $output );

}