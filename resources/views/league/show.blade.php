@extends('shared.sidebar')

@section('content')
<div ng-controller="leagueShowController" ng-init="leagueShow.init('[[$type]]', '[[$id]]')" ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h3>League Detail</h3>
    </div>

    

  </div>
  <div>
      
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>League Standings</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="table">
                    <thead>
                    <tr>
                      <th>#</th><th>Name</th><th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="position in leagueShow.positions">
                      <td scope="row">{{$index + 1}}</td>
                      <td scope="row">{{position.firstname}} {{position.surname}}</td>
                      <td scope="row">{{position.balance}}</td>

                    </tr>
                  </tbody>
                  </table>
              </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop