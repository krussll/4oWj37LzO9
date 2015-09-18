@extends('shared.full')

@section('content')
<div ng-controller="leaguesController" ng-init="leagues.init()" ng-cloak>

  <div class="modal fade" id="join-league-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h4 class="modal-title" id="avatar-modal-label">Edit League</h4>
              </div>
              <div class="modal-body">
                 <form ng-submit="leagues.joinSubmit()">
                    <div ng-show="leagues.join.showMessage">
                      <div class="col-md-12">
                        <div class="alert alert-danger">{{leagues.join.message}}</div>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="col-md-4 control-label">Name</label>
                      <div class="col-md-8">
                        <input id="name" ng-model="leagueShow.inputs.name" type="text" class="form-control col-md-7 col-xs-12" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                 </form>
              </div>
          </div>
      </div>
  </div>


  <div class="page-title">
    <div class="title_left">
        <h3>Leagues</h3>
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
                <a href="leagues/create">Create New League</a>
              </div>
              <div class="x_content">
                <a href="#join-league-modal" data-toggle="modal">Join League</a>
              </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Your Leagues</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table">
                    <thead>
                    <tr>
                      <th colspan="2">Global</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="league in leagues.globalLeagues">
                      <td scope="row">{{league.position}}</td><td><a href="/league/{{league.id}}">{{league.name | titlecase}}</a></td>
                    </tr>
                    <tr ng-show="leagues.globalLeagues.length == 0 && !leagues.control.isLoading">
                      <td class="no-record" colspan="3">No Active Trades</td>
                    </tr>
                  </tbody>
                  </table>
                </div>

                <div class="x_content2">
                  <table class="table">
                    <thead>
                    <tr>
                      <th colspan="2">Private</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="league in leagues.privateLeagues">
                      <td scope="row">{{league.position}}</td><td><a href="/league/{{league.id}}">{{league.name | titlecase}}</a></td>
                    </tr>
                    <tr ng-show="leagues.privateLeagues.length == 0 && !leagues.control.isLoading">
                      <td class="no-record" colspan="3">No Private Leagues</td>
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
