

(function () {

'use strict';

angular.module('appMain')

.controller('loginController', function($scope, $http, validationService) {
    $scope.login =
    {
        inputs: {
            email: '',
            password: '',
        },
    	control: {
    		isLoading: false
    	},
        validation: {
            email: {
                isValid: true,
                message: ''
            },
            password: {
                isValid: true,
                message: ''
            },
            overview: {
                isValid: true,
                message: ''
            }
        },
        submit: function() {

            var login = this;
            login.control.isLoading = true;
            if(login.isValid())
            {
              $http.post('/api/login/auth', login.inputs)
                .success(function(data)
                {
                    if (data.success === true)
                    {
                        window.location = 'dashboard' ;
                    }else
                    {
                        login.validation.email.isValid = false;
                        login.validation.email.message = 'Incorrect email/password';

                        login.validation.password.isValid = false;
                        login.validation.password.message = 'Incorrect email/password';
                        login.control.isLoading = false;
                    }
                });
            }else {
              login.control.isLoading = false;
            }

        },
        isValid: function()
        {
            var login = this;
            var isValid = true;

            login.validation.email = validationService.email(login.inputs.email);
            login.validation.password = validationService.password(login.inputs.password);

            angular.forEach(login.validation, function(validation)
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
