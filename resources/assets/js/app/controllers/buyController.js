
(function () {

'use strict';

angular.module('appMain')

.controller('buyController', function($scope, $http, buyTagService, validationService, pnotifyService, portfoliosService, selectedPortfolioService) {
    $scope.buy =
    {
    	control: {
            isLoading: false,
            isSubmitted: false
        },
        userPortfolios: null,
        profile: {
            portfolio: null,
            profile_id: 0,
            shares_taken: 0,
            price: 0,
            name: ''
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
                    'profile_id': buy.profile.profile_id,
                    'shares_taken': buy.profile.shares_taken,
                    'portfolio_id': buy.profile.portfolio
                };

                $http.post('/api/trades/create', postData)
                    .success(function(data){
                        if (data.success == true)
                        {
                            selectedPortfolioService.boughtPortfolioValue(buy.profile.portfolio, buy.total);
                            $('#buy-modal').modal('hide');
                            pnotifyService.success('Trade Complete', 'Profile has been bought');

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

            buy.validation.shares_taken = validationService.isInteger(buy.profile.shares_taken);
            buy.validation.portfolio = validationService.dropdownOption(buy.profile.portfolio);

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
               $scope.buy.profile.portfolio = newVal;
            }

        }, true);

    $scope.$watch(function () {
           return buyTagService.id;
         },
          function(newVal, oldVal) {
            $scope.buy.profile.profile_id = newVal;
            $scope.buy.profile.shares_taken = 0;
        }, true);

    $scope.$watch(function () {
           return buyTagService.tag;
         },
          function(newVal, oldVal) {
            $scope.buy.profile.tag = newVal;
        }, true);

    $scope.$watch(function () {
           return buyTagService.price;
         },
          function(newVal, oldVal) {
            $scope.buy.profile.price = newVal;
        }, true);


    $scope.$watch(function () {
           return $scope.buy.profile.shares_taken;
         },
          function(newVal, oldVal) {
            var price = Number($scope.buy.profile.price);
            if (typeof newVal == 'undefined')
            {
                newVal = 1000;
            }

            $scope.buy.total = Number(newVal * price);
        }, true);
});

})();
