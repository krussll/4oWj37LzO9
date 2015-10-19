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
            hashtag: ''
        },
        hashtags:[],
        init: function (hashtag)
        {
            var search = this;
            search.inputs.hashtag = hashtag;
            search.control.isLoading = true;

            search.searchHashtags();
        },
        searchHashtags: function()
        {
            var search = this;
            search.control.isLoading = true;

            $http.get('/api/profiles/byname?tag=' + search.inputs.hashtag)
                .success(function(data){
                    search.hashtags = data;
                    search.control.isLoading = false;
                });
        }
	}
});

})();
