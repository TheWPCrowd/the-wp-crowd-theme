<?php
/*
 * Template Name: Contributors
 */
	get_header();
	global $wpdb;
	$min_posts = 1; // Make sure it's int, it's not escaped in the query
	$author_ids = $wpdb->get_col(	"SELECT `post_author` FROM
									(SELECT `post_author`, COUNT(*) AS `count` FROM {$wpdb->posts}
									WHERE `post_status`='publish' GROUP BY `post_author`) AS `stats`
									WHERE `count` >= {$min_posts} ORDER BY `count` DESC;"
								);

	$people_terms = get_terms( 'people' );
	$podcasters = array();
	if ( ! empty( $people_terms ) ) {
		foreach( $people_terms as $person ) {
			if ( isset( $person->term_id ) ) {
				$associated_user = get_field( 'associated_user', $person->taxonomy . '_' . $person->term_id );
				if ( $associated_user ) {
					$podcasters[] = $associated_user['ID'];
				}
			}
		}
	}
	$author_ids = array_merge( $author_ids, $podcasters );
	$author_ids = array_unique( $author_ids );
?>
<div id="map"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center contributors-wrapper">
			<h1><?php _e( 'Contributors', 'wpcrowd' );?></h1>
			<div class="row">

				<?php
					$google_map_locations = '';

					foreach( $author_ids as $author ):
						$user = get_user_by( 'id', intval( $author ) );
						$usermeta = get_user_meta( $user->ID );
						$author_name = $user->user_nicename;

						if ( $usermeta['first_name'][0] && $usermeta['last_name'][0] ) {
							$author_name = $usermeta['first_name'][0] . '<br />' . $usermeta['last_name'][0];
						}

						$location = get_field( 'location', 'user_' . $user->ID );

						if ( ! $location ) {
							$location = '';
						} else {
							$google_map_locations[] = $location;
						}

				?>

				<article class="col-sm-3 contributor-wrapper" data-loc="<?php echo esc_attr( $location ); ?>">
					<div class="contributor">

						<div class="contributor-image">
							<a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="<?php _e( 'WP Crowd Author', 'wpcrowd' );?>">
								<?php echo get_avatar( $user->ID, 300, '', __( 'The WP Crowd', 'wpcrowd' ), array( 'class' => 'img-responsive' ) ); ?>
							</a>
						</div>

						<div class="contributor-meta">
							<h3>
								<a href="<?php echo get_author_posts_url( $user->ID ); ?>">
									<?php echo $author_name; ?>
								</a>
							</h3>

							<?php if ( get_field( 'title', 'user_' . $user->ID ) ) : ?>
								<h5>
									<?php
										$title = get_field( 'title', 'user_' . $user->ID );
										$title = str_replace( '-', ' ', $title );
										$title = str_replace( '_', ' ', $title );
										echo esc_html( $title );
									?>
								</h5>
							<?php endif; ?>

							<?php if ( $location ) : ?>
								<div class="location">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									<?php echo esc_html( $location ); ?>
								</div>
							<?php endif; ?>

							<?php if ( get_field( 'biography', 'user_' . $user->ID ) ) : ?>
								<a href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>" title="<?php _e( 'BIO', 'wpcrowd' );?>" class="bio circle">
									<i><?php _e( 'BIO', 'wpcrowd' );?></i>
								</a>
							<?php endif; ?>

							<?php if ( get_field( 'twitter_handle', 'user_' . $user->ID ) ) : ?>
								<a href="<?php echo esc_url( 'https://twitter.com/' . get_field( 'twitter_handle', 'user_' . $user->ID ) ); ?>" title="<?php _e( 'Twitter', 'wpcrowd' );?>" target="_blank" class="circle">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							<?php endif; ?>

							<?php if ( get_field( 'facebook_url', 'user_' . $user->ID ) ) : ?>
								<a href="<?php echo esc_url( get_field( 'facebook_url', 'user_' . $user->ID ) ); ?>" title="<?php _e( 'Facebook', 'wpcrowd' );?>" target="_blank" class="circle">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							<?php endif; ?>

							<?php if ( $user->user_url ) : ?>
								<a href="<?php echo esc_url( $user->user_url ); ?>" title="<?php _e( 'Website', 'wpcrowd' );?>" target="_blank" class="circle">
									<i class="fa fa-home" aria-hidden="true"></i>
								</a>
							<?php endif; ?>

						</div>

					</div>
				</article>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
</div>


<script>
function initMap() {

	/* define the styles to be used in this map */
	var styles = [
	{
		"featureType": "administrative",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "administrative",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "administrative",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#444444"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "all",
		"stylers": [
			{
				"color": "#f2f2f2"
			},
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "poi",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "road",
		"elementType": "all",
		"stylers": [
			{
				"saturation": -100
			},
			{
				"lightness": 45
			},
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "simplified"
			}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "labels.icon",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "transit",
		"elementType": "all",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "all",
		"stylers": [
			{
				"color": "#ffffff"
			},
			{
				"visibility": "on"
			}
		]
	}
];

/* Create the styled map definition for Google Maps */
var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});


var mapDiv = document.getElementById('map');
var map = new google.maps.Map(mapDiv, {
	center: {lat: -53, lng: 151},
	zoom: 2,
	scrollwheel: false,
	mapTypeControlOptions: {
		mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
	},
	disableDefaultUI: true
});

geocoder = new google.maps.Geocoder();

function addMarker(feature) {
	var marker = new google.maps.Marker({
	position: feature.position,
	map: map
	});
}


function codeAddress( address ) {

	geocoder.geocode( { 'address' : address }, function( results, status ) {

	if( status == google.maps.GeocoderStatus.OK ) {

		map.setCenter( results[0].geometry.location );

		var marker = new google.maps.Marker( {
			map	 : map,
			position: results[0].geometry.location,

		} );
		marker.setIcon('<?php echo get_stylesheet_directory_uri();?>/img/contributor-icon.png');
	}

	} );
}
<?php
	/* Test data 	  $google_map_locations[] = 'St. Catharines, Ontario, Canada';
	  $google_map_locations[] = 'Ottawa, Ontario, Canada';
	*/
?>
var features = [
	<?php foreach ( $google_map_locations as $location ) { ?>
	{ position: new google.maps.LatLng( codeAddress( '<?php echo $location;?>' ) ) },
	<?php } ?>
];

for (var i = 0, feature; feature = features[i]; i++) {
	addMarker(feature);
}

map.mapTypes.set('map_style', styledMap);
map.setMapTypeId('map_style');

}
</script>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvwRWaA2cVMOJDGB9qz3YaladDBJtApBE&callback=initMap">
</script>


<?php get_footer(); ?>
