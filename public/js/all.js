var app = angular.module('appMain', ['ngCookies']);


(function () {

'use strict';

angular.module('appMain')

.controller('layoutController', function($scope, $http) {
    $scope.layout =
    {
      control: {
        isLoading: false
      },
        logout: function() {

            var login = this;
            $http.post('/api/login/destroy')
            .success(function(data)
                {
                    window.location = '/';
                });
        },
        consts:
        {
            siteName: 'tagdaq'
        }
	}
});

})();



(function () {

'use strict';

angular.module('appMain')

.controller('homeController', function($scope, $http, $location) {
    $scope.home = 
    {
    	control: {
    		isLoading: false
    	},
        search: {
            location: ''
        },
    	profiles: null,
    	init: function ()
    	{
    		var home = this;
    	},
        geoId: null,
    	submit: function () {
            var home = this;
            window.location = "s/" + home.search.location;
        },
        geoid: null,
	}
});

})();


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
                    }
                });
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

(function () {

'use strict';

angular.module('appMain')

.controller('searchController', function($scope, $http) {
    $scope.search = 
    {
    	control: {
            isLoading: true
        },
        inputs: {
            hashtag: ''
        },
        hashtags:[],
        init: function (hashtag)
        {
            var search = this;
            search.inputs.hashtag = hashtag;
            search.control.isLoading = true;

            search.searchHashtags();
        },
        searchHashtags: function()
        {
            var search = this;
            search.control.isLoading = true;

            $http.get('/api/hashtags/byname?tag=' + search.inputs.hashtag)
                .success(function(data){
                    search.hashtags = data;
                    search.control.isLoading = false;
                });
        }        
	}
});

})();


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
(function () {

'use strict';

angular.module('appMain')

.controller('userShowController', function($scope, $http) {
    $scope.userShow = 
    {
    	control: {
            isLoading: true
        },
        id: '',
        geocode: null,
        user: null,
        
        init: function (id)
        {
            var userShow = this;
            userShow.id = id;
            userShow.control.isLoading = true;

            $http.get('/api/users/id?id=' + userShow.id)
                .success(function(data){
                    userShow.user = data;
                    userShow.control.isLoading = false;
                });
            
        }      
	}
});

})();
(function () {

'use strict';

angular.module('appMain')

.controller('dashboardController', function($scope, $http, selectedPortfolioService) {
    $scope.dashboard = 
    {
    	control: {
            isLoading: true,
            hashtagsLoading: true,
        },
        activeTrades: [],
        popularHashtags: [],
        globalLeagues: [],
        privateLeagues: [],
        popularHashtag: null,
        searchTerm: '',
        invalidSearch: false,
        init: function ()
        {
            var dashboard = this;
            dashboard.control.isLoading = true;
            dashboard.control.hashtagsLoading = true;


            $http.get('/api/hashtags/popular')
                .success(function(data){
                    dashboard.popularHashtags = data;
                    if (data.length > 0)
                    {
                        dashboard.popularHashtag = data[0];
                    }
                    dashboard.control.hashtagsLoading = false;
                });

            $http.get('/api/leagues/user/positions')
                .success(function(data){
                    dashboard.globalLeagues = data.global;
                    dashboard.privateLeagues = data.private;
                    
                    dashboard.control.hashtagsLoading = false;
                });
            
        },
        searchHashtags: function() {
            var dashboard = this;
                dashboard.invalidSearch = false;

            if (dashboard.searchTerm != '')
            {
                window.location = 'hashtag/search/' + dashboard.searchTerm;
            }else {
                dashboard.invalidSearch = true;
            }
            
        },
        updateTrades: function()
        {
            var dashboard = this;
            var id = selectedPortfolioService.getPortfolioId();
            $http.get('/api/trades/active?portfolio_id=' + id)
                .success(function(data){
                    dashboard.activeTrades = data.trades;
                    dashboard.control.isLoading = false;
                });
        } 
	};

    $scope.$watch(function () {
           return selectedPortfolioService.portfolioId;
         },                       
          function(newVal, oldVal) {
            if(newVal > 0)
            {
               $scope.dashboard.updateTrades(); 
            }
            
        }, true);
});

})();
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
                            console.log(data);
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


(function () {

'use strict';

angular.module('appMain')

.controller('hashtagShowController', function($scope, $http) {
    $scope.hashtagShow = 
    {
    	control: {
    		isLoading: false
    	},
        id: null,
        hashtag: null,
        prices: [],
    	profiles: null,
    	init: function (id)
    	{
    		var hashtagShow = this;
            hashtagShow.control.isLoading = true;

            hashtagShow.id = id;
            $http.get('/api/hashtags/id?id=' + hashtagShow.id)
                .success(function(data){
                    hashtagShow.hashtag = data;
                    hashtagShow.control.isLoading = false;
                });

            
            
    	},
	}
});

})();


(function () {

'use strict';

angular.module('appMain')

.controller('leagueShowController', function($scope, $http) {
    $scope.leagueShow = 
    {
    	control: {
    		isLoading: false
    	},
        id: null,
        type: null,
        name: null,
        positions: [],
    	init: function (id)
    	{
    		var leagueShow = this;
            leagueShow.control.isLoading = true;
            leagueShow.id = id;
            leagueShow.type = '';

            $http.get('/api/leagues/' + leagueShow.id + '/positions')
                .success(function(data){
                    leagueShow.positions = data.positions;
                    leagueShow.name = data.name;
                    leagueShow.control.isLoading = false;
                });

            
            
    	},
	}
});

})();

(function () {

'use strict';

angular.module('appMain')

.controller('buyController', function($scope, $http, buyTagService, validationService, pnotifyService, portfoliosService, selectedPortfolioService) {
    $scope.buy =
    {
    	control: {
            isLoading: false,
            isSubmitted: false
        },
        userPortfolios: null,
        hashtag: {
            portfolio: null,
            hastag_id: 0,
            shares_taken: 0,
            price: 0,
            tag: ''
        },
        validation: {
            portfolio: {
                isValid: true,
                message: ''
            },
            shares_taken: {
                isValid: true,
                message: ''
            }
        },
        total:0,
        init: function()
        {
            var buy = this;
            buy.userPortfolios = []; 
        },
        buy: function()
        {
            var buy = this;
            buy.control.isLoading = true;

            if(buy.isValid())
            {
                var postData = {
                    'hashtag_id': buy.hashtag.hashtag_id,
                    'shares_taken': buy.hashtag.shares_taken,
                    'portfolio_id': buy.hashtag.portfolio
                };

                $http.post('/api/trades/create', postData)
                    .success(function(data){
                        console.log(data);
                        if (data.success == true)
                        {
                            $('#buy-modal').modal('hide');
                            pnotifyService.success('Trade Complete', 'Hashtag has been bought');

                            if(angular.isFunction(buyTagService.callback))
                            {
                                buyTagService.callback();
                            }
                            
                            buy.control.isSubmitted = true;
                        }else {
                            pnotifyService.error('Trade Error', data.message);
                        }
                        
                        buy.control.isLoading = false;
                    });
            }else
            {
                buy.control.isLoading = false;
            }
        },
        isValid: function()
        {
            var buy = this;

            var isValid = true;
           
            buy.validation.shares_taken = validationService.isInteger(buy.hashtag.shares_taken);
            buy.validation.portfolio = validationService.dropdownOption(buy.hashtag.portfolio);
            
            angular.forEach(buy.validation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });

            return isValid;
        }

        
	};

    portfoliosService.then(function(service)
    {
        $scope.buy.userPortfolios = service.data;
    });

    $scope.$watch(function () {
           return selectedPortfolioService.portfolioId;
         },                       
          function(newVal, oldVal) {
            if(newVal > 0)
            {
               $scope.buy.hashtag.portfolio = newVal;
            }
            
        }, true);

    $scope.$watch(function () {
           return buyTagService.id;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.hashtag_id = newVal;
            $scope.buy.hashtag.shares_taken = 0;
        }, true);

    $scope.$watch(function () {
           return buyTagService.tag;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.tag = newVal;
        }, true);

    $scope.$watch(function () {
           return buyTagService.price;
         },                       
          function(newVal, oldVal) {
            $scope.buy.hashtag.price = newVal;
        }, true);


    $scope.$watch(function () {
           return $scope.buy.hashtag.shares_taken;
         },                       
          function(newVal, oldVal) {
            $scope.buy.total = newVal * $scope.buy.hashtag.price;
        }, true);
});

})();


(function () {

'use strict';

angular.module('appMain')

.controller('sideNavController', function($scope, portfoliosService, selectedPortfolioService) {
    $scope.sideNav =
    {
        userPortfolios: null,
        portfolio: null,
        change: function () {
            var sideNav = this;
            selectedPortfolioService.setPortfolioId(sideNav.portfolio.id);
        }
	};

    portfoliosService.then(function(service)
    {
        $scope.sideNav.userPortfolios = service.data;
        $scope.sideNav.portfolio = selectedPortfolioService.getPortfolio();
    });

});

})();

(function () {

'use strict';

angular.module('appMain')

.controller('leaguesController', function($scope, $http, selectedPortfolioService) {
    $scope.leagues = 
    {
        join: {
            code: '',
            message: '',
            showMessage: false
        },
        globalLeagues: [],
        privateLeagues: [],
        init: function ()
        {
            var leagues = this;

            $http.get('/api/leagues/user/positions')
                .success(function(data){
                    leagues.globalLeagues = data.global;
                    leagues.privateLeagues = data.private;
                    
                });
            
        },
        joinSubmit: function()
        {
           var leagues = this;
           
           leagues.join.showMessage = false;
           if(leagues.join.code === '')
           {
                leagues.join.message = 'Please enter a code';
                leagues.join.showMessage = true;
           }else
           {
            $http.post('/api/leagues/join/' + leagues.join.code)
                .success(function(data){
                    if(data.success)
                    {
                        window.location = '/league/' + data.id;
                    }else {
                        leagues.join.message = data.message;
                        leagues.join.showMessage = true;
                    }
                    
                });
           }
        }
	};

});

})();

(function () {

'use strict';

angular.module('appMain')

.controller('leagueCreateController', function($scope, $http, validationService) {
    $scope.leagueCreate =
    {
    	control: {
            isLoading: true,
            isSubmitted: false
        },
        league: {
            name: ''
        },
        validation: {
            name: {
                isValid: true,
                message: ''
            },
        },
        init: function()
        {
            var leagueCreate = this;
        },
        submit: function()
        {
            var leagueCreate = this;

            if (leagueCreate.isValid())
            {
               $http.post('/api/leagues/create', leagueCreate.league)
                .success(function(data) 
                {
                    if (data.success === true)
                    {
                        window.location = '/league/' + data.id + '?r=true';
                    }
                }); 
            }            
        },
        isValid: function()
        {
            var leagueCreate = this;

            var isValid = true;
       
            leagueCreate.validation.name = validationService.shortDescription(leagueCreate.league.name);

            angular.forEach(leagueCreate.validation, function(validation)
            {
                if (validation.isValid === false)
                {
                    isValid = false;
                }
            });
            return isValid;
        }

        
	};

});

})();

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

(function () {

'use strict';

angular.module('appMain')
    .directive('cdnImage', function() {
        return {
            restrict:'E',
            template: '<img ng-src="{{imageSrc}}" class="{{cdnClass}}" />',
            scope: {
                cdnSrc: '@',
                cdnFile: '@',
                cdnClass: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.imageSrc = '';

               attrs.$observe('cdnFile', function () {
                    if (scope.cdnSrc.length > 0 && scope.cdnFile.length > 0)
                    {
                        scope.imageSrc = '/cdn/' + scope.cdnSrc + '/' + scope.cdnFile;
                    }else
                    {
                        scope.imageSrc = '/cdn/placeholder.jpg';
                    }
                
                }); 
            },
        };
    });

})();

(function () {

'use strict';

angular.module('appMain')
    .directive('cdnBuyButton', function($http, pnotifyService, buyTagService) {
        return {
            restrict:'E',
            template: '<a ng-disabled="isLoading" href="#buy-modal" data-toggle="modal" class="btn btn-success btn-{{buttonSize}}" ng-click="buy();"> Buy </a>',
            scope: {
                eventHandler: '&',
                buttonSize: '@',
                hashtagId: '@',
                price: '@',
                tag: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.buy = function()
                {
                    buyTagService.setData(scope.hashtagId, scope.tag, scope.price);
                    buyTagService.setCallback(scope.eventHandler);
                }
            },
            
            
        };
    });

})();

(function () {

'use strict';

angular.module('appMain')
    .directive('cdnSellButton', function($http, pnotifyService) {
        return {
            restrict:'E',
            template: '<a ng-disabled="isLoading" href="#" class="btn btn-danger btn-{{buttonSize}}" ng-click="sell();"> Sell </a>',
            scope: {
                eventHandler: '&',
                buttonSize: '@',
                tradeId: '@'
            },
            link: function(scope, element, attrs, model) {
               scope.sell = function()
                {
                    scope.isLoading = true;
                    
                    var postData = {
                        id: scope.tradeId
                    };
                    
                    $http.post('/api/trades/complete', postData)
                        .success(function(data){
                            console.log(data);
                            if (data.success == true)
                            {
                                pnotifyService.success('Trade Complete', 'Hashtag has been sold');
                                scope.eventHandler();
                            }else {
                                pnotifyService.error('Trade Failed', 'Something went wrong');
                            }
                            
                            scope.isLoading = false;
                        });
                }
            },
            
            
        };
    });

})();

(function () {

'use strict';

angular.module('appMain')
    .directive('priceGraph', function($http, pnotifyService) {
        return {
            restrict:'E',
            template: '<div id="graph_line" style="width:100%; height:300px;"></div>',
            scope: {
                hashtagId: '@'
            },
            link: function(scope, element, attrs, model) {
               attrs.$observe('hashtagId', function () {
                    $http.get('/api/hashtags/counts?id=' + scope.hashtagId)
                        .success(function(data){
                        new Morris.Area({
                            element: 'graph_line',
                            xkey: 'created_at',
                            ykeys: ['amount'],
                            labels: ['Price'],
                            hideHover: 'auto',
                            xLabels: "day",
                            lineColors: ['#26B99A'],
                            data: data
                        });
                    });
                }); 
            },
            
            
        };
    });

})();

(function () {

'use strict';

angular.module('appMain')
    .filter('titlecase', function() {
    return function(s) {
        s = ( s === undefined || s === null ) ? '' : s;
        return s.toString().toLowerCase().replace( /\b([a-z])/g, function(ch) {
            return ch.toUpperCase();
        });
    };
});

})();

(function () {

'use strict';

angular.module('appMain')
    .filter('currency', function() {
    return function(s) {
        return '$' + s;
    };
});

})();

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

(function () {

'use strict';

angular.module('appMain')
    .service('validationService', function() {

        this.EMAIL_REGEXP = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        this.PASSWORD_REGEXP = /^[a-zA-Z0-9]{7,}$/;
        this.SHORTDESCRIPTION = /^[ a-zA-Z0-9]{3,}$/;

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

(function () {

'use strict';

angular.module('appMain')
    .factory('portfoliosService', function($http) {
    	var promise = $http.get('/api/user/portfolios')
                .success(function(data){
                    var userPortfolios = {
                        portfolios: data
                    };
                   
                    return userPortfolios;
                });


        return promise;
    });

})();

(function () {

'use strict';

angular.module('appMain')
    .service('selectedPortfolioService', ['$cookies', 'portfoliosService', function($cookies, portfoliosService) {
        var selectedPortfolio = {};

        selectedPortfolio.portfolioId = -1;
        selectedPortfolio.portfolio = null;

        portfoliosService.then(function(service)
        {
            selectedPortfolio.portfolios = service.data;

            if($cookies.tagdaqportfolio > 0)
            {
                var useId = false;
                var id = $cookies.tagdaqportfolio;

                for (var i = 0; i < selectedPortfolio.portfolios.length; i++) {
                    if (selectedPortfolio.portfolios[i].id == id)
                    {
                        selectedPortfolio.portfolio = selectedPortfolio.portfolios[i];
                        useId = true;
                        break;
                    }
                }

                if (useId === false)
                {
                    selectedPortfolio.portfolio = selectedPortfolio.portfolios[i];
                    if (selectedPortfolio.portfolio)
                    {
                        id = selectedPortfolio.portfolio.id;
                    }else {
                        id = 0;
                    }
                        
                }
            }else
            {
                selectedPortfolio.portfolio = selectedPortfolio.portfolios[i];
                var id = selectedPortfolio.portfolios[0].id;
            }
            
            if(id > 0)
            {
               selectedPortfolio.setPortfolioId(id); 
            }
        });

        selectedPortfolio.setPortfolioId = function(id)
        {
            selectedPortfolio.portfolioId = id;
            
            $cookies.tagdaqportfolio = id;
        }

        selectedPortfolio.getPortfolio = function()
        {
            return selectedPortfolio.portfolio;
        }
        
        selectedPortfolio.getPortfolioId = function()
        {
            return selectedPortfolio.portfolioId;
        }

        return selectedPortfolio;
    }]);

})();

//# sourceMappingURL=all.js.map