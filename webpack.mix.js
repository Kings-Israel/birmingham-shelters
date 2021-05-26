const mix = require('laravel-mix');

mix.sass('resources/sass/dashboard.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
