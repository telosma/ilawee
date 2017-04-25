var gulp = require('gulp');
const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass(['app.sass'], 'public/css/app.css')
    .version(['css/app.css']);
       // .webpack('app.js');
});
gulp.task('bower', function() {
  return bower({ cmd: 'update'})
    .pipe(gulp.dest('vendor/'))
});
gulp.task("copyfiles", function () {
    var publicDest = ['public/js', 'public/css', 'public/fonts', 'puclic/library'];
    var assetsCopy = [
    //jsCopyPath
        ['vendor/bower_dl/jquery/dist/jquery.min.js', publicDest[0]],
        ['vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js', publicDest[0]],
        ['vendor/bower_dl/metisMenu/dist/metisMenu.min.js', publicDest[0]],
        ['vendor/bower_dl/sb-admin-2/js/sb-admin-2.js', publicDest[0]],
        ['vendor/bower_dl/datatables.net-select/js/dataTables.select.min.js', publicDest[0]],
        ['vendor/bower_dl/datatables.net-buttons/js/dataTables.buttons.min.js', publicDest[0]],
        ['vendor/bower_dl/jquery-serialize-object/dist/jquery.serialize-object.min.js', publicDest[0]],
        ['vendor/bower_dl/jquery-form/jquery.form.js', publicDest[0]],
        ['vendor/bower_dl/datatables/media/js/jquery.dataTables.min.js', publicDest[0]],
        ['resources/assets/css/adminScript.js', publicDest[0]],
        ['vendor/bower_dl/materialize/dist/js/materialize.min.js', publicDest[0]],
        ['vendor/bower_dl/showdown/dist/showdown.min.js', publicDest[0]],
    //cssCopyPath
        ['vendor/bower_dl/bootstrap/dist/css/bootstrap.min.css', publicDest[1]],
        // ['vendor/bower_dl/bootstrap/dist/css/bootstrap.min.css.map', publicDest[1]],
        // ['vendor/bower_dl/font-awesome/css/font-awesome.min.css', publicDest[1]],
        // ['vendor/bower_dl/metisMenu/dist/metisMenu.min.css', publicDest[1]],
        ['vendor/bower_dl/datatables/media/css/jquery.dataTables.min.css', publicDest[1]],
        ['vendor/bower_dl/datatables.net-select-dt/css/select.dataTables.min.css', publicDest[1]],
        ['vendor/bower_dl/datatables.net-select-dt/css/buttons.dataTables.min.css', publicDest[1]],
        ['vendor/bower_dl/sb-admin-2/css/sb-admin-2.css', publicDest[1]],
        ['resources/assets/css/mystyle.css', publicDest[1]],
        ['resources/assets/css/style.css', publicDest[1]],
        ['resources/assets/css/reset.css', publicDest[1]],
    //fontsCopyPath
        ['vendor/bower_dl/bootstrap/dist/fonts/**', publicDest[2]],
        ['vendor/bower_dl/font-awesome/fonts/**', publicDest[2]],
    ];

    for (var i = 0; i < assetsCopy.length; i++) {
        gulp.src(assetsCopy[i][0]).pipe(gulp.dest(assetsCopy[i][1]));
    }
});
