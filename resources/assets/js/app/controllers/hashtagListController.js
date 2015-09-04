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
            pageLength: 10,
            currentPage: 1,
            total: 50
        },
        hashtags:[],
        init: function ()
        {
            var list = this;
            $http.get('/api/hashtags/info')
                .success(function(data){
                    list.paging.total = data.total;
                });
               
            list.listHashtags('hashtag', list.paging.currentPage);
        },
        listHashtags: function(objectName, newPage)
        {
            var list = this;
            list.control.isLoading = true;
            list.paging.currentPage = newPage;

            $http.get('/api/hashtags/list?page=' + list.paging.currentPage + '&length=' + list.paging.pageLength)
                .success(function(data){
                    list.hashtags = data;
                    list.control.isLoading = false;
                });
        }        
	}
});

})();