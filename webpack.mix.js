const mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'public/js')
    .sass('node_modules/materialize-css/sass/materialize.scss', 'public/css')
