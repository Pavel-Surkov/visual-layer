'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const browserSync = require('browser-sync').create();
const del = require('del');

sass.compiler = require('node-sass');

gulp.task('styles', function () {
  return gulp
    .src('app/scss/main.scss')
    .pipe(sass())
    .pipe(concat('application.css'))
    .pipe(postcss([autoprefixer()]))
    .pipe(gulp.dest('public/css/'));
});

gulp.task('scripts', function () {
  return gulp
    .src(['app/js/plugins.js', 'app/js/main.js'])
    .pipe(concat('application.js'))
    .pipe(gulp.dest('public/js/'));
});

gulp.task('clean', function () {
  return del('public');
});

gulp.task('assets', function () {
  return gulp
    .src('app/assets/**', { since: gulp.lastRun('assets') })
    .pipe(gulp.dest('public'));
});

gulp.task('php', function () {
  return gulp
    .src('app/send-form.php', { since: gulp.lastRun('php') })
    .pipe(gulp.dest('public'));
});

gulp.task('phpmailer', function () {
  return gulp
    .src('app/phpmailer/**', { since: gulp.lastRun('phpmailer') })
    .pipe(gulp.dest('public/phpmailer'));
});

gulp.task(
  'build',
  gulp.series(
    'clean',
    gulp.parallel('styles', 'scripts', 'assets', 'php', 'phpmailer')
  )
);

gulp.task('watch', function () {
  gulp.watch('app/scss/**/*.*', gulp.series('styles'));
  gulp.watch('app/js/**/*.*', gulp.series('scripts'));
  gulp.watch('app/assets/**/*.*', gulp.series('assets'));
  gulp.watch('app/send-form.php', gulp.series('php'));
  gulp.watch('app/phpmailer/*.*', gulp.series('phpmailer'));
});

gulp.task('serve', function () {
  browserSync.init({
    server: 'public',
  });
  browserSync.watch('public/**/*.*').on('change', browserSync.reload);
});

gulp.task('dev', gulp.series('build', gulp.parallel('watch', 'serve')));
