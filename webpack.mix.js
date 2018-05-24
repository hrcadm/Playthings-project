let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(	'resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

	.copy('node_modules/font-awesome/fonts', 'public/fonts')
	.copy('node_modules/icomoon', 'public/css/icons/icomoon')
	.copy('public/css/icons/icomoon/fonts', 'public/fonts')

   .combine([
	'resources/assets/limitless/js/core/libraries/jquery.min.js',
	'node_modules/popper.js/dist/umd/popper.min.js',
	'node_modules/popper.js/dist/umd/popper.js',
	'node_modules/bootstrap/dist/js/bootstrap.min.js',
	'resources/assets/limitless/js/plugins/ui/moment/moment.min.js',
	'node_modules/select2/dist/select2.js',
	'resources/assets/limitless/js/plugins/tables/datatables/datatables.min.js',
	'resources/assets/limitless/js/plugins/loaders/pace.min.js',
	'resources/assets/limitless/js/plugins/loaders/blockui.min.js',
	'resources/assets/limitless/js/plugins/visualization/d3/d3.min.js',
	'resources/assets/limitless/js/plugins/visualization/d3/d3_tooltip.min.js',
	'resources/assets/limitless/js/plugins/notifications/bootbox.min.js',
	'resources/assets/limitless/js/plugins/ui/drilldown.js',
	'resources/assets/limitless/js/plugins/loaders/progressbar.min.js',
	'resources/assets/limitless/js/plugins/forms/selects/bootstrap_multiselect.js',
	'resources/assets/limitless/js/plugins/forms/styling/switchery.min.js'
	], './public/js/scripts.js')

   .combine([
	'resources/assets/limitless/css/bootstrap.min.css',
	'resources/assets/limitless/css/core.min.css',
	'resources/assets/limitless/css/components.min.css',
	'resources/assets/limitless/css/colors.min.css',
	'resources/assets/limitless/icons/styles.css',
	'node_modules/font-awesome/css/font-awesome.css',
	'node_modules/select2/dist/css/select2.css'
	], './public/css/main.css');