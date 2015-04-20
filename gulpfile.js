var gulp = require('gulp');
var sass = require('gulp-sass');
var concatCSS = require('gulp-concat-css');
var concat = require('gulp-concat');
var watch = require('gulp-watch');

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
		.pipe(sass())
		.pipe(gulp.dest('build/css'));
	gulp.src('build/css/*.css')
		.pipe(concatCSS('css/styles.css'))
		.pipe(gulp.dest('build'));
});

gulp.task('js', function(){	
	gulp.src('assets/js/*.js')
		.pipe(concat('js/scripts.js'))
		.pipe(gulp.dest('build'));
	
	gulp.src(jsFileList)
		.pipe(concat('js/bootstrap.js'))
		.pipe(gulp.dest('build'));
})

gulp.task('default', ['sass', 'js']);

gulp.task('watch', function(){
	gulp.watch('assets/scss/*.scss', ['sass'] );
	gulp.watch('assets/js/*.js', ['js'] );
})