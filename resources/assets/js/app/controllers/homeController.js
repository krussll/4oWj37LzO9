

(function () {

'use strict';

angular.module('appMain')

.controller('homeController', function($scope, $http, $location) {
    $scope.home = 
    {
    	control: {
    		isLoading: false
    	},
        search: {
            location: ''
        },
    	profiles: null,
    	init: function ()
    	{
    		var home = this;
    	},
        geoId: null,
    	submit: function () {
            var home = this;
            window.location = "s/" + home.search.location;
        },
        geoid: null,
	}
});

})();