

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
    	init: function (type, id)
    	{
    		var leagueShow = this;
            leagueShow.control.isLoading = true;
            leagueShow.id = id;
            leagueShow.type = type;

            $http.get('/api/leagues/' + leagueShow.type + '/' + leagueShow.id)
                .success(function(data){
                    leagueShow.positions = data.positions;
                    leagueShow.name = data.name;
                    leagueShow.control.isLoading = false;
                });

            
            
    	},
	}
});

})();