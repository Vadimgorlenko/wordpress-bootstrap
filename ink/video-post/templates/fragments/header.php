<header role="banner">

	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">

			<div class="row">

				<div class="col-md-1">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="navbar-brand" title="<?php echo get_bloginfo( 'description' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
					</div>
				</div><!--.col-md-1-->
				<div class="col-md-10">
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</div>
				</div><!--.col-md-10-->
				<div class="col-md-1">
				<div class="header-logo">
					<?php $logo = get_template_directory_uri().'/images/320press_mini.png';?>
					<img src="<?php echo esc_url(theme_thumb($logo,'90','50',true))?>">
				</div>
				</div><!--col-md-2-->

			</div><!--.row-->

		</div> <!-- end .container -->
	</div> <!-- end .navbar -->

</header> <!-- end header -->