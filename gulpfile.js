var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    browserSync  = require('browser-sync')
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglifyjs'),
    autoprefixer = require('gulp-autoprefixer'),
    connectPHP   = require('gulp-connect-php');


// Обработка Sass-файлов
gulp.task('sass', function() {
    return gulp.src('web/sass/main.sass')
    .pipe(sass())
    .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7', {cascade: true}]))
    .pipe(gulp.dest('web/css'))
    .pipe(browserSync.reload({stream: true}))
});

// Обновление PHP-файлов
gulp.task('updatePHP', function() {
    return gulp.src([
        'assets/AppAsset.php',
        'config/*.php',
        'controllers/**/*.php',
        'models/**/*.php',
        'view/**/*.php',
        'web/**/*.php'
    ])
    .pipe(browserSync.reload({stream: true}))
});

/**
 * Объединение и минимизация JS-файлов
 */
// gulp.task('oneScript', function() {
//     return gulp.src([
//         'app/libs/jquery/dist/jquery.min.js',
//         'app/libs/slick-1.8.1/slick/slick.min.js',
//         'app/libs/bootstrap4/dist/js/bootstrap.min.js',
//         'app/js/common.js'
//     ])
//     .pipe(concat('scripts.min.js'))
//     .pipe(uglify())
//     .pipe(gulp.dest('app/js'))
//     .pipe(browserSync.reload({stream: true}))
// });

// Синхронизация с браузером
gulp.task('browser-sync', function() {
    browserSync({
        notify: false,
        proxy: 'hte'
    });
});

gulp.task('watch', function() {
    //gulp.watch(['libs/**/*.min.js', 'app/js/common.js'], gulp.parallel('oneScript'));
    gulp.watch('web/sass/*.sass', gulp.parallel('sass'));
    gulp.watch(['controllers/**/*.php' ,'models/**/*.php', 'views/**/*php'], gulp.parallel('updatePHP'));
});

gulp.task('default', gulp.parallel('browser-sync', 'watch'));