var browserify = require('browserify');
var gulp = require('gulp');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var log = require('gulplog');
var babelify = require('babelify');
var less = require('gulp-less');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var less = require('gulp-less');
var postcss = require('gulp-postcss');
var strip = require('gulp-strip-css-comments');
var cleancss = require('gulp-clean-css');
var rename = require('gulp-rename');

gulp.task('browserify', function () 
{    
  // set up the browserify instance on a task basis
  var b = browserify({
    entries: ['./demo/js/demo_basic.js'], // Source name
    debug: true,
    paths: ['./node_modules']
  });

  return b
    .transform(babelify, {
        "global": true
        ,"presets": [
            "@babel/env"
          ]
        ,"plugins" : [
            "@babel/plugin-transform-arrow-functions"
          ]
        ,sourceMaps:true
    })
    .bundle()   
    .pipe(source('test_basic.demo.min.js'))// Resulting filename
    .pipe(buffer())
    
    .pipe(sourcemaps.init({loadMaps: true}))
    // Add transformation tasks to the pipeline here.
    
    .pipe(uglify())
    .on('error', log.error)
    .pipe(sourcemaps.write('./demo/js'))
    .pipe(gulp.dest('./demo/js'));
});

gulp.task('less', function () {
  
  var processors = [
     autoprefixer,
     cssnano
  ];
  return gulp.src('./demo/less/styles.less')
    .pipe(less({
         relativeUrls: true,
         sourceMap: true,
    }).on('error', function (err) {
        console.log("lessStream error:");
        console.log(err);
    }))
    .pipe(postcss(processors))    
    .pipe(strip())
    .pipe(cleancss({
            compatibility: 'ie11',
            inline:['none'],
            rebase: false,
            debug: true
        },(details) => {
        console.log(`${details.name} originalsize: ${details.stats.originalSize}`);
        console.log(`${details.name} minifiedsize: ${details.stats.minifiedSize}`);
      }).on('error', function(err) {
          console.error(err);
      }))
    .pipe(rename('style.css'))    
    .pipe(gulp.dest('./demo/css/'));
});