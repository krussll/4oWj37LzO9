

(function () {

'use strict';

angular.module('appMain')

.controller('leagueShowController', function($scope, $http) {
    $scope.leagueShow = 
    {
    	control: {
    		isLoading: false
    	},
        id: null,
        type: null,
        name: null,
        positions: [],
    	init: function (id)
    	{
    		var leagueShow = this;
            leagueShow.control.isLoading = true;
            leagueShow.id = id;
            leagueShow.type = '';

            $http.get('/api/leagues/' + leagueShow.id + '/positions')
                .success(function(data){
                    leagueShow.positions = data.positions;
                    leagueShow.name = data.name;
                    leagueShow.control.isLoading = false;
                });

            
            
    	},
	}
});

})();