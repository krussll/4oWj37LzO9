
(function () {

'use strict';

angular.module('appMain')

.controller('contactController', function($scope, $http, pnotifyService) {
    $scope.contact =
    {
    	control: {
            isLoading: false,
            isSubmitted: false
        },
        userPortfolios: null,
        inputs: {
            subject: '',
            message: ''
        },
        submit: function()
        {
            var contact = this;
            contact.control.isLoading = true;

            $http.post('/api/contact/create', contact.inputs)
                .success(function(data){
                    if (data.success == true)
                    {
                        $('#contact-modal').modal('hide');
                        pnotifyService.success('Message Sent', 'Thanks for the message.');

                        contact.control.isSubmitted = true;
                    }else {
                        pnotifyService.error('Message Error', data.message);
                    }

                    contact.control.isLoading = false;
                });

        }


	};
});

})();
