(function () {

'use strict';

angular.module('appMain')
    .filter('percentageDifference', function() {
    return function(s, oldValue, newValue) {
    	var symbol = '';
    	if (oldValue <= newValue)
    	{
    		symbol = '+';
    	}

    	var val = (((newValue - oldValue)/oldValue) * 100).toFixed(2)
        return symbol + val + '%';
    };
});

})();
