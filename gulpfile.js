// gulpfile.js
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');

// Paths
const paths = {
  scss: './scss/**/*.scss',
  js: './js/pegasus-custom.js',

  dist: './dist',
};

// Compile SCSS with Bootstrap and Custom Overrides
function compileSCSS() {
  return gulp
    .src([
      './scss/main.scss',
      //'./inc/bootstrap/scss/**/*.scss',
    ])
    .pipe(sourcemaps.init())
    .pipe(sass(
      {quietDeps: true}
    ).on('error',
      sass.logError
    ))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.dist + '/css'));
}

// Concatenate and Minify JS
function minifyJS() {
  return gulp
    .src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    //.pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.dist + '/js'));
}

// Watch files
function watchFiles() {
  gulp.watch(
    [
      paths.scss,
      //paths.bootstrap
    ],
    compileSCSS
  );
  gulp.watch(paths.js, minifyJS);
}

// Define complex tasks
const build = gulp.series(
  gulp.parallel(
    compileSCSS,
    minifyJS
  )
);
const watch = gulp.series(build, watchFiles);

// Export tasks
exports.compileSCSS = compileSCSS;
exports.minifyJS = minifyJS;
exports.build = build;
exports.watch = watch;
exports.default = build;
