
(function () {

'use strict';

angular.module('appMain')

.controller('buyController', function($scope, $http, buyTagService, validationService, pnotifyService, portfoliosService, selectedPortfolioService) {
    $scope.buy =
    {
    	control: {
            isLoading: true,
            isSubmitted: false
        },
        userPortfolios: null,
        hashtag: {
            portfolio: null,
            hastag_id: 0,
            shares_taken: 0,
            price: 0,
            tag: ''
        },
        validation: {
            portfolio: {
                isValid: true,
                message: ''
            },
            shares_taken: {
                isValid: true,
                message: ''
            }
        },
        total:0,
        init: function()
        {
            var buy = this;
            buy.userPortfolios = []; 
        },
        buy: function()
        {
            var buy = this;
            buy.control.isLoading = true;

            if(buy.isValid())
            {
                var postData = {
                    'hashtag_id': buy.hashtag.hashtag_id,
                    'shares_taken': buy.hashtag.shares_taken,
                    'portfolio_id': buy.hashtag.portfolio
                };

                $http.post('/api/trades/create', postData)
                    .success(function(data){
                        console.log(data);
                        if (data.success == true)
                        {
                            pnotifyService.success('Trade Complete', 'Hashtag has been bought');

                            if(angular.isFunction(buyTagService.callback))
                            {
                                buyTagService.callback();
                            }
                            
                            buy.control.isSubmitted = true;
                        }else {
                            pnotifyService.error('Trade Error', data.message);
                        }
                        
                        buy.control.isLoading = false;
                    });
            }else
            {
                buy.control.isLoading = false;
            }
        },
        isValid: function()
        {
            var buy = this;

            var isValid = true;
           
            buy.validation.shares_taken = validationService.isInteger(buy.hashtag.shares_taken);
            buy.validation.portfolio = validationService.dropdownOption(buy.hashtag.portfolio);
            
            angular.forEach(buy.validation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });

            return isValid;
        }

        
	};

    portfoliosService.then(function(service)
    {
        $scope.buy.userPortfolios = service.data;
    });

    $scope.$watch(function () {
           return selectedPortfolioService.portfolioId;
         },                       
          function(newVal, oldVal) {
            if(newVal > 0)
            {
               $scope.buy.hashtag.portfolio = newVal;
            }
            
        }, true);

    $scope.$watch(function () {
           return buyTagService.id;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.hashtag_id = newVal;
            $scope.buy.hashtag.shares_taken = 0;
        }, true);

    $scope.$watch(function () {
           return buyTagService.tag;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.tag = newVal;
        }, true);

    $scope.$watch(function () {
           return buyTagService.price;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.price = newVal;
        }, true);


    $scope.$watch(function () {
           return $scope.buy.hashtag.shares_taken;
         },                       
          function(newVal, oldVal) {
            $scope.buy.total = newVal * $scope.buy.hashtag.price;
        }, true);
});

})();
