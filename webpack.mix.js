const mix = require('laravel-mix');
var tailwindcss = require('tailwindcss');


mix.webpackConfig({
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js' // 'vue/dist/vue.common.js' for webpack 1
        }
    }
});

mix.sass('resources/assets/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.js')],
    })
    .scripts([
        'resources/assets/js/acme.js',
        'resources/assets/js/*/*.js'
    ], 'public/js/all.js')
    .js('resources/assets/js/init.js', 'public/js');