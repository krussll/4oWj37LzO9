@extends('shared.sidebar')

@section('content')
<div ng-controller="leagueCreateController" ng-init="leagueCreate.init()" ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h3>Create</h3>
    </div>

    

  </div>
  <div>
      
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>League Details</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form ng-submit="leagueCreate.submit()" class="form-horizontal form-label-left">

                  <div class="item form-group" ng-class="{bad: !leagueCreate.validation.name.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" ng-model="leagueCreate.league.name" type="text" class="form-control col-md-7 col-xs-12" /> 
                      </div>
                      <div class="alert" ng-hide="leagueCreate.validation.name.isValid">{{leagueCreate.validation.name.message}}</div>
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

      </div>
  </div>
</div>
@stop