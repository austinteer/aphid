// Load plugins
var gulp = require('gulp');
var $ = require('gulp-load-plugins')({
    camelize: true
})
var lr = require('tiny-lr');
var servers = lr();
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var mainBowerFiles = require('main-bower-files');

var src = {
    css: './assets/scss/*.scss',
    js: './assets/js/*.js',
    modzr: './assets/bower_components/modernizr/modernizr.js',
    img: './assets/images/**/*',
    bower: './assets/bower_components'
}

var dest = {
    cssBuild: './assets/scss/build',
    css: './assets/css',
    jsBuild: './assets/js/build',
    js: './assets/js',
    modzr: './assets/js/vendor',
    img: './assets/images'
}

// Styles
gulp.task('styles', function() {
    return gulp.src([src.css])
        .pipe($.plumber())
        .pipe($.rubySass({
            style: 'expanded',
            sourcemap: false
        }))
        .pipe($.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
        .pipe(gulp.dest(dest.cssBuild))
        .pipe($.minifyCss({
            keepSpecialComments: 1
        }))
        .pipe(gulp.dest(dest.css))
        .pipe(reload({
            stream: true
        }))
        .pipe($.notify({
            message: 'Styles task complete'
        }));
});

// Vendor Plugin Scripts
gulp.task('bower-scripts', function() {
    return gulp.src(mainBowerFiles())
        .pipe($.filter('*.js'))
        .pipe(gulp.dest('assets/js/vendor'));
});

gulp.task('modernizr', function() {
    return gulp.src(src.modzr)
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.uglify())
        .pipe(gulp.dest(dest.modzr));
})


// Site Scripts
gulp.task('scripts', ['bower-scripts'], function() {
    return gulp.src([src.js])
        .pipe($.jshint('.jshintrc'))
        .pipe($.jshint.reporter('default'))
        .pipe($.concat('main.js'))
        .pipe(gulp.dest(dest.jsBuild))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.uglify())
        .pipe(gulp.dest(dest.js))
        .pipe(reload({
            stream: true
        }))
        .pipe($.notify({
            message: 'Scripts task complete'
        }));
});

// Images
gulp.task('images', function() {
    return gulp.src([src.img])
        .pipe($.cache($.imagemin({
            optimizationLevel: 7,
            progressive: true,
            interlaced: true
        })))
        .pipe(gulp.dest(dest.img))
        .pipe($.notify({
            message: 'Images task complete'
        }));
});

gulp.task('sync', function() {
    browserSync({
        proxy: {
            host: 'Mamp Host Name'
            //browser: ["google chrome", "firefox"]
        }
    });
    //gulp.watch('*.php', ['styles', browserSync.reload ]);
});

gulp.task('watch', ['sync'], function() {
    $.watch('assets/scss/**/*.scss', function() {
        gulp.start('styles');
    });

    $.watch('assets/js/**/*.js', function() {
        gulp.start('scripts');
    });
    
    $.watch('*.php', function(){
      reload({stream:true});
    });

});

// Default Gulp Task
gulp.task('default', ['styles', 'scripts', 'modernizr', 'images']);
