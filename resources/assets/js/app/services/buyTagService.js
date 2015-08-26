(function () {

'use strict';

angular.module('appMain')
    .factory('buyTagService', function() {
    	var hashtag = {};
        hashtag.tag = '';
        hashtag.id = 0;
        hashtag.price = '';

        hashtag.callback = null;

        hashtag.setData = function(id, tag, price)
        {
        	hashtag.id = id;
        	hashtag.tag = tag;
        	hashtag.price = price;
        }

        hashtag.setCallback = function(callback)
        {
            hashtag.callback = callback;
        }

        return hashtag; 
    });

})();
