'use strict';
var gulp = require( 'gulp' ),

<<<<<<< HEAD
var gulp = require('gulp'),
	sass = require('gulp-sass'),
	concatCSS = require('gulp-concat-css'),
	concat = require('gulp-concat'),
	watch = require('gulp-watch'),
	sourcemaps = require('gulp-sourcemaps'),
	minifyCss = require('gulp-minify-css'),
	lr = require('gulp-livereload');
=======
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
>>>>>>> origin/v2-build

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

<<<<<<< HEAD
gulp.task('sass', function(){
	gulp.src('assets/scss/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(lr())
		.pipe(gulp.dest('build/css'));
});

gulp.task('css', function(){
	gulp.src('build/css/*.css')
	.pipe(sourcemaps.init())
	.pipe(minifyCss())
	.pipe(sourcemaps.write('./'))
	.pipe(lr())
	.pipe(gulp.dest('build/css/min'));
});
=======
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

>>>>>>> origin/v2-build

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

<<<<<<< HEAD
gulp.task('js', function(){	
	gulp.src('assets/js/*.js')
		.pipe(concat('js/scripts.js'))
		.pipe(lr())
		.pipe(gulp.dest('build'));
	gulp.src(jsFileList)
		.pipe(concat('js/bootstrap.js'))
		.pipe(lr())
		.pipe(gulp.dest('build'));
});
=======
gulp.task( 'fonts', function () {
	gulp.src( './node_modules/font-awesome/fonts/*' )
		.pipe( gulp.dest( './build/fonts' ) );
} );
>>>>>>> origin/v2-build

gulp.task( 'default', [ 'fonts', 'sass', 'js' ], function () {
	// Listen on port 35729
    lr.listen(35729, function (err) {
        if (err) {
            return console.log(err)
        };

		gulp.watch( './assets/scss/**/*.scss', [ 'sass' ] );
		gulp.watch( jsFileList, [ 'js' ] );
	});

<<<<<<< HEAD
gulp.task('watch', function(){

	// Listen on port 35729
    lr.listen(35729, function (err) {
        if (err) {
            return console.log(err)
        };

	gulp.watch('assets/scss/*.scss', ['default'] );
	gulp.watch('assets/js/*.js', ['js'] );

	});
	
})
=======
} );
>>>>>>> origin/v2-build
