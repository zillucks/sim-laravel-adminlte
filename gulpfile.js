var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

/*
 * define PATH of vendor and another dependencies
 */

 var vendors = "./vendor/";
 var path = {
 	'bootstrap'		: vendors + "twbs/bootstrap/",
 	'fontawesome'	: vendors + "fortawesome/font-awesome/",
 	'adminlte'		: vendors + "almasaeed2010/adminlte/",
 	'editable'		: vendors + "bootstrap3-editable/",
 	'jqueryui'		: vendors + "jquery-ui/"
 }

elixir(function(mix) {
    mix
		.copy(path.bootstrap + 'fonts/**', 'public/fonts/bootstrap')
    	.copy(path.fontawesome + 'fonts/**', 'public/fonts/font-awesome')
    	.copy(path.adminlte + 'dist/img/**', 'public/img/adminLTE')
    	.copy(path.editable + 'img/**', 'public/img')
    	.copy(path.jqueryui + 'themes/smoothness/images/**', 'public/images/jquery-ui-smoothness')

    	.scripts('jquery-2.2.3.js', 'public/js/jquery-2.2.3.js')
    	.scripts(path.bootstrap + 'dist/js/bootstrap.js', 'public/js/bootstrap.js')
    	.scripts([
    		path.adminlte + 'dist/js/app.js',
    		path.adminlte + 'plugins/morris/morris.js'
		], 'public/js/AdminLTE.js')
		.scripts(path.editable + 'js/bootstrap-editable.js', 'public/js/x-editable.js')

		/*
		 * Custom jquery-ui.js
		 * only use autocomplete
		 */
		.scripts([
			path.jqueryui + 'ui/core.js',
			path.jqueryui + 'ui/widget.js',
			path.jqueryui + 'ui/position.js',
			path.jqueryui + 'ui/menu.js',
			path.jqueryui + 'ui/autocomplete.js'
		], 'public/js/jquery-ui-custom.js')

		.styles(path.adminlte + 'plugins/morris/morris.css', 'public/css/morris.css')
		.styles(path.editable + 'css/bootstrap-editable.css', 'public/css/x-editable.css')

		.styles([
			path.jqueryui + 'themes/smoothness/jquery-ui.css',
		], 'public/css/jquery-ui.css')

		.less('bs.less', 'public/css/bootstrap.css')
		.less('fa.less', 'public/css/font-awesome.css')
		.less('app.less', 'public/css/AdminLTE.css')

		/*
		 * Versioning all css and js files previously generated
		 */
		.version([
			'css/AdminLTE.css',
			'css/bootstrap.css',
			'css/font-awesome.css',
			'css/morris.css',
			'css/x-editable.css',
			'css/jquery-ui.css',
			'js/jquery-2.2.3.js',
			'js/jquery-ui-custom.js',
			'js/bootstrap.js',
			'js/AdminLTE.js',
			'js/x-editable.js'
		]);

});
