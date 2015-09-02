(function () {

'use strict';

angular.module('appMain')

.controller('listController', function($scope, $http) {
    $scope.list = 
    {
    	control: {
            isLoading: true
        },
        hashtags:[],
        init: function ()
        {
            var list = this;
            list.listHashtags();
        },
        listHashtags: function()
        {
            var list = this;
            list.control.isLoading = true;

            $http.get('/api/hashtags/list')
                .success(function(data){
                    list.hashtags = data;
                    list.control.isLoading = false;
                });
        }        
	}
});

})();