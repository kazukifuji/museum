const browserSync = require('browser-sync'),
      gulp = require('gulp'),
      gulpConnectPHP = require('gulp-connect-php'),
      gulpRename = require('gulp-rename'),
      gulpSass = require('gulp-sass'),
      gulpSassGlob = require('gulp-sass-glob'),
      webpack = require('webpack'),
      webpackConfig = require('./webpack.config'),
      webpackStream = require('webpack-stream');

const tasks = {
  watch: function(done) {
    gulpConnectPHP.server(
      /*--------------
      各自環境に設定
      ---------------*/
      {
        port: '',
        hostname: '192.168.1.10/test-wp',
        base: '/var/www/html/test-wp',
      },
      function() {
        browserSync.init({
          proxy: '192.168.1.10/test-wp',
          port: '8080',
          host: '192.168.1.10',
        });
      }
    );

    //sass, editorStyle
    gulp.watch('./src/sass/**/*.scss')
        .on( 'change', gulp.series(
            gulp.parallel( tasks.sass, tasks.editorStyle ),
            tasks.browserReload
        ) );
    //js
    gulp.watch('./src/js/**/*.js')
        .on( 'change', gulp.series(tasks.js, tasks.browserReload) );
    //php
    gulp.watch('./**/*.php')
        .on('change', gulp.series(tasks.browserReload) );

    done();
  },

  sass: function() {
    return (
      gulp.src('./src/sass/index.scss')
          .pipe( gulpSassGlob() )
          .pipe(
            gulpSass({ outputStyle: 'expanded' }).on('error', gulpSass.logError)
          )
          .pipe( gulpRename('style.css') )
          .pipe( gulp.dest('./dist/css') )
    );
  },

  editorStyle: function() {
    return (
      gulp.src('./src/sass/editor-style.scss')
          .pipe( gulpSassGlob() )
          .pipe(
            gulpSass({ outputStyle: 'expanded' }).on('error', gulpSass.logError)
          )
          .pipe( gulp.dest('./dist/css') )
    );
  },

  js: function() {
    return (
      webpackStream(webpackConfig, webpack).on('error', function() { this.emit('end'); })
      .pipe( gulp.dest('./dist/js') )
    );
  },

  browserReload: function(done) {
    browserSync.reload();

    done();
  },
};

//リソースからファイルを出力
exports.default = gulp.parallel( tasks.sass, tasks.editorStyle, tasks.js );

//監視
exports.watch = tasks.watch;

//PHPサーバーを閉じる
exports.closeServer = gulpConnectPHP.closeServer;
