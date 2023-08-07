// d3 version 4 removed the named default export,
// which Gulp expects from all packages. So here
// we're providing Gulp with a named export.
import * as d3 from 'd3/dist/d3.min.js';

export default d3;
