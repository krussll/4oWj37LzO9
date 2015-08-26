(function () {

'use strict';

angular.module('appMain')
    .service('pnotifyService', function() {
        this.success = function(title, message)
        {

            var notice = new PNotify({
                    title: title,
                    text: message,
                    type: 'success',
                    mouse_reset: false,
                    delay:2000,
                    buttons: {
                        closer: true,
                        sticker: false
                    }
                });
            
        }

        this.error = function(title, message)
        {
            new PNotify({
                    title: title,
                    text: message,
                    type: 'error',
                    mouse_reset: false,
                    delay:2000,
                    buttons: {
                        closer: true,
                        sticker: false
                    }
                });
        }
    });

})();
