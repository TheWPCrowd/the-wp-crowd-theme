var my_theme = my_theme || {};

(function( $ ) {

	my_theme.main = (function( theme ) {
		$(document).ready(function(){
			console.log('My Starter Theme');

			$(".nav-toggle").click( function() {
				$("nav.main-nav ul").toggle();
			});

			if( $('body').hasClass('single-podcast') ) {
                ezdata.lib.create_item( 7, {value: 1, misc_three: $('h2.single-title').text()  });
			}

		});

		theme.map_init = function() {
			var geocoder = new google.maps.Geocoder();
			var myLatLng = {lat: 40.11032, lng: -56.06297};

			var styles = [{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#fffffa"}]},{"featureType":"water","stylers":[{"lightness":50}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"lightness":40}]}];

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 4,
				center: myLatLng,
				streetViewControl: false,
				disableDefaultUI: true,
				scrollwheel: false,
			});
			map.setOptions({styles: styles});

			$.each( $('.contributor-wrapper'), function( key, value ) {
				if( !$(this).data('loc') ) {
					return true;
				}
				geocoder.geocode( { 'address': $(this).data('loc')}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location
						});
					} else {
						console.log("Geocode was not successful for the following reason: " + status, $(this).data('loc') );
					}
				});
			});
		};

		return theme;

	}( my_theme.main || {} ))
	
}(jQuery));

function initMap() {
	my_theme.main.map_init();
}