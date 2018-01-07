/**
 * @variable
 * Declaring all the gulp plugins
 */
var gulp        = require('gulp');
var uglify 		= require('gulp-uglify');
var concat 		= require('gulp-concat');
var sass        = require('gulp-sass');
var prefix      = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var childProcess= require('child_process');

/**
 * @task message
 * message from gulp
 */
gulp.task('message', function(){
	return console.log("gulp is running");
});

/**
 * @task bootstrap
 * Bootstrap4, Jquery and Popper.js
 */
gulp.task('bootstrap', function(){
	gulp.src(['./node_modules/bootstrap/dist/css/bootstrap.min.css',
				'node_modules/bootstrap/dist/css/bootstrap.css'])
		.pipe(gulp.dest('includes/bootstrap/css/'));
	gulp.src(['./node_modules/bootstrap/dist/js/bootstrap.min.js',
				'node_modules/bootstrap/dist/js/bootstrap.js'])
		.pipe(gulp.dest('includes/bootstrap/js/'));
	gulp.src(['./node_modules/jquery/dist/jquery.js',
				'node_modules/jquery/dist/jquery.min.js'])
		.pipe(gulp.dest('includes/jquery/js/'));
	gulp.src(['./node_modules/popper.js/dist/popper.js',
				'node_modules/popper.js/dist/popper.min.js'])
		.pipe(gulp.dest('includes/popper.js/js/'));
});

/**
 * @task fontawesome
 * Fontawesome files and fonts copy
 */
gulp.task('fontawesome', function(){
	gulp.src(['./node_modules/font-awesome/css/*.css'])
		.pipe(gulp.dest('includes/font-awesome/css/'));
	gulp.src(['./node_modules/font-awesome/fonts/*.*'])
		.pipe(gulp.dest('includes/font-awesome/fonts/'));
});

/**
 * @task angular
 * angular
 */
gulp.task('angular', function(){
	gulp.src(['./node_modules/angular/angular.js', 
			'./node_modules/angular/angular.min.js'])
		.pipe(gulp.dest('includes/angular/js/'));
});

/**
 * @task browser-sync
 * browser-sync to the server
 */
gulp.task('browser-sync', function() {
  browserSync.init({
    proxy: 'http://localhost:8888/uniservice/'
  });
});

/**
 * @task sass
 * sass for generating css
 */
 gulp.task('sass', function () {
    gulp.src(['./sass/**/*.scss', './sass/*.scss'])
    	.pipe(sourcemaps.init())
	    .pipe(sass().on('error', sass.logError))
	    .pipe(prefix(['last 3 versions', '> 1%', 'ie 8'], { cascade: true }))
	    .pipe(sourcemaps.write('./'))
	    .pipe(gulp.dest('./css/'))
	    .pipe(browserSync.reload({stream:true}));

});

/**
 * @task clearcache
 * Clear all caches
 */
gulp.task('clearcache', function(done) {
  return childProcess.spawn('drush', ['cache-rebuild'], {stdio: 'inherit'})
  .on('close', done);
});

/**
 * @task reload
 * Refresh the page after clearing cache
 */
gulp.task('reload', ['clearcache'], function () {
  browserSync.reload();
});

/**
 * @task watch
 * Watch for any changes
 */
gulp.task('watch', function(){
  gulp.watch(['./sass/**/*.scss', './sass/*.scss'], ['sass']);
  gulp.watch(['./js/**/*.js', './js/*.js'], ['reload']); 
  gulp.watch(['./templates/*.html.twig', './templates/*.twig'], ['reload']); 
  gulp.watch(['./images/**/*', './images/*'], ['reload']); 
});

/**
 * @task default
 * default task runner
 */
 gulp.task('default', ['bootstrap','fontawesome','angular','browser-sync','sass','watch']);

/**
 * @note 
 * to run type 'gulp' and to close 'ctrl+c'
 */