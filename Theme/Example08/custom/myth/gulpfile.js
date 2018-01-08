/**
 * @variable
 * Declaring all the gulp plugins
 */
var gulp        = require('gulp');
var uglify 		= require('gulp-uglify');
var concat 		= require('gulp-concat');
var sass        = require('gulp-sass');
var prefix      = require('gulp-autoprefixer');
var sourcemaps 	= require('gulp-sourcemaps');
var file 		= require("gulp-file");
var fileExists  = require('file-exists');

var browserSync = require('browser-sync').create();
var childProcess= require('child_process');

var attach = "@import 'abstracts/_functions.scss';\n@import 'abstracts/_mixins.scss';\n@import 'abstracts/_placeholders.scss';\n@import 'abstracts/_variables.scss';\n\n@import 'base/_typography.scss';\n@import 'base/_reset.scss';\n\n@import 'components/_buttons.scss';\n@import 'components/_cover.scss';\n@import 'components/_dropdown.scss';\n@import 'components/_carousel.scss';\n\n@import 'layout/_footer.scss';\n@import 'layout/_forms.scss';\n@import 'layout/_header.scss';\n@import 'layout/_sidebar.scss';\n@import 'layout/_grid.scss';\n@import 'layout/_navigation.scss';\n\n@import 'pages/_home.scss';\n@import 'pages/_contact.scss';\n\n@import 'themes/_theme.scss';\n@import 'themes/_admin.scss';\n\n@import 'vendors/_bootstrap.scss';\n@import 'vendors/_jquery-ui.scss';";
var list = {
    "sass": [{
            "Folder": "abstracts",
            "Files": [{
                    "file": "_variables.scss",
                    "content": "// Sass Variables"
                },
                {
                    "file": "_functions.scss",
                    "content": "// Sass Functions"
                },
                {
                    "file": "_mixins.scss",
                    "content": "// Sass Mixins"
                },
                {
                    "file": "_placeholders.scss",
                    "content": "// Sass Placeholders"
                }
            ]
        },
        {
            "Folder": "base",
            "Files": [{
                    "file": "_reset.scss",
                    "content": "// Reset/normalize"
                },
                {
                    "file": "_typography.scss",
                    "content": "// Typography rules"
                }
            ]
        },
        {
            "Folder": "components",
            "Files": [{
                    "file": "_buttons.scss",
                    "content": "// Buttons"
                },
                {
                    "file": "_carousel.scss",
                    "content": "// Carousel"
                },
                {
                    "file": "_cover.scss",
                    "content": "// Cover"
                },
                {
                    "file": "_dropdown.scss",
                    "content": "// Dropdown"
                }
            ]
        },
        {
            "Folder": "layout",
            "Files": [{
                    "file": "_navigation.scss",
                    "content": "// Navigation"
                },
                {
                    "file": "_grid.scss",
                    "content": "// Grid system"
                },
                {
                    "file": "_header.scss",
                    "content": "// Header"
                },
                {
                    "file": "_footer.scss",
                    "content": "// Footer"
                },
                {
                    "file": "_sidebar.scss",
                    "content": "// Sidebar"
                },
                {
                    "file": "_forms.scss",
                    "content": "// Forms"
                }
            ]
        },
        {
            "Folder": "pages",
            "Files": [{
                    "file": "_home.scss",
                    "content": "// Home specific styles"
                },
                {
                    "file": "_contact.scss",
                    "content": "// Contact specific styles"
                }
            ]
        },
        {
            "Folder": "themes",
            "Files": [{
                    "file": "_theme.scss",
                    "content": "// Default theme"
                },
                {
                    "file": "_admin.scss",
                    "content": "// Admin theme"
                }
            ]
        },
        {
            "Folder": "vendors",
            "Files": [{
                    "file": "_bootstrap.scss",
                    "content": "// Bootstrap"
                },
                {
                    "file": "_jquery-ui.scss",
                    "content": "// jQuery UI"
                }
            ]
        }
    ]
};

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
 * @task sassfolderstructure
 * Create sass folder structure
 */
gulp.task('sassfolderstructure', function() {

	fileExists('./sass/site.scss').then(exists => {
	  if(!exists)
	   list.sass.forEach(function(obj) {
	        	obj.Files.forEach(function(objj) {
	            file('_attach.scss', attach, { src: true }).pipe(gulp.dest('./sass/'));
	            file('site.scss', "@import '_attach.scss';", { src: true }).pipe(gulp.dest('./sass/'));
	            return file(objj.file, objj.content, { src: true }).pipe(gulp.dest('./sass/'+obj.Folder+"/"));
	        });
	   });	
	});

});

/**
 * @task sass
 * sass for generating css
 */
 gulp.task('sass', function () {
 	setTimeout(function() {
   		return gulp.src(['./sass/**/*.scss', './sass/*.scss'])
    	.pipe(sourcemaps.init())
	    .pipe(sass({errLogToConsole: true}))
	    .pipe(prefix(['last 3 versions', '> 1%', 'ie 8'], { cascade: true }))
	    .pipe(sourcemaps.write('./'))
	    .pipe(gulp.dest('./css'))
	    .pipe(browserSync.reload({stream:true}));
	}, 3000);
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
gulp.task('watch',['sassfolderstructure','bootstrap','fontawesome','angular','browser-sync','sass'], function(){
  gulp.watch(['./sass/**/*.scss', './sass/*.scss'], ['sass']);
  gulp.watch(['./js/**/*.js', './js/*.js'], ['reload']); 
  gulp.watch(['./templates/*.html.twig', './templates/*.twig'], ['reload']); 
  gulp.watch(['./images/**/*', './images/*'], ['reload']); 
});

/**
 * @task default
 * default task runner
 */
 gulp.task('default', ['sassfolderstructure','bootstrap','fontawesome','angular','browser-sync','sass','watch']);

/**
 * @note 
 * to run type 'gulp' and to close 'ctrl+c'
 */