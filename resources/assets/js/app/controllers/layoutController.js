
(function () {

'use strict';

angular.module('appMain')

.controller('layoutController', function($scope, $http) {
    $scope.layout =
    {
      control: {
        isLoading: false
      },
        logout: function() {

            var login = this;
            $http.post('/api/login/destroy')
            .success(function(data)
                {
                    window.location = '/';
                });
        },
        consts:
        {
            siteName: 'tagdaq'
        }
	}
});

})();
