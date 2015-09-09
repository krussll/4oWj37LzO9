@extends('shared.sidebar')

@section('content')
<div ng-controller="leagueShowController" ng-init="leagueShow.init('[[$id]]')" ng-cloak>
  <div class="modal fade" id="edit-league-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h4 class="modal-title" id="avatar-modal-label">Join A League</h4>
              </div>
              <div class="modal-body">
                 <form ng-submit="leagueShow.submit()">
                    <div class="item form-group">
                      <label class="col-md-4 control-label">League Code</label>
                      <div class="col-md-8">
                        {{leagueShow.league.code}}
                      </div>
                    </div>
                 </form>
              </div>
          </div>
      </div>
  </div>





  <div class="page-title">
    <div class="title_left">
        <h3>{{leagueShow.league.name}}</h3>
        <a href="#edit-league-modal" data-toggle="modal" ng-show="leagueShow.control.isOwner">Join Code</a>
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
                      <td scope="row">${{position.balance | number }}</td>

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
