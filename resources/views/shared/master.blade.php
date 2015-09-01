<!DOCTYPE html>
<html ng-app="appMain" ng-controller="layoutController" ng-cloak>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <title ng-bind="layout.consts.siteName | uppercase"></title>
<link rel="shortcut icon"  href="/favicon.ico"/>
    <!-- Bootstrap core CSS -->

    {!! Minify::stylesheet('/css/bootstrap.min.css') !!}
    {!! Minify::stylesheet('/css/bootstrap.min.css') !!}
    {!! Minify::stylesheet('/fonts/css/font-awesome.min.css') !!}

    <!-- Custom styling plus plugins -->
    {!! Minify::stylesheet('/css/custom.css') !!}
    {!! Minify::stylesheet('/css/maps/jquery-jvectormap-2.0.1.css') !!}
    {!! Minify::stylesheet('/css/icheck/flat/green.css') !!}
    {!! Minify::stylesheet('/css/floatexamples.css') !!}


    {!! Minify::javascript('/js/jquery.min.js') !!}

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- Google fonts -->
      <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-67012989-1', 'tagdaq.herokuapp.com');
          ga('send', 'pageview');

        </script>
</head>


<body class="nav-md">
     <!-- buy login -->
    <div class="modal fade" ng-controller="buyController" ng-init="buy.init()" id="login-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Login</h4>
                </div>
                <div class="modal-body">
                    @include('account.login-partial')
                </div>
            </div>
        </div>
    </div>





    <!-- buy modal -->
    <div class="modal fade" ng-controller="buyController" ng-init="buy.init()" id="buy-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form ng-submit="buy.buy()">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Buy Shares</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3>#{{buy.hashtag.tag}}</h3>
                                </div>
                            </div>
                        </div>
                        <form class="form-horizontal form-label-left">
                            <div class="form-group item" ng-class="{bad: !buy.validation.portfolio.isValid}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Portfolio <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select ng-model="buy.hashtag.portfolio" class="form-control">
                                                <option 
                                                        ng-repeat="portfolio in buy.userPortfolios"
                                                        value="{{portfolio.id}}">
                                                    {{portfolio.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="alert" ng-hide="buy.validation.portfolio.isValid">{{buy.validation.portfolio.message}}</div> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group item" ng-class="{bad: !buy.validation.shares_taken.isValid}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number of Shares <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="number-shares" ng-model="buy.hashtag.shares_taken" class="form-control">
                                        </div>
                                        <div class="alert" ng-hide="buy.validation.shares_taken.isValid">{{buy.validation.shares_taken.message}}</div> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h4>${{buy.hashtag.price}}</h4>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total Price
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h4>${{buy.total}}</h4>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
      <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
    </div> -->
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <div class="container body">


        <div class="main_container">
            @yield('layout')
        </div>


    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    {!! Minify::javascript('/js/bootstrap.min.js') !!}

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-cookies.js"></script>
   <!-- PNotify -->
    {!! Minify::javascript('/js/notify/pnotify.core.js') !!}
    {!! Minify::javascript('/js/notify/pnotify.buttons.js') !!}
    {!! Minify::javascript('/js/notify/pnotify.nonblock.js') !!}

    {!! Minify::javascript('/js/moris/raphael-min.js') !!}
    {!! Minify::javascript('/js/moris/morris.js') !!}
    {!! Minify::javascript('/js/all.js') !!}
    {!! Minify::javascript('/js/custom.js') !!}
    


</body>

</html>
