@extends('shared.full')

@section('content')
<div ng-controller="searchController" ng-init="search.init('[[$term]]')" ng-cloak>
  <div>
      @include('account.account-header-partial')
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" ng-hide="search.control.isLoading">
                <div class="x_title">
                    <h1>Searching - [[$term]]</h1>
                    <h2>Profiles Found</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Profile</th><th>Current Price</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="profile in search.profiles">
                      <td scope="row"><a href="/profile/{{profile.id}}" target="_blank">{{profile.name}}</a></td><td>{{layout.consts.siteCurrency}}{{profile.current_price | number:2  }}</td>
                      <td><cdn-buy-button button-size="xs" hashtag-id="{{profile.id}}" tag="{{profile.name}}" price="{{profile.current_price}}" event-handler="" /></td>
                    </tr>
                    <tr ng-show="search.profiles.length == 0 && !search.control.isLoading">
                      <td class="no-record" colspan="3">No Profiles Found</td>
                    </tr>
                    <tr ng-show="search.control.isLoading">
                      <td class="no-record" colspan="3"><img src="/cdn/ajax-loader.gif" /></td>
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
