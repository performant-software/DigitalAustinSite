var dest = './public',
    src = './src',
    vendor = './node_modules';

module.exports = {
  sass: {
    srcdir: src + '/scss/',
    src: src + '/scss/style.scss',
    dest: dest + '/css/'
  },
  scripts: {
    src: src + '/js/*.js',
    dest: dest + '/js',
    vendor_dest: dest + '/js/vendor',
    common_libs: {
      jquery: vendor + '/jquery/jquery.min.js',
      bootstrap: vendor + '/bootstrap-sass/assets/javascripts/bootstrap.min.js',
      d3: src + '/js/lib/d3.export.js',
      jquery_paging: src + '/js/lib/jquery.paging.export.js',
    }
  },
  browserify: {
    // A separate bundle will be generated for each
    // bundle config in the list below
    bundleConfigs: [{
      entries: src + '/js/browse.js',
      dest: dest + '/js',
      outputName: 'browse.js',
      // list of externally available modules to exclude from the bundle
      external: ['jquery']
    },{
      entries: src + '/js/results.js',
      dest: dest + '/js',
      outputName: 'results.js',
      // list of externally available modules to exclude from the bundle
      external: ['jquery']
    }
    ]
  }
};
