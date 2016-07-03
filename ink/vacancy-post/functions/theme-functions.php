<?php
function themename_resume_admin_page() {
	add_menu_page(
		esc_html__( 'Resume', 'wpbootstrap' ),
		esc_html__( 'Resume', 'wpbootstrap' ),
		'manage_options',
		'custompage',
		'themename_resume_admin_render',
		'dashicons-admin-page',
		6
	);
}

add_action( 'admin_menu', 'themename_resume_admin_page' );


function themename_resume_admin_render() {

	global $wpdb;

	$vacancies = $resumes = array();

	$args = array(
		'post_type' => 'vacancy'
	);

	$vacancies_query = new WP_Query( $args );
	if ( $vacancies_query->have_posts() ) {
		while ( $vacancies_query->have_posts() ): $vacancies_query->the_post();
			$vacancies[] = get_the_title( get_the_ID() );
		endwhile;
	}
	wp_reset_query();

	$uploads   = wp_upload_dir();
	$base_path = $uploads['baseurl'] . '/resume/';

	if ( is_array( $vacancies ) ) {
		?>
		<table class="resume-table" border="1">
			<?php foreach ( $vacancies as $single_vacancy ) { ?>
				<tr class="resume-title">
					<td colspan="3"><h3 class="text-center"><?php echo esc_attr( $single_vacancy ) ?></h3></td>
				</tr>
				<?php $resumes = $wpdb->get_results( "SELECT resume_author, author_email, resume_filename FROM  " . $wpdb->prefix . "_themename_resume" . " WHERE vacancy_name = '" . $single_vacancy . "'" );
				if ( is_array( $resumes ) ) {
					foreach ( $resumes as $single_resume ) {
						$download_link = $base_path . $single_vacancy . '/' . $single_resume->resume_filename;
						?>
						<tr>
							<td class="resume-attribute"><?php echo esc_attr( $single_resume->resume_author ) ?></td>
							<td class="resume-attribute"><?php echo esc_attr( $single_resume->author_email ) ?></td>
							<td class="resume-attribute">
								<?php if ( is_file( $uploads['basedir'] . '/resume/' . $single_vacancy . '/' . $single_resume->resume_filename ) ) { ?>
									<a href="<?php echo( esc_url( $download_link ) ) ?>" download=""><?php echo esc_attr( $single_resume->resume_filename ) ?></a>
								<?php } else { ?>
									<?php esc_html_e( 'No resume file found!', 'wpbootstrap' ) ?>
								<?php } ?>
							</td>
						</tr>
					<?php }
				}
			} ?>
		</table>
	<?php }

}

function _theme_custom_excerpt( $length ) {
	return 30;
}

add_filter( 'excerpt_length', '_theme_custom_excerpt' );


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

add_action( 'admin_enqueue_scripts', 'themename_admin_scripts' );

function themename_admin_scripts() {
	wp_enqueue_style( 'themename-admin', get_template_directory_uri() . '/ink/vacancy-post/css/admin.css', array(), '1.0', 'all' );
}