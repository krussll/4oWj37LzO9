(function () {

'use strict';

angular.module('appMain')

.controller('settingsController', function($scope, $http, pnotifyService, validationService) {
    $scope.settings =
    {
    	control: {
            isLoading: true
        },
        nameInputs: {
            firstname: '',
            surname: ''
        },
        passwordInputs: {
            currentPassword: '',
            newPassword: '',
            confirmPassword: ''
        },
        nameValidation: {
            firstname: {
                isValid: true,
                message: ''
            },
            surname: {
                isValid: true,
                message: ''
            }
        },
        passwordValidation:
        {
            currentPassword: {
                isValid: true,
                message: ''
            },
            newPassword: {
                isValid: true,
                message: ''
            },
            confirmPassword: {
                isValid: true,
                message: ''
            }
        },
        init: function ()
        {
            var settings = this;
            settings.control.isLoading = true;

            $http.get('/api/users/details')
                .success(function(data){
                    settings.nameInputs.firstname = data.firstname;
                    settings.nameInputs.surname = data.surname;
                });
        },
        changePassword: function()
        {
            var settings = this;

            if(settings.changePasswordIsValid())
            {
                $http.post('api/users/password/change', settings.passwordInputs)
                .success( function(data)
                        {
                            if (data.success == true)
                            {
                                pnotifyService.success('Update Complete', 'Your details have been updated');
                                settings.passwordInputs.currentPassword = '';
                                settings.passwordInputs.newPassword = '';
                                settings.passwordInputs.confirmPassword = '';
                            }else
                            {
                                pnotifyService.error('Update Complete', data.message);
                            }
                        }
                    );
            }

        },
        changeName: function()
        {
            var settings = this;

            if (settings.changeNameIsValid())
            {
                var postVals = {
                    firstname: settings.nameInputs.firstname,
                    surname: settings.nameInputs.surname
                };
                $http.post('api/users/details/change', postVals)
                    .success( function(data)
                        {
                            if (data.success == true)
                            {
                                pnotifyService.success('Update Complete', 'Your details have been updated');
                            }
                        }
                    );
            }
        },
        changeNameIsValid: function()
        {
            var settings = this;
            var isValid = true;

            settings.nameValidation.firstname = validationService.shortDescription(settings.nameInputs.firstname);
            settings.nameValidation.surname = validationService.shortDescription(settings.nameInputs.surname);

            angular.forEach(settings.nameValidation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });

            return isValid;
        },
        changePasswordIsValid: function()
        {
            var settings = this;
            var isValid = true;

            settings.passwordValidation.currentPassword = validationService.password(settings.passwordInputs.currentPassword);
            settings.passwordValidation.newPassword = validationService.password(settings.passwordInputs.newPassword);


            if (settings.passwordInputs.newPassword !== settings.passwordInputs.confirmPassword)
            {
                isValid = false;
                settings.passwordValidation.confirmPassword.isValid = false;
                settings.passwordValidation.confirmPassword.message = 'Passwords don\'t match';
            }else
            {
                settings.passwordValidation.confirmPassword.isValid = true;
                settings.passwordValidation.confirmPassword.message = '';
            }

            angular.forEach(settings.passwordValidation, function(validation)
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
