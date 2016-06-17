<div class="article post-video">
	<div class="video-post-title">
		<?php the_title( '<h3>', '</h3>' ) ?>
	</div><!--.video-post-title-->
	<!--Display tags of post-->
	<div class="video-post-meta">

		<?php

		theme_do_post_tags();

		?>

	</div><!--.video-post-meta-->
	<!--Display short excerpt-->
	<div class="video-post-excerpt">

		<?php

		theme_do_post_excerpt()

		?>

	</div><!--.video-post-excerpt-->

</div><!--.article-->