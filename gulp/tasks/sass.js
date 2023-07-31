'use strict';

// Using stream-combiner2 to catch errors per gulp at:
// https://github.com/gulpjs/gulp/blob/master/docs/recipes/combining-streams-to-handle-errors.md#combining-streams-to-handle-errors

var gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    sourcemaps = require('gulp-sourcemaps'),
    combiner = require('stream-combiner2'),
    config = require('../config').sass;


const ingestSass = () => {
  var combined = combiner.obj([
    gulp.src(config.src),
        sourcemaps.init(),
        sass().on('error', sass.logError),
        sass({outputStyle: 'compressed'}),
        sourcemaps.write('./'),
        gulp.dest(config.dest)
  ]);

  combined.on('error', console.error.bind(console));

  return combined;
};

const watchSass = (done) => {
  gulp.watch(config.srcdir + '*.scss', ingestSass);
  done();
};

module.exports = {
  ingestSass,
  watchSass
}
