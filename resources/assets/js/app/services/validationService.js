(function () {

'use strict';

angular.module('appMain')
    .service('validationService', function() {

        this.EMAIL_REGEXP = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        this.PASSWORD_REGEXP = /^[a-zA-Z0-9]{7,}$/;
        this.SHORTDESCRIPTION = /^[a-zA-Z0-9]{3,}$/;

        this.shortDescription = function(description)
        {
            var isValid = description.match(this.SHORTDESCRIPTION) != null;
            return { isValid: isValid, message: isValid ? '' : 'Please enter a value'};
        }

        this.email = function(email)
        {
            var isValid = email.match(this.EMAIL_REGEXP) != null;
            return { isValid: isValid, message: isValid ? '' : 'Please enter an email'};
        }

        this.password = function(password)
        {
            var isValid = password.match(this.PASSWORD_REGEXP) != null;
            return { isValid: isValid, message: isValid ? '' : 'Not a valid password'};
        }

        this.isInteger = function(val)
        {
            var isValid = (val > 0);
            return { isValid: isValid, message: isValid ? '' : 'Number above 0 needed'};
        }

        this.dropdownOption = function(val)
        {
            var isValid = (val > 0);
            return { isValid: isValid, message: isValid ? '' : 'Please select value'};
        }
    });

})();
