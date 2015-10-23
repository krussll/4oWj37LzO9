(function () {

'use strict';

angular.module('appMain')

.controller('searchController', function($scope, $http) {
    $scope.search =
    {
    	control: {
            isLoading: true
        },
        inputs: {
            profile: ''
        },
        profiles:[],
        init: function (profile)
        {
            var search = this;
            search.inputs.profile = profile;
            search.control.isLoading = true;

            search.searchProfiles();
        },
        searchProfiles: function()
        {
            var search = this;
            search.control.isLoading = true;

            $http.get('/api/profiles/byname?tag=' + search.inputs.profile)
                .success(function(data){
                    search.profiles = data;
                    search.control.isLoading = false;
                });
        }
	}
});

})();
