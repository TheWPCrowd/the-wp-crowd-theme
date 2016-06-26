<!doctype html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>


	<body <?php body_class(); ?>>
		<header class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<a href="<?php echo get_bloginfo( 'url' ); ?>" title="<?php _e( 'The WP Crowd WordPress Podcast', 'wpcrowd' );?>" >
							<img src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="<?php _e( 'The WP Crowd WordPress Podcast', 'wpcrowd' );?>" class="img-responsive" />
						</a>
					</div>
					<nav class="col-sm-4 col-sm-offset-3">
						<?php wp_nav_menu( array( 'theme_location' => 'top_header', 'container' => '' ) ); ?>
					</nav>
				</div>
			</div>
		</header>
		<nav class="container-fluid main-nav">
			<div class="row mobile-nav-div">
				<a href="#open-menu" class="nav-toggle"><?php _e( 'Menu', 'wpcrowd' );?></a>
			</div>
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => '' ) ); ?>
			</div>
		</nav>
