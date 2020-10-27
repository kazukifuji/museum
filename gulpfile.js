const gulp = require('gulp'),
      gulpRename = require('gulp-rename'),
      gulpSass = require('gulp-sass'),
      gulpSassGlob = require('gulp-sass-glob');

const tasks = {
  watch: function(done) {
    //sass, editorStyle
    gulp.watch('./src/sass/**/*.scss', { events: 'change' }, gulp.parallel( tasks.sass, tasks.editorStyle ) );

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
};

//リソースからファイルを出力
exports.default = gulp.parallel( tasks.sass, tasks.editorStyle );

//監視
exports.watch = tasks.watch;
