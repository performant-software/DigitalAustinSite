/*
 gulpfile.js
 ===========
 Add new tasks by creating a new .js file in gulp/tasks.
 Add configuration variables to gulp/config.js
 Add utilities in gulp/util

 adapted from https://github.com/greypants/gulp-starter

 */


require('./gulp/config');
require('./gulp/tasks/scripts');
require('./gulp/tasks/uglify');
require('./gulp/tasks/sass');
require('./gulp/tasks/default');
