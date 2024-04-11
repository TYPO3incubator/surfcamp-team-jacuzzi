const concat      = require('gulp-concat');
const terser      = require('gulp-terser');
const sourcemaps  = require('gulp-sourcemaps');
const {src, dest} = require('gulp');
const minify      = require('gulp-minify');
const {watch}     = require('gulp');
const concatCss   = require('gulp-concat-css');
const sass        = require('gulp-sass')(require('sass'));

/**
 * Theme Path
 */
const baseThemePath = './local_packages/psi/';

/**
 * all Js Files
 *
 * the order of explicit added filenames is important
 * if you also use a *-selector the file will not be included twice
 *
 * @type {string[]}
 */
const baseJsPath = [
    baseThemePath + 'Resources/Private/JavaScript/*.js',
];
/**
 * JS compiler
 *
 * @type {string[]}
 */
function scripts() {
    return src(baseJsPath)
        .pipe(sourcemaps.init())
        .pipe(concat('main.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(minify({
                         ext:         {
                             min: '.min.js'
                         },
                         ignoreFiles: ['-min.js']
                     }))
        .pipe(dest(baseThemePath + 'Resources/Public/JavaScript/'));
}

exports.scripts = scripts;

/**
 * SCSS compiler
 *
 * @type {string[]}
 */
const baseSrcFile = baseThemePath + 'Resources/Private/Scss/main.scss';

function styles() {
    return src(baseSrcFile)
        .pipe(sass())
        .pipe(sourcemaps.init())
        .pipe(concatCss('style.css'))
        .pipe(minify())
        .pipe(sourcemaps.write('.'))
        .pipe(dest(baseThemePath + 'Resources/Public/Css/'))
}
exports.styles = styles;

/**
 * Assets Watcher
 */
exports.watch = function () {
    watch(baseThemePath + 'Resources/Private/Scss/**/*.scss', styles);
    watch(baseThemePath + 'Resources/Private/JavaScript/**/*.js', scripts);
};
