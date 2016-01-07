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

elixir(function(mix) {
    mix.less('app.less', 'resources/assets/css');

    mix.styles([
        'libs/jquery-ui.css',
        'libs/lity.css',
        'libs/jquery.fileupload.css',
        'libs/jquery.fileupload-ui.css',
        'app.css'
    ]);

    mix.scripts([
        '/libs/jquery.min.js',
        '/libs/jquery-ui.min.js',
        '/libs/bootstrap.min.js',
        '/libs/bootstrap-timepicker.js',
        'libs/lity.js',
        //'/plugins/listjs/list.min.js',
        //'/plugins/listjs/list.fuzzysearch.min.js',
        '/plugins/slimscroll/jquery.slimscroll.min.js',
        '/plugins/slimscroll/jquery.slimscroll.horizontal.min.js'
    ])

});
