(function () {

'use strict';

angular.module('appMain')
    .directive('cdnImage', function() {
        return {
            restrict:'E',
            template: '<img ng-src="{{imageSrc}}" class="{{cdnClass}}" />',
            scope: {
                cdnSrc: '@',
                cdnFile: '@',
                cdnClass: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.imageSrc = '';

               attrs.$observe('cdnFile', function () {
                    if (scope.cdnSrc.length > 0 && scope.cdnFile.length > 0)
                    {
                        scope.imageSrc = '/cdn/' + scope.cdnSrc + '/' + scope.cdnFile;
                    }else
                    {
                        scope.imageSrc = '/cdn/placeholder.jpg';
                    }
                
                }); 
            },
        };
    });

})();
