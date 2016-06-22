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
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-7601975-17', 'auto');
			ga('send', 'pageview');

		</script>
	</head>
	<body <?php body_class(); ?>>
		<header class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<a href="<?php echo get_bloginfo('wpurl'); ?>">
							<img src="<?php echo get_template_directory_uri().'/img/logo.png'; ?>" alt="The WP Crowd WordPress Podcast" class="img-responsive" />
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
				<a href="#open-menu" class="nav-toggle">Menu</a>
			</div>
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => '' ) ); ?>
			</div>
		</nav>
