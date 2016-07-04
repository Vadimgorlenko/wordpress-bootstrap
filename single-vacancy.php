<?php
get_header();
?>

	<div id="container" class="main">

		<div class="container">

			<div class="row">

				<div class="col-md-3">

					<?php themename_vacancy_navigation( 2 ); ?>

				</div>
				<div class="col-md-9">

					<div class="vacancy-title">

						<h4 class="title"><?php echo get_the_title( get_the_ID() ) ?></h4>

					</div>

					<div class="vacancy-description">
						<?php
						while ( have_posts() ): the_post();
							the_content();
						endwhile;
						?>
					</div>

					<div class="vacancy-button">

						<a class="btn btn-primary" data-toggle="modal" data-target="#<?php echo get_the_ID() ?>_apply"><?php esc_html_e( 'Apply', 'wpbootstrap' ) ?></a>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="modal fade" id="<?php echo get_the_ID() ?>_apply" tabindex="-1" role="dialog" aria-labelledby="resumeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php esc_html_e( 'Please upload your CV', 'wpbootstrap' ) ?></h4>
				</div>
				<div class="modal-body">
					<form action="" method="post" role="form" id="resumeForm" name="resumeForm" enctype="multipart/form-data">
						<input type="hidden" required class="form-control" id="vacancyName" value="<?php echo get_the_title( get_the_ID() ) ?>">
						<div class="form-group">
							<input type="text" required class="form-control" id="resumeName" placeholder="<?php esc_html_e( 'Your name', 'wpbootstrap' ) ?>">
						</div>
						<div class="form-group">
							<input type="email" required class="form-control" id="resumeEmail" placeholder="<?php esc_html_e( 'Your email', 'wpbootstrap' ) ?>">
						</div>
						<div class="form-group">
							<label for="resumeFile"><?php esc_html_e( 'CHOOSE FILE', 'wpbootstrap' ) ?></label>
							<input type="file" required id="resumeFile" name="resumeFiles" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
							<p class="help-block">Max 25Mb, PDF, DOC, DOCX.</p>
						</div>
						<button type="submit" id="resumeSubmit" class="btn btn-default" name="submit"><?php esc_html_e( 'Send', 'wpbootstrap' ) ?></button>
					</form>
					<iframe id="resume_upload" name="resume_upload" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
				</div>
			</div>
		</div>
	</div>

<?php get_footer();