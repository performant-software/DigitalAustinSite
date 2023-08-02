'use strict';

var gulp = require('gulp'),
    config = require('../config').scripts;

const commonScripts = () => {
  const paths = Object.keys(config.common_libs).map((key) => config.common_libs[key])

  return gulp.src(paths)
      .pipe(gulp.dest(config.vendor_dest));
};

module.exports = commonScripts
