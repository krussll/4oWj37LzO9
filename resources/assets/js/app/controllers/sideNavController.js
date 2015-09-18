
(function () {

'use strict';

angular.module('appMain')

.controller('sideNavController', function($scope, portfoliosService, selectedPortfolioService) {
    $scope.sideNav =
    {
        userPortfolios: null,
        portfolio: null,
        searchTerm: '',
        invalidSearch: false,
        change: function () {
            var sideNav = this;
            selectedPortfolioService.setPortfolioId(sideNav.portfolio.id);
        },
        searchHashtags: function() {
            var sideNav = this;
                sideNav.invalidSearch = false;

            if (sideNav.searchTerm != '')
            {
                window.location = '/hashtag/search/' + sideNav.searchTerm;
            }else {
                sideNav.invalidSearch = true;
            }
        }
	};

    portfoliosService.then(function(service)
    {
        $scope.sideNav.userPortfolios = service.data;
        $scope.sideNav.portfolio = selectedPortfolioService.getPortfolio();
    });

});

})();
