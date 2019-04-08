const mix = require('laravel-mix');

mix.sass('resources/assets/scss/app.scss', 'resources/assets/css')
    .styles([
        'resources/assets/css/app.css',
        'resources/assets/bower/vendor/slick-carousel/slick/slick.css',
    ], 'public/css/all.css')
    .scripts([
        'resources/assets/bower/vendor/jquery/dist/jquery.min.js',
        'resources/assets/bower/vendor/foundation-sites/dist/js/foundation.min.js',
        'resources/assets/bower/vendor/slick-carousel/slick/slick.min.js',
        'resources/assets/js/acme.js',
        'resources/assets/js/*/*.js',
        'resources/assets/js/init.js'
    ], 'public/js/all.js');