const gulp = require('gulp'),
      gulpRename = require('gulp-rename'),
      gulpSass = require('gulp-sass'),
      gulpSassGlob = require('gulp-sass-glob'),
      webpack = require('webpack'),
      webpackConfig = require('./webpack.config'),
      webpackStream = require('webpack-stream');

const tasks = {
  watch: function(done) {
    //sass, editorStyle
    gulp.watch('./src/sass/**/*.scss')
        .on( 'change', gulp.series(
            gulp.parallel( tasks.sass, tasks.editorStyle )
        ) );
    //js
    gulp.watch('./src/js/**/*.js')
        .on( 'change', gulp.series( tasks.js ) );

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
};

//リソースからファイルを出力
exports.default = gulp.parallel( tasks.sass, tasks.editorStyle, tasks.js );

//監視
exports.watch = tasks.watch;
