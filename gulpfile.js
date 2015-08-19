'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concatCSS = require('gulp-concat-css');
var concat = require('gulp-concat');
var watch = require('gulp-watch');
var sourcemaps = require('gulp-sourcemaps');
var minifyCss = require('gulp-minify-css');

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
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap/affix.js'
];

gulp.task('sass', function(){
	gulp.src('assets/scss/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('build/css'));
});

gulp.task('css', function(){
	gulp.src('build/css/*.css')
	.pipe(sourcemaps.init())
	.pipe(minifyCss())
	.pipe(sourcemaps.write('./'))
	.pipe(gulp.dest('build/css/min'));
});

gulp.task('fonts', function(){		
	gulp.src('node_modules/font-awesome/fonts/*')
	.pipe(gulp.dest('build/css/fonts'));
});

gulp.task('js', function(){	
	gulp.src('assets/js/*.js')
		.pipe(concat('js/scripts.js'))
		.pipe(gulp.dest('build'));
	gulp.src(jsFileList)
		.pipe(concat('js/bootstrap.js'))
		.pipe(gulp.dest('build'));
});

gulp.task('img', function() {
	gulp.src('assets/img/*.png')
		.pipe(gulp.dest('build/img'));
	gulp.src('assets/img/*.jpg')
		.pipe(gulp.dest('build/img'));
});

gulp.task('default', ['sass', 'css']);
gulp.task('prod', ['sass', 'css', 'js']);

gulp.task('watch', function(){
	gulp.watch('assets/scss/*.scss', ['sass'] );
	gulp.watch('assets/js/*.js', ['js'] );
})