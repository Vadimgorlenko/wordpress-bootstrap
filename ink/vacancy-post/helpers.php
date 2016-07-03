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
require get_template_directory() . '/ink/vacancy-post/functions/ajax-functions.php';
require get_template_directory() . '/ink/vacancy-post/functions/theme-functions.php';