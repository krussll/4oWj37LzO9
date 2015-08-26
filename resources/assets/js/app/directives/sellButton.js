(function () {

'use strict';

angular.module('appMain')
    .directive('cdnImage', function() {
        return {
            restrict:'E',
            template: '<a href="#" class="btn btn-danger btn-{{buttonSize}}" ng-click="dashboard.sell(trade.id)"> Sell </a>',
            scope: {
                cdnSrc: '@',
                cdnFile: '@',
                buttonSize: ''
            },
            link: function(scope, element, attrs, model) {
               scope.imageSrc = '';

               attrs.$observe('cdnFile', function () {
                    if (scope.cdnSrc.length > 0 && scope.cdnFile.length > 0)
                    {
                        scope.imageSrc = '/cdn/' + scope.cdnSrc + '/' + scope.cdnFile;
                    }
                
                }); 
            },
        };
    });

})();
