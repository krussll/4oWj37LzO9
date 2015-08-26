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


    <div class="row light" ng-controller="homeController" ng-init="home.init()">

  </div>
@stop
