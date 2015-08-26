(function () {

'use strict';

angular.module('appMain')

.controller('dashboardController', function($scope, $http, selectedPortfolioService) {
    $scope.dashboard = 
    {
    	control: {
            isLoading: true,
            hashtagsLoading: true,
        },
        activeTrades: [],
        popularHashtags: [],
        globalLeagues: [],
        privateLeagues: [],
        popularHashtag: null,
        searchTerm: '',
        invalidSearch: false,
        init: function ()
        {
            var dashboard = this;
            dashboard.control.isLoading = true;
            dashboard.control.hashtagsLoading = true;


            $http.get('/api/hashtags/popular')
                .success(function(data){
                    dashboard.popularHashtags = data;
                    if (data.length > 0)
                    {
                        dashboard.popularHashtag = data[0];
                    }
                    dashboard.control.hashtagsLoading = false;
                });

            $http.get('/api/leagues/user/positions')
                .success(function(data){
                    dashboard.globalLeagues = data.global;
                    dashboard.privateLeagues = data.private;
                    
                    dashboard.control.hashtagsLoading = false;
                });
            
        },
        searchHashtags: function() {
            var dashboard = this;
                dashboard.invalidSearch = false;

            if (dashboard.searchTerm != '')
            {
                window.location = 'hashtag/search/' + dashboard.searchTerm;
            }else {
                dashboard.invalidSearch = true;
            }
            
        },
        updateTrades: function()
        {
            var dashboard = this;
            var id = selectedPortfolioService.getPortfolioId();
            $http.get('/api/trades/active?portfolio_id=' + id)
                .success(function(data){
                    dashboard.activeTrades = data.trades;
                    dashboard.control.isLoading = false;
                });
        } 
	};

    $scope.$watch(function () {
           return selectedPortfolioService.portfolioId;
         },                       
          function(newVal, oldVal) {
            if(newVal > 0)
            {
               $scope.dashboard.updateTrades(); 
            }
            
        }, true);
});

})();