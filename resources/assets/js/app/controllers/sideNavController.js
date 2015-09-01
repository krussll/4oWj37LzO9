
(function () {

'use strict';

angular.module('appMain')

.controller('sideNavController', function($scope, portfoliosService, selectedPortfolioService) {
    $scope.sideNav =
    {
        userPortfolios: null,
        portfolio: null,
        change: function () {
            var sideNav = this;
            selectedPortfolioService.setPortfolioId(sideNav.portfolio.id);
        }
	};

    portfoliosService.then(function(service)
    {
        $scope.sideNav.userPortfolios = service.data;
        $scope.sideNav.portfolio = selectedPortfolioService.getPortfolio();
    });

});

})();
