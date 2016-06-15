<?php

$args = array(

	'post_type' => 'video',
	'order' => 'DESC',
	'orderby' => 'date',
	'posts_per_page' => 10,

);

$video_post_query = new WP_Query($args);

if($video_post_query->have_posts()){

	while($video_post_query->have_posts()): $video_post_query->the_post();

	echo get_the_title(get_the_ID());

	endwhile;

}