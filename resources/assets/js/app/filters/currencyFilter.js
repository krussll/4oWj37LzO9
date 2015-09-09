(function () {

'use strict';

angular.module('appMain')
    .filter('currency', function() {
    return function(s) {
        return s;
    };
});

})();
