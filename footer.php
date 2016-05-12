		<footer class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-sm-5 nav-wrapper">
						<nav>
							<?php wp_nav_menu( array( 'theme_location' => 'footer_left', 'container' => '' ) ); ?>
						</nav>
						<nav>
							<?php wp_nav_menu( array( 'theme_location' => 'footer_right', 'container' => '' ) ); ?>
						</nav>
					</div>
					<div class="col-sm-3 nav-wrapper social">
						<nav>
							<ul>
								<li>
									<a href="https://www.facebook.com/thewpcrowd/" target="_blank">
										<i class="fa fa-facebook"></i>
										Facebook
									</a>
								</li>
								<li>
									<a href="https://twitter.com/thewpcrowd" target="_blank">
										<i class="fa fa-twitter"></i>
										Twitter
									</a>
								</li>
							</ul>
						</nav>
						<nav>
							<ul>
								<li>
									<a href="https://itunes.apple.com/us/podcast/the-wp-crowd/id1105661949" target="_blank">
										<i class="fa fa-apple"></i>
										iTunes
									</a>
								</li>
								<li>
									<a href="https://goo.gl/app/playmusic?ibi=com.google.PlayMusic&isi=691797987&ius=googleplaymusic&link=https://play.google.com/music/m/I46znws6tccg3yegynooza57mme?t%3DThe_WP_Crowd" target="_blank">
										<i class="fa fa-google"></i>
										Google Play
									</a>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<a href="<?php echo get_bloginfo('wpurl'); ?>">
							<img src="<?php echo get_template_directory_uri().'/img/logo.png'; ?>" alt="The WP Crowd Podcast" class="img-responsive" />
						</a>
					</div>
				</div>
			</div>
		</footer>
	<?php wp_footer(); ?>
	</body>
</html>