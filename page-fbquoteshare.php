<?php
/*
 * Template Name: Facebook Quote Sharing
 *
 * description:  Needed to reply to Facebook when someone shares a quote via Facebook
 *
 * notes:  does not use header or footer, and redirects people to homepage if they have a dodgy url
 */

function wpcrowd_share_buttons_checkbot() {
	$redirect = false;

	$pattern = '/(FacebookExternalHit|visionutils|Facebot)/i';
	$agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_ENCODED);
	if( preg_match( $pattern,$agent) ) {
	 $redirect = true;
	}
	return $redirect;
}

function wpcrowd_share_buttons_serverside_sharing_facebook() {
	$id = get_query_var( 'id', false);

	//no id send to homepage
	if( $id == false) {
		wp_redirect( home_url() );
		exit;
	}
	// get the canonical URL
	$options = array( 'absolute' => TRUE);
	$url = url( 'node/' . $id, $options);
	// if not facebook, re-direct to canonical url
	if(! wpcrowd_share_buttons_checkbot() ) {
	  wp_redirect( $url);
	  exit;
	}
	$text = get_query_var( 't' );
	// if some sort of text set, then return the array of data :)
	if (!empty( $text) ) {
		$node = node_load( $id);
		// if no node on that nid re-direct
		if( $node == false) {
		 drupal_goto( $url);
		}
		// else return lovely array of settings
		return array(
			'id'				=> $id,
			'description'   	=> $text,
			'url'		  		=> $url,
			'title'				=> $node->title,
			'image'				=> file_create_url( $node->field_image['und'][0]['uri']),
			'fbshare'	  		=> TRUE
			);
	}
	wp_redirect( $url);
	  exit;
}

$output = wpcrowd_share_buttons_serverside_sharing_facebook();
?>
<!doctype html>
<html>
  <head>
	<meta charset="UTF-8">
	<title><?php print $the_title ?></title>
	<meta name="description" content="<?php _e( 'Quote: ' ) ?><?php echo $output['description'] ?>" />
	<meta property="og:title" content="<?php echo $output['title'] ?>" />
	<meta property="og:url" content="<?php echo $output['url'] ?>" />
	<meta property="og:description" content="<?php _e( 'Quote: ' ) ?><?php echo $output['description'] ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="<?php echo  $output['image'] ; ?>" />
	<link rel="img_src" href="<?php echo   $output['image'] ?>" />
  </head>
<body>
	<div id="wrapper">
		<h1><?php echo $output['title'] ?></h1>
		<img src="<?php echo   $output['image'] ?>" />
		<a href="<?php echo $output['url'] ?>"> <?php echo $output['description'] ?></a>
	</div>
</body>
</html>

