'use strict';
var gulp = require( 'gulp' ),

	autoprefixer = require( 'gulp-autoprefixer' ),
	concat = require( 'gulp-concat' ),
	minify = require( 'gulp-minify-css' ),
	notify = require( 'gulp-notify' ),
	rename = require( 'gulp-rename' ),
	sass = require( 'gulp-sass' ),
	sourcemaps = require( 'gulp-sourcemaps' ),
	uglify = require( 'gulp-uglify' ),
	lr = require('gulp-livereload'),
	watch = require( 'gulp-watch' );

var jsFileList = [
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/button.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/carousel.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/popover.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
	'assets/js/theme-script.js',
];

gulp.task( 'sass', function () {
	gulp.src( './assets/scss/**/*.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass().on( 'error', notify.onError( function ( error ) {
			return error.message;
		} ) ) )
		.pipe( autoprefixer( {
			browsers : [ 'last 2 versions' ],
			cascade  : false
		} ) )
		.pipe( gulp.dest( './build/css' ) )
		.pipe( minify() )
		.pipe( rename( { extname : '.min.css' } ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(lr())
		.pipe( gulp.dest( './build/css' ) )
		.pipe( notify( { message : '[dev] CSS task complete', onLast : true } ) );
} );


gulp.task( 'js', function () {
	return gulp.src( jsFileList )
		.pipe( sourcemaps.init() )
		.pipe( concat( { path : 'scripts.js' } ) )
		.pipe( gulp.dest( './build/js' ) )
		.pipe( uglify() )
		.pipe( rename( { extname : '.min.js' } ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(lr())
		.pipe( gulp.dest( './build/js' ) )
		.pipe( notify( { message : '[dev] JS task complete', onLast : true } ) );
} );

gulp.task( 'analytics', function() {
	return gulp.src( './assets/js/google-analytics.js' )
		.pipe( gulp.dest( './build/js' ) );
});

gulp.task( 'fonts', function () {
	gulp.src( './node_modules/font-awesome/fonts/*' )
		.pipe( gulp.dest( './build/fonts' ) );
} );

gulp.task('build', function(){
	gulp.src( jsFileList )
		.pipe( sourcemaps.init() )
		.pipe( concat( { path : 'scripts.js' } ) )
		.pipe( gulp.dest( './build/js' ) )
		.pipe( uglify() )
		.pipe( rename( { extname : '.min.js' } ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(lr())
		.pipe( gulp.dest( './build/js' ) );

	gulp.src( './assets/scss/**/*.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass().on( 'error', notify.onError( function ( error ) {
			return error.message;
		} ) ) )
		.pipe( autoprefixer( {
			browsers : [ 'last 2 versions' ],
			cascade  : false
		} ) )
		.pipe( gulp.dest( './build/css' ) )
		.pipe( minify() )
		.pipe( rename( { extname : '.min.css' } ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(lr())
		.pipe( gulp.dest( './build/css' ) );
});

gulp.task( 'default', [ 'fonts', 'sass', 'js', 'analytics' ], function () {
	// Listen on port 35729
    lr.listen(35729, function (err) {
        if (err) {
            return console.log(err)
        };

		gulp.watch( './assets/scss/**/*.scss', [ 'sass' ] );
		gulp.watch( jsFileList, [ 'js' ] );
	});

} );