const {src, dest, series} = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');

function styles() {
  return src('./resources/assets/styles/main.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(dest('./public/build/css/'));
}

function scripts() {
  return src('./resources/assets/js/main.js')
    .pipe(uglify())
    .pipe(dest('./public/build/js/'));
}

function markdownStyles() {
  return src('./resources/assets/markdown/editor.css')
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(dest('./public/build/markdown/'));
}

function markdownScripts() {
  return src('./resources/assets/markdown/editor.js')
    .pipe(uglify())
    .pipe(dest('./public/build/markdown/'));
}

exports.build = series(styles, scripts, markdownStyles, markdownScripts);
