@extends('shared.full')

@section('content')
<div ng-controller="searchController" ng-init="search.init('[[$term]]')" ng-cloak>
  <div>
      @include('account.account-header-partial')
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" ng-hide="search.control.isLoading">
                <div class="x_title">
                    <h1>Search Hashtags - [[$term]]</h1>
                    <h2>Hashtags Found</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Hashtag</th><th>Current Price</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="hashtag in search.hashtags">
                      <td scope="row"><a href="/hashtag/{{hashtag.id}}" target="_blank">{{hashtag.tag}}</a></td><td>{{hashtag.current_price | currency}}</td>
                      <td><cdn-buy-button button-size="xs" hashtag-id="{{hashtag.id}}" tag="{{hashtag.tag}}" price="{{hashtag.current_price}}" event-handler="" /></td>
                    </tr>
                    <tr ng-show="search.hashtags.length == 0 && !search.control.isLoading">
                      <td class="no-record" colspan="3">No Hashtags Found</td>
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
