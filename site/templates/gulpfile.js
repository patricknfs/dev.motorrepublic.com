var gulp = require('gulp'),
  sourcemaps = require('gulp-sourcemaps'),
  sass = require('gulp-sass'),
  autoprefixer = require('gulp-autoprefixer'),
  cleancss = require('gulp-clean-css'),
  cssnano = require('gulp-cssnano'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename'),
  concat = require('gulp-concat'),
  notify = require('gulp-notify'),
  cache = require('gulp-cache'),
  sftp = require("gulp-sftp"),
  del = require('del');


gulp.task('styles', function () {
  gulp.src('styles/styles.scss')
  .pipe(sass())
  .pipe(gulp.dest('styles'))
  .pipe(cssnano())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('styles'))
  .pipe(notify({ message: 'Styles task complete' }));
});

gulp.task('scripts', function() {
  return gulp.src([
    'scripts/jquery.fullPage.js',
    'scripts/detectmobilebrowser.js',
    'scripts/readmore.js',
    'scripts/topbar.js',
    'scripts/magnific.js',
    'scripts/main.js'
  ])
  // .pipe(jshint('.jshintrc'))
  // .pipe(jshint.reporter('default'))
  .pipe(concat('built.js'))
  // .on('error', function(err){ console.log(err.message); })
  .pipe(gulp.dest('scripts/'))
  // .on('error', function(err){ console.log(err.message); })
  .pipe(rename({suffix: '.min'}))
  // .on('error', function(err){ console.log(err.message); })
  .pipe(uglify())
  // .on('error', function(err){ console.log(err.message); })
  .pipe(gulp.dest('scripts/'))
  // .on('error', function(err){ console.log(err.message); })
  .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('watch', function() {
  // Watch style files
  gulp.watch(['styles/*.scss','styles/*.sass'], ['styles']);
  // Watch javascript files
  gulp.watch(['scripts/*.js'], ['scripts']);
});