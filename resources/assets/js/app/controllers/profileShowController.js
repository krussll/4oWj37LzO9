

(function () {

'use strict';

angular.module('appMain')

.controller('profileShowController', function($scope, $http) {
    $scope.profileShow =
    {
    	control: {
    		isLoading: false
    	},
        id: null,
        profile: null,
        prices: [],
    	profiles: null,
    	init: function (id)
    	{
    		var profileShow = this;
            profileShow.control.isLoading = true;

            profileShow.id = id;
            $http.get('/api/profiles/id?id=' + profileShow.id)
                .success(function(data){
                    profileShow.profile = data;
                    profileShow.control.isLoading = false;
                });



    	},
	}
});

})();
