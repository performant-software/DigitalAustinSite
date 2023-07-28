'use strict';

var gulp = require('gulp');

gulp.task('default', gulp.series(['sass:watch', 'uglify:watch']));
