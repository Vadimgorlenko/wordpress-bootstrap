<?php
require get_template_directory() . '/ink/video-post/classes/ClassVacancyPost.php';

function _theme_custom_excerpt($length) {
	return 30;
}
add_filter('excerpt_length', '_theme_custom_excerpt');