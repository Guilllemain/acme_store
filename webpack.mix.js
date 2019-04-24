const mix = require('laravel-mix');
var tailwindcss = require('tailwindcss');

mix.webpackConfig({
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.esm.js'
            }
        }
    })
    .sass('resources/assets/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.js')],
    })
    .js('resources/assets/js/init.js', 'public/js');