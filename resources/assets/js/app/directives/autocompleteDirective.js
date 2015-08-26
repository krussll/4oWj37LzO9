(function () {

'use strict';

angular.module('appMain')
    .directive('googleplace', function() {
        return {
            require: 'ngModel',
            link: function(scope, element, attrs, model) {
                var options = {componentRestrictions: {country: 'gb'}, types: ['(cities)']};
               
                scope.gPlace = new google.maps.places.Autocomplete(element[0], options);
                
                google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                    scope.$apply(function() {
                       scope.geoId = scope.gPlace.getPlace().place_id;
                       
                        model.$setViewValue(element.val());                
                    });
                });

            },
        };
    });

})();
