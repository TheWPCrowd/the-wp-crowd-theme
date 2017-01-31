<?php
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">
		<div class="col-sm-12 content">
			<div class="content-container">
				<h2 class="single-title">The WP Crowd Shop</h2>
				<div id="myShop"></div>

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
	</div>
</div>

<?php get_footer();