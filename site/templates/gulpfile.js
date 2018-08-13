var gulp = require('gulp'),
  sass = require('gulp-sass'),
  cssnano = require('gulp-cssnano'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename'),
  concat = require('gulp-concat'),
  notify = require('gulp-notify')


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
    'scripts/chenais_nav.js',
    'scripts/main.js'
  ])
  .pipe(concat('built.js'))
  // .on('error', function(err){ console.log(err.message); })
  .pipe(gulp.dest('scripts/'))
  .pipe(rename({suffix: '.min'}))
  .pipe(uglify())
  .pipe(gulp.dest('scripts/'))
  .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('watch', function() {
  // Watch style files
  gulp.watch(['styles/*.scss','styles/*.sass'], ['styles']);
  // Watch javascript files
  gulp.watch(['scripts/*.js'], ['scripts']);
});