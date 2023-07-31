'use strict';

const gulp = require('gulp');
const sass = require('./sass');
const uglify = require('./uglify');
const commonScripts = require('./scripts');

gulp.task('dev', gulp.series(commonScripts, sass.watchSass, uglify.uglifyWatch));

gulp.task('default', gulp.series(commonScripts, sass.ingestSass, uglify.uglifyTask));
