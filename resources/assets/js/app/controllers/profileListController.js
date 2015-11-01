(function () {

'use strict';

angular.module('appMain')

.controller('listController', function($scope, $http) {
    $scope.list =
    {
    	control: {
            isLoading: true,
        },
        paging: {
            pageLength: 12,
            currentPage: 1,
            total: 50
        },
        profiles:[],
        init: function ()
        {
            var list = this;
            $http.get('/api/profiles/info')
                .success(function(data){
                    list.paging.total = data.total;
                });

            list.listProfiles('profile', list.paging.currentPage);
        },
        listProfiles: function(objectName, newPage)
        {
            var list = this;
            list.control.isLoading = true;
            list.paging.currentPage = newPage;

            $http.get('/api/profiles/list?page=' + list.paging.currentPage + '&length=' + list.paging.pageLength)
                .success(function(data){
                    list.profiles = data;
                    list.control.isLoading = false;
                });
        }
	}
});

})();
