var fs = require('fs');
var path = require('path');
var del = require('del');
var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var coffee = require('gulp-coffee');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');

// Temporary solution until gulp 4
// https://github.com/gulpjs/gulp/issues/355
var runSequence = require('run-sequence');

/**
 * Using different folders/file names? Change these constants:
 */
var BUILD_PATH = './public';
var SOURCE_PATH = './app/assets';
var DEBUG_MODE = false;

// list paths of vendor files
var vendors = {
    //'phaser/dist/phaser.min.js': SCRIPTS_PATH,
    'normalize.css/normalize.css': '/css'
};

/**
 * Copy vendor files
 */
gulp.task('copy:vendor', function () {
    var srcList = Object.keys(vendors).map(function (file) {
        return './node_modules/' + file;
    });

    var destPath = function (file) {
        var key = file.path.replace(/^(.*)\/node_modules\//, '');
        return BUILD_PATH + vendors[key];
    };

    return gulp.src(srcList)
        .pipe(gulp.dest(destPath));
});

/**
 * Minify CSS files
 */
gulp.task('build:css', function () {
    return gulp.src(SOURCE_PATH + '/css/**/*.css')
        .pipe(sourcemaps.init())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(concat('app1.min.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(BUILD_PATH + '/css'));
});

/**
 * Compile and minify SASS files
 */
gulp.task('build:sass', function () {
    return gulp.src(SOURCE_PATH + '/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(concat('app2.min.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(BUILD_PATH + '/css'));
});

/**
 * Compile javascript files
 */
gulp.task('build:js', function () {
    return gulp.src(SOURCE_PATH + '/js/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('app1.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(BUILD_PATH + '/js'));
});

/**
 * Transforms ES2015 code into ES5 code.
 * Optionally: Creates a sourcemap file 'app.js.map' for debugging.
 */
gulp.task('build:es6', function () {
    return gulp.src(SOURCE_PATH + '/scripts/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(babel({presets: ['es2015']}))
        .pipe(uglify())
        .pipe(concat('app2.min.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(BUILD_PATH + '/js'));
});

/**
 * Compile CoffeeScript files
 */
gulp.task('build:coffee', function () {
    return gulp.src(SOURCE_PATH + '/scripts/**/*.coffee')
        .pipe(sourcemaps.init())
        .pipe(coffee())
        .pipe(uglify())
        .pipe(concat('app3.min.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(BUILD_PATH + '/js'));
});

gulp.task('clean', function (cb) {
    return del([
        BUILD_PATH + '/css',
        BUILD_PATH + '/js',
    ]);
});

gulp.task('build', function (cb) {
    return runSequence(
        ['clean'],
        ['build:sass', 'build:css', 'build:js', 'build:es6', 'build:coffee', 'copy:vendor'],
        cb
    );
});

gulp.task('watch', ['build'], function () {
    gulp.watch(SOURCE_PATH + '/css/**/*.css', ['build:css']);
    gulp.watch(SOURCE_PATH + '/sass/**/*.scss', ['build:scss']);
    gulp.watch(SOURCE_PATH + '/js/**/*.js', ['build:js']);
    gulp.watch(SOURCE_PATH + '/scripts/**/*.js', ['build:es6']);
    gulp.watch(SOURCE_PATH + '/scripts/**/*.coffee', ['build:coffee']);
});

gulp.task('default', ['watch']);