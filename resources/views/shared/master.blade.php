<!DOCTYPE html>
<html ng-app="appMain" ng-controller="layoutController" ng-cloak>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tagdaq - Twitter profile trading game</title>
    <meta id="description" name="description" content="Twitter Profile Trading - Free stock market game with player rank, profiles, earnings game."/>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
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

          ga('create', 'UA-67012989-1', 'auto');
          ga('send', 'pageview');

        </script>
</head>


<body class="nav-md">
     @include('shared.globalpopups-partial')
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
