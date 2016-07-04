<?php

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

	$resume_emails = array();
	$emails        = $wpdb->get_results( "SELECT author_email FROM  " . $wpdb->prefix . "_themename_resume" . " WHERE vacancy_name = '" . $vacancy_name . "'" );

	if ( is_array( $emails ) && ! ( null === $emails ) ) {
		foreach ( $emails as $single_row ) {
			if ( ! empty( $single_row->author_email ) ) {
				$resume_emails[] = $single_row->author_email;
			}
		}
	}

	if ( ! ( in_array( $resume_email, $resume_emails ) ) ) {
		$wpdb->query( "insert into " . $wpdb->prefix . "_themename_resume (vacancy_name, resume_author, author_email, resume_filename) values ('" . esc_attr( $vacancy_name ) . "', '" . esc_attr( $resume_author ) . "', '" . esc_attr( $resume_email ) . "','" . esc_attr( $resume_file ) . "')" );
	}

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

	move_uploaded_file( $_FILES['resumeFiles']['tmp_name'], $path.'/'.$file );

}

add_action( 'wp_ajax_themename_resume_upload', 'themename_resume_upload' );