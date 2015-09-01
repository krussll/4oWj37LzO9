(function () {

'use strict';

angular.module('appMain')

.controller('leaguesController', function($scope, $http, selectedPortfolioService) {
    $scope.leagues = 
    {
        join: {
            code: '',
            message: '',
            showMessage: false
        },
        globalLeagues: [],
        privateLeagues: [],
        init: function ()
        {
            var leagues = this;

            $http.get('/api/leagues/user/positions')
                .success(function(data){
                    leagues.globalLeagues = data.global;
                    leagues.privateLeagues = data.private;
                    
                });
            
        },
        joinSubmit: function()
        {
           var leagues = this;
           
           leagues.join.showMessage = false;
           if(leagues.join.code === '')
           {
                leagues.join.message = 'Please enter a code';
                leagues.join.showMessage = true;
           }else
           {
            $http.post('/api/leagues/join/' + leagues.join.code)
                .success(function(data){
                    if(data.success)
                    {
                        window.location = '/league/' + data.id;
                    }else {
                        leagues.join.message = data.message;
                        leagues.join.showMessage = true;
                    }
                    
                });
           }
        }
	};

});

})();