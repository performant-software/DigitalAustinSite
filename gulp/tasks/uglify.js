'use strict';

// Using stream-combiner2 to catch errors per gulp at:
// https://github.com/gulpjs/gulp/blob/master/docs/recipes/combining-streams-to-handle-errors.md#combining-streams-to-handle-errors

var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    combiner = require('stream-combiner2'),
    config = require('../config').scripts;

gulp.task('uglify', gulp.series(function() {
  var combined = combiner.obj([
    gulp.src(config.src),
    uglify(),
    gulp.dest(config.dest)
  ]);

  combined.on('error', console.error.bind(console));

  return combined;
}));

gulp.task('uglify:watch', gulp.series(function(done) {
  gulp.watch(config.src, gulp.series(['uglify']));
  done();
}));
