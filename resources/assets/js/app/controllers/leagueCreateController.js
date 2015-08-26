
(function () {

'use strict';

angular.module('appMain')

.controller('leagueCreateController', function($scope, $http, validationService) {
    $scope.leagueCreate =
    {
    	control: {
            isLoading: true,
            isSubmitted: false
        },
        league: {
            name: ''
        },
        validation: {
            name: {
                isValid: true,
                message: ''
            },
        },
        init: function()
        {
            var leagueCreate = this;
        },
        submit: function()
        {
            var leagueCreate = this;

            if (leagueCreate.isValid())
            {
               $http.post('/api/leagues/create', leagueCreate.league)
                .success(function(data) 
                {
                    if (data.success === true)
                    {
                        window.location = '/leagues?r=true';
                    }
                }); 
            }            
        },
        isValid: function()
        {
            var leagueCreate = this;

            var isValid = true;
       
            leagueCreate.validation.name = validationService.shortDescription(leagueCreate.league.name);

            angular.forEach(leagueCreate.validation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });
            return isValid;
        }

        
	};

});

})();
