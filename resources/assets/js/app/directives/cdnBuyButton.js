(function () {

'use strict';

angular.module('appMain')
    .directive('cdnBuyButton', function($http, pnotifyService, buyTagService) {
        return {
            restrict:'E',
            template: '<a ng-disabled="isLoading" href="#buy-modal" data-toggle="modal" class="btn btn-success btn-{{buttonSize}}" ng-click="buy();"> Buy </a>',
            scope: {
                eventHandler: '&',
                buttonSize: '@',
                profileId: '@',
                price: '@',
                tag: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.buy = function()
                {
                    buyTagService.setData(scope.profileId, scope.tag, scope.price);
                    buyTagService.setCallback(scope.eventHandler);
                }
            },


        };
    });

})();
