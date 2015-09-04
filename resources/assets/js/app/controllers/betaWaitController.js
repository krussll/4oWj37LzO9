

(function () {

'use strict';

angular.module('appMain')

.controller('betaWaitController', function($scope, $http, validationService) {
    $scope.betaWait = 
    {
        inputs: {
            email: '',
        },
        validation: {
            email: {
                isValid: true,
                message: ''
            },
        },
        message: '',
    	control: {
    		isLoading: false
    	},
        submit: function () {
            var beta = this;
            if (beta.isValid())
            {
               $http.post('/api/beta/create', beta.inputs)
                .success(function(data) 
                {
                   beta.message = "Thanks, we'll contact you when we start the open beta.";
                }); 
            }
            
        },
        isValid: function() {
            var beta = this;
            var isValid = true;
            
            beta.validation.email = validationService.email(beta.inputs.email);
            

            angular.forEach(beta.validation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });
            return isValid;
        }
    	
	}
});

})();