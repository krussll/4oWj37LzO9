(function () {

'use strict';

angular.module('appMain')
    .directive('cdnSellButton', function($http, pnotifyService, selectedPortfolioService) {
        return {
            restrict:'E',
            template: '<a ng-disabled="isLoading" href="#" class="btn btn-danger btn-{{buttonSize}}" ng-click="sell();"> Sell </a>',
            scope: {
                eventHandler: '&',
                buttonSize: '@',
                tradeId: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.sell = function()
                {
                    scope.isLoading = true;

                    var postData = {
                        id: scope.tradeId
                    };

                    $http.post('/api/trades/complete', postData)
                        .success(function(data)
                        {
                            if (data.success == true)
                            {
                                pnotifyService.success('Trade Complete', 'Hashtag has been sold');
                                scope.eventHandler();
                                selectedPortfolioService.soldPortfolioValue(data.portfolioId, data.price);
                            }else {
                                pnotifyService.error('Trade Failed', 'Something went wrong');
                            }

                            scope.isLoading = false;
                        });
                }
            },


        };
    });

})();
