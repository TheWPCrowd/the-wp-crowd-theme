<?php
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">


		<div class="col-sm-8 content">
			<div class="content-container">
				<div id="myShop"><a href="//shop.spreadshirt.com/thewpcrowd">thewpcrowd</a></div>

				<script>
					var spread_shop_config = {
						shopName: 'thewpcrowd',
						locale: 'us_US',
						prefix: '//shop.spreadshirt.com',
						baseId: 'myShop'
					};
				</script>

				<script type="text/javascript" src="//shop.spreadshirt.com/shopfiles/shopclient/shopclient.nocache.js"></script>
			</div>

		</div>


		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		</div>


	</div>
</div>

<?php get_footer();