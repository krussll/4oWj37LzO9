

(function () {

'use strict';

angular.module('appMain')

.controller('hashtagShowController', function($scope, $http) {
    $scope.hashtagShow =
    {
    	control: {
    		isLoading: false
    	},
        id: null,
        hashtag: null,
        prices: [],
    	profiles: null,
    	init: function (id)
    	{
    		var hashtagShow = this;
            hashtagShow.control.isLoading = true;

            hashtagShow.id = id;
            $http.get('/api/profiles/id?id=' + hashtagShow.id)
                .success(function(data){
                    hashtagShow.hashtag = data;
                    hashtagShow.control.isLoading = false;
                });



    	},
	}
});

})();
