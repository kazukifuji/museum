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

    //sass
    gulp.watch('./src/sass/**/*.scss')
        .on( 'change', gulp.series(tasks.sass, browserSync.reload) );
    //js
    gulp.watch('./src/js/**/*.js')
        .on( 'change', gulp.series(tasks.js, browserSync.reload) );
    //php
    gulp.watch('./**/*.php')
        .on('change', browserSync.reload);

    done();
  },

  sass: function(done) {
    gulp.src('./src/sass/index.scss')
        .pipe( gulpSassGlob() )
        .pipe(
          gulpSass({ outputStyle: 'expanded' }).on('error', gulpSass.logError)
        )
        .pipe( gulpRename('style.css') )
        .pipe( gulp.dest('./dist/css') );

    done();
  },

  js: function(done) {
    webpackStream(webpackConfig, webpack)
    .pipe( gulp.dest('./dist/js') );

    done();
  },
};

//リソースからファイルを出力
exports.default = gulp.parallel( tasks.sass, tasks.js );

//監視
exports.watch = tasks.watch;

//PHPサーバーを閉じる
exports.closeServer = gulpConnectPHP.closeServer;
