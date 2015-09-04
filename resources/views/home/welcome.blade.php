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

<div class="home-container light" ng-controller="betaWaitController">
	<div class="row">
		<p>
			We are currently in a closed beta test, but if you'd like us to let you know when we move to the open beta please fill in the form below.
		</p>
		
		<p>
			<div ng-show="betaWait.message != ''">
              <div class="col-md-12">
                <div class="alert alert-success">{{betaWait.message}}</div> 
              </div>
            </div>
			<form ng-submit="betaWait.submit()" class="form-horizontal form-label-left">

              <div class="item form-group" ng-class="{bad: !betaWait.validation.email.isValid}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="email" ng-model="betaWait.inputs.email" type="text" class="form-control col-md-7 col-xs-12" />
                  </div>
                  <div class="alert" ng-hide="betaWait.validation.email.isValid">{{betaWait.validation.email.message}}</div> 
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-success">Submit</button>
                  </div>
              </div>
            </form>
		</p>
	</div>
</div>
@stop



