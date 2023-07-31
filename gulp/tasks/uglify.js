'use strict';

// Using stream-combiner2 to catch errors per gulp at:
// https://github.com/gulpjs/gulp/blob/master/docs/recipes/combining-streams-to-handle-errors.md#combining-streams-to-handle-errors

var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    combiner = require('stream-combiner2'),
    config = require('../config').scripts;

const uglifyTask = () => {
  var combined = combiner.obj([
    gulp.src(config.src),
    uglify(),
    gulp.dest(config.dest)
  ]);

  combined.on('error', console.error.bind(console));

  return combined;
};

const uglifyWatch = (done) => {
  gulp.watch(config.src, uglifyTask);
  done();
};

module.exports = {
  uglifyTask,
  uglifyWatch
}
