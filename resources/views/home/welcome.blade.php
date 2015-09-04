@extends('shared.full')

@section('content')

<div class="wide">
    <div class="header-content">
      <div class="col-xs-12 site_title">
        <h1>{{ layout.consts.siteName | uppercase }}</h1>
        <h3>Make money, beat your friends</h3>
      </div>
    </div>
</div>


<div class="home-container light" ng-controller="homeController" ng-init="home.init()">
	<div class="row">
		<p>
			Tagdaq is a free to play hashtag trading game, where to play against your friends to make the most on your portfolio. Buy low, sell high - or hold on and pick up the dividends.
		</p>
	</div>
</div>

<div class="home-container light">
	<div class="row">
		<p>
			We are currently in Beta mode, so expect updates and improvements.
		</p>
	</div>
</div>
@stop
