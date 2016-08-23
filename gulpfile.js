require('es6-promise').polyfill();

var gulp          = require('gulp'),
    sass          = require('gulp-sass'),
   
    autoprefixer  = require('gulp-autoprefixer'),
    plumber       = require('gulp-plumber'),
    gutil         = require('gulp-util'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    //jshint        = require('gulp-jshint'),
    uglify        = require('gulp-uglify'),
    imagemin      = require('gulp-imagemin');
   
   var gulp_src = gulp.src;
   
gulp.src = function() {
  return gulp_src.apply(gulp, arguments)
    .pipe(plumber(function(error) {
      
      gutil.log(gutil.colors.red('Error (' + error.plugin + '): ' + error.message));
      
      this.emit('end');
    })
  );
};

gulp.task('sass', function() {
  return gulp.src('./sass/**/*.scss')
  .pipe(plumber({ errorHandler: gulp_src }))
  .pipe(sass())
  .pipe(autoprefixer())
  .pipe(gulp.dest('./'))
});


gulp.task('js', function() {
  return gulp.src(['./js/*.js'])
  //.pipe(jshint())
  //.pipe(jshint.reporter('default'))
  .pipe(concat('app.js'))
  .pipe(rename({suffix: '.min'}))
  .pipe(uglify())
  .pipe(gulp.dest('./js'));
});


gulp.task('images', function() {
  return gulp.src('./images/src/*')
  .pipe(plumber({ errorHandler: gulp_src }))
  .pipe(imagemin({ optimizationLevel: 7, progressive: true }))
  .pipe(gulp.dest('./images/dist'));
});


gulp.task('watch', function() {
 
  gulp.watch('./sass/**/*.scss', ['sass']);
  gulp.watch('./js/*.js', ['js']);
  gulp.watch('images/src/*', ['images']);
});

gulp.task('default', ['sass', 'js', 'images', 'watch']);
