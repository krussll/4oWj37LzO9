(function () {

'use strict';

angular.module('appMain')
    .directive('priceGraph', function($http, pnotifyService) {
        return {
            restrict:'E',
            template: '<div id="graph_line" style="width:100%; height:300px;"></div>',
            scope: {
                hashtagId: '@'
            },
            link: function(scope, element, attrs, model) {
               attrs.$observe('hashtagId', function () {
                    $http.get('/api/hashtags/counts?id=' + scope.hashtagId)
                        .success(function(data){
                        new Morris.Area({
                            element: 'graph_line',
                            xkey: 'created_at',
                            ykeys: ['amount'],
                            labels: ['Price'],
                            hideHover: 'auto',
                            xLabels: "day",
                            lineColors: ['#26B99A'],
                            data: data
                        });
                    });
                });
            },


        };
    });

})();
