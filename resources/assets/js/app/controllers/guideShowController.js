
(function () {

'use strict';

angular.module('appMain')

.controller('guideAddController', function($scope, $http) {
    $scope.guideAdd =
    {
    	control: {
            isLoading: true
        },
        inputs: {
          location: '',
          placeId: '',
          title: '',
          description: '',
          userId: null
        },
        init: function ()
        {
            var guideAdd = this;

        },
	}
});

})();
