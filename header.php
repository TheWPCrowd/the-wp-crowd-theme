<!doctype html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '&laquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
		<meta name="author" content="WPCROWD">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/favicon.png">
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body <?php body_class(); ?>>
		<header class="container-fluid">
			<div class="container">
				<nav class="row">
					<?php wp_nav_menu( array( 'menu' => 'Main Menu', 'container' => '', 'menu_class' => 'col-xs-12' ) ); ?>
				</nav>
			</div>
		</header>
		<?php if( is_front_page() ) : ?>
		<?php
			$args = array( 'post_type' => 'podcast', 'posts_per_page' => 1 );
			$podcasts = new WP_Query( $args );
			$podcasts->the_post();
			$meme_pic = get_field( 'meme_of_the_week' );
			$meme_src = $meme_pic['sizes']['large'];
		?>
		<div class="container-fluid home-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-xs-4 logo">
						<img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(). '/build/img/wp_crowd_logo.jpg'; ?>" alt="The WP Crowd" />
					</div>
					<div class="col-sm-6 col-xs-8 text-center">
						<h2 class="text-center hidden-xs hidden-sm"><?php _e( 'Meme Of The Week', 'thewpcrowd' );?></h2>
						<a href="<?php the_permalink(); ?>">
						<?php 
							echo '<img style="height:210px;margin:0 auto" src="' . $meme_src . '" class="img-responsive"  style="margin:0 auto;" />';
						?>
						</a>
					</div>
				</div>	
			</div>
		</div>
		<?php wp_reset_query(); endif; ?>
		<div class="container">
			<div class="row">