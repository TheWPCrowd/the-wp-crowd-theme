<!doctype html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="author" content="WPCROWD">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/favicon.png">
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
				<?php if( is_front_page() ): ?>
				<div id="l_shape">
					<div class="kardashians">
						<strong>Talking about WordPress</strong>
						<span>And not about the Kardashians</span>
					</div>
					<div class="kardashians sometimes">
						<span>But sometimes about the Kardashians</span>
					</div>
				</div>
				<?php endif; ?>
				<nav class="row">
					<?php wp_nav_menu( array( 'menu' => 'Main Menu', 'container' => '', 'menu_class' => 'col-xs-12' ) ); ?>
				</nav>
			</div>
		</header>
		<div class="container">
			<div class="row">