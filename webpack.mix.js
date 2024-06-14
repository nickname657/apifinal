const mix  = require('laravel-mix');

mix.js('resources/js/app.js', 'public.js')
.sass('resources/sass/app.scss', 'public/css')


mix.js('resources/js/api.js', 'public.js')


.options({
    processCssUrls:false
});

if (mix.inProduction()) {
    mix.version();
}