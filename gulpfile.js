var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.copy('node_modules/vue/dist/vue.js', 'resources/assets/js/libs/vue.js');
    mix.copy('node_modules/vue-resource/dist/vue-resource.js', 'resources/assets/js/libs/vue-resource.js');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/glyphicons-halflings-regular.ttf', 'public/fonts/bootstrap/glyphicons-halflings-regular.ttf');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/glyphicons-halflings-regular.woff', 'public/fonts/bootstrap/glyphicons-halflings-regular.woff');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/glyphicons-halflings-regular.woff2', 'public/fonts/bootstrap/glyphicons-halflings-regular.woff2');

    mix.sass('app.scss');

    mix.scripts([
        'resources/assets/js/libs/vue.js',
        'resources/assets/js/libs/vue-resource.js',
        'resources/assets/js/app.js'
    ], 'public/js/app.js');
});
