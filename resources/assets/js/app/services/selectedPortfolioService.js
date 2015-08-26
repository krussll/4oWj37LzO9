(function () {

'use strict';

angular.module('appMain')
    .service('selectedPortfolioService', ['$cookies', 'portfoliosService', function($cookies, portfoliosService) {
        var selectedPortfolio = {};

        selectedPortfolio.portfolioId = -1;

        portfoliosService.then(function(service)
        {
            selectedPortfolio.portfolios = service.data;
            

            if($cookies.tagdaqportfolio > 0)
            {
                var id = $cookies.tagdaqportfolio;
            }else
            {
                var id = selectedPortfolio.portfolios[0].id;
            }


            selectedPortfolio.setPortfolioId(id);
        });

        selectedPortfolio.setPortfolioId = function(id)
        {
            selectedPortfolio.portfolioId = id;

            $cookies.tagdaqportfolio = id;
        }

        selectedPortfolio.getPortfolioId = function()
        {
            return selectedPortfolio.portfolioId;
        }

        return selectedPortfolio;
    }]);

})();
