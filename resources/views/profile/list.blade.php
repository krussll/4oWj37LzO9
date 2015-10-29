@extends('shared.full')

@section('content')
<div ng-controller="listController" ng-init="list.init()" ng-cloak>
  <div>
      @include('account.account-header-partial')
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" ng-hide="search.control.isLoading">
                <div class="x_title">
                    <h2>Profiles</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" ng-class="{loadingsection: list.control.isLoading}">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Profile</th><th>Current Price</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="profile in list.profiles">
                      <td scope="row"><a target="_blank" href="/profile/{{profile.id}}">{{profile.name}}</a></td><td>{{layout.consts.siteCurrency}}{{profile.current_price | number:2 }}</td>
                      <td><cdn-buy-button button-size="xs" profile-id="{{profile.id}}" tag="{{profile.name}}" price="{{profile.current_price}}" event-handler="" /></td>
                    </tr>
                    <tr ng-show="list.hashtags.length == 0 && !list.control.isLoading">
                      <td class="no-record" colspan="3">No profiles found</td>
                    </tr>
                    <tr ng-show="list.control.isLoading">
                      <td class="no-record" colspan="3"><img src="/cdn/ajax-loader.gif" /></td>
                    </tr>
                  </tbody>
                  </table>
                  <paging
                    page="list.paging.currentPage"
                    page-size="list.paging.pageLength"
                    total="list.paging.total"
                    paging-action="list.listProfiles('profile', page)">
                  </div>
                </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop
