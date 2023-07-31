'use strict';

var gulp = require('gulp'),
    _ = require('lodash'),
    config = require('../config').scripts;

const commonScripts = () => {
  var paths = [];

  _.forEach(config.common_libs, function(path) {
    paths.push(path);
  });

  return gulp.src(paths)
      .pipe(gulp.dest(config.vendor_dest));
};

module.exports = commonScripts
