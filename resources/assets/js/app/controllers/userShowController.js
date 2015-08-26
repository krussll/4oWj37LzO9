(function () {

'use strict';

angular.module('appMain')

.controller('userShowController', function($scope, $http) {
    $scope.userShow = 
    {
    	control: {
            isLoading: true
        },
        id: '',
        geocode: null,
        user: null,
        
        init: function (id)
        {
            var userShow = this;
            userShow.id = id;
            userShow.control.isLoading = true;

            $http.get('/api/users/id?id=' + userShow.id)
                .success(function(data){
                    userShow.user = data;
                    userShow.control.isLoading = false;
                });
            
        }      
	}
});

})();