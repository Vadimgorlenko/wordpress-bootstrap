<?php
/**
* Template Name: Vacancy Posts
*
*/

get_header(); ?>

<section id="content">
	<div class="row">
		<div class="col-md-3">

			<?php themename_vacancy_navigation(2);?>

		</div>
		<div class="col-md-9 vacancies-list">
			<?php get_template_part( 'ink/vacancy-post/templates/loop', 'vacancy' ); ?>
		</div>
	</div>

</section>

<?php get_footer();