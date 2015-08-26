

(function () {

'use strict';

angular.module('appMain')

.controller('registerController', function($scope, $http, validationService) {
    $scope.register = 
    {
        inputs: {
            firstname: '',
            surname: '',
            email: '',
            password: '',
        },
        validation: {
            firstname: {
                isValid: true,
                message: ''
            },
            surname: {
                isValid: true,
                message: ''
            },
            email: {
                isValid: true,
                message: ''
            },
            password: {
                isValid: true,
                message: ''
            },
        },
    	control: {
    		isLoading: false
    	},
        submit: function () {
            var register = this;
            if (register.isValid())
            {
               $http.post('/api/users/create', register.inputs)
                .success(function(data) 
                {
                    if (data.success === true)
                    {
                        window.location = '/dashboard?r=true';
                    }else
                    {
                        console.log('error');
                    }
                }); 
            }
            
        },
        isValid: function() {
            var register = this;
            var isValid = true;
            
            register.validation.firstname = validationService.shortDescription(register.inputs.firstname);
            register.validation.surname = validationService.shortDescription(register.inputs.surname);
            register.validation.email = validationService.email(register.inputs.email);
            register.validation.password = validationService.password(register.inputs.password);
            

            angular.forEach(register.validation, function(validation)
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