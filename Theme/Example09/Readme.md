Drupal 8 theme development using Bootstrap, sass, gulp, browsersync, font-awesome and angularjs.

1. Presumed that you have "nodejs" installed in your machine. to check 

terminal
--------
```
> node -v
> v8.4.0
```

2. Then goto to the folder where you want to install all these (Bootstrap, sass, gulp, browsersync, font-awesome and angular). Here you need to init node package manager which will create "package.json". This json file will contain all the package information for you like package name and version. 

terminal
--------
```
~/Sites/uniservice/themes/custom/myth$> npm init --y
```

package.json
------------
```json
{
  "name": "myth",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC"
}
```

3. At frist we will install "Bootstrap". To do this goto "Bootstrap" website then documentation and then download section of that page. 

We will download all this package using "npm".

terminal
--------
```
> npm install bootstrap@4.0.0-beta.3 --save-dev
> npm install jquery popper.js --save-dev
```

"jquery" and "popper.js" has dependency over bootstrap for that reason we need to download those components too. 

Notice that "--save-dev" is used for "devDependencies" and "--save" for "dependencies".

4. After that we will install "font-awesome".

terminal
--------
```
> npm install font-awesome --save-dev
```

5. Rigth after that we will install sass and browsersync at a time.

terminal
--------
```
> npm install browser-sync gulp-sass --save-dev
```

6. Next we will install "gulp" globally. Which will help you run gulp anywhere from your system.

terminal
--------
```
> sudo npm install gulp-cli -g
```

7. Next we will install "gulp" locally with some useful plugins.

terminal
--------
```
> npm install gulp -save-dev
> npm install gulp-uglify -save-dev
> npm install gulp-concat -save-dev
```

Here "gulp-uglify" will help to minified the javascript file and "gulp-concat" will concate two files content in one file. For more plugins visit "https://gulpjs.com/plugins/"

8. Finally installing "agularjs"

terminal
--------
```
> npm install angular --save-dev
```

After isntalling all of the package, the "package.json" will look llike 

package.json
-------------
```json
{
  "name": "myth",
  "version": "1.0.0",
  "description": "",
  "main": "gulpfile.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "devDependencies": {
    "angular": "^1.6.8",
    "bootstrap": "^4.0.0-beta.3",
    "browser-sync": "^2.23.2",
    "child_process": "^1.0.2",
    "font-awesome": "^4.7.0",
    "gulp": "^3.9.1",
    "gulp-concat": "^2.6.1",
    "gulp-sass": "^3.1.0",
    "gulp-uglify": "^3.0.0",
    "jquery": "^3.2.1",
    "popper.js": "^1.12.9"
  }
}
```

9. Now we need "gulpfile.js" in our theme root directory "myth".

terminal
--------
```
~/Sites/uniservice/themes/custom/myth$> touch gulpfile.js
```

gulpfile.js
------------
```javascript
/**
 * @variable
 * Declaring all the gulp plugins
 */
var gulp        = require('gulp');
var uglify 		= require('gulp-uglify');
var concat 		= require('gulp-concat');
var sass        = require('gulp-sass');
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
    gulp.src('./sass/**/*.scss')
	    .pipe(sass().on('error', sass.logError))
	    .pipe(gulp.dest('./css/'))
	    .pipe(browserSync.stream());
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
 * Watch for make changes
 */
gulp.task('watch',['browser-sync','sass','clearcache'], function(){
  gulp.watch(['./scss/**/*.scss', 'scss/*.scss'], ['sass']);
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
```

