

(function () {

'use strict';

angular.module('appMain')

.controller('leagueShowController', function($scope, $http) {
    $scope.leagueShow = 
    {
    	control: {
    		isLoading: false,
            isOwner: false
    	},
        inputs: {
            name: ''
        },
        id: null,
        type: null,
        name: null,
        league: null,
        positions: [],
    	init: function (id)
    	{
    		var leagueShow = this;
            leagueShow.control.isLoading = true;
            leagueShow.id = id;
            leagueShow.type = '';

            $http.get('/api/leagues/' + leagueShow.id)
                .success(function(data){
                    leagueShow.league = data.league;
                    leagueShow.control.isOwner = data.is_owner;

                    leagueShow.inputs.name = leagueShow.league.name;
                });

            $http.get('/api/leagues/' + leagueShow.id + '/positions')
                .success(function(data){
                    leagueShow.positions = data.positions;
                    leagueShow.name = data.name;
                    leagueShow.control.isLoading = false;
                }); 
    	},
        submit: function()
        {

        },
	}
});

})();