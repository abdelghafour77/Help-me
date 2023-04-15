let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'dist').setPublicPath('dist');
mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');
