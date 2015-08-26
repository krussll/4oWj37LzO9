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

elixir(function(mix) {
    mix.scripts([

    	'app/config.js',

    	<!-- controllers -->
        'app/controllers/layoutController.js',
    	'app/controllers/homeController.js',
    	'app/controllers/loginController.js',
    	'app/controllers/searchController.js',
        'app/controllers/registerController.js',
        'app/controllers/userShowController.js',
        'app/controllers/dashboardController.js',
        'app/controllers/settingsController.js',
        'app/controllers/hashtagShowController.js',
        'app/controllers/leagueShowController.js',
        'app/controllers/buyController.js',
        'app/controllers/sideNavController.js',
        'app/controllers/leagueCreateController.js',

    	<!-- directives -->
    	'app/directives/autocompleteDirective.js',
        'app/directives/cdnImage.js',
        'app/directives/cdnBuyButton.js',
        'app/directives/cdnSellButton.js',
        'app/directives/priceGraph.js',

        <!-- filters -->
        'app/filters/titlecaseFilter.js',
        'app/filters/currencyFilter.js',
        'app/filters/percentageDifferenceFilter.js',

        <!-- services -->
        'app/services/notifyService.js',
        'app/services/validationService.js',
        'app/services/buyTagService.js',
        'app/services/portfoliosService.js',
        'app/services/selectedPortfolioService.js',
    	]);
});
