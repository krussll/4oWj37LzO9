(function () {

'use strict';

angular.module('appMain')
    .directive('priceGraph', function($http, pnotifyService) {
        return {
            restrict:'E',
            template: '<div id="graph_line" style="width:100%; height:300px;"></div>',
            scope: {
                profileId: '@'
            },
            link: function(scope, element, attrs, model) {
               attrs.$observe('profileId', function () {
                 if (scope.profileId > 0)
                 {
                   $http.get('/api/profiles/counts?id=' + scope.profileId)
                       .success(function(data){
                       new Morris.Area({
                           element: 'graph_line',
                           xkey: 'created_at',
                           ykeys: ['price'],
                           labels: ['Price'],
                           hideHover: 'auto',
                           xLabels: "day",
                           lineColors: ['#26B99A'],
                           data: data
                       });
                   });
                 }
                });
            }
        };
    });

})();
