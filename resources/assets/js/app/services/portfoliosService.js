(function () {

'use strict';

angular.module('appMain')
    .factory('portfoliosService', function($http) {
    	var promise = $http.get('/api/user/portfolios')
                .success(function(data){
                    var userPortfolios = {
                        portfolios: data
                    };
                   
                    return userPortfolios;
                });


        return promise;
    });

})();
