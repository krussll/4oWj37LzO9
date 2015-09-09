@extends('shared.sidebar')

@section('content')
<div  ng-controller="dashboardController" ng-init="dashboard.init()"  ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h3>Dashboard</h3>
    </div>
    <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <form ng-submit="dashboard.searchHashtags()" >
        <div class="input-group" ng-class="{bad: dashboard.invalidSearch}">
            <input type="text" class="form-control" ng-model="dashboard.searchTerm" placeholder="Search for hashtags">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
          </div>
        </form>
      </div>
  </div>

  </div>
  <div>

      <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Active Trades</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Hashtag</th><th class="hidden-xs">Date Started</th><th>Shares Taken</th><th class="hidden-xs">Price Taken</th><th>Current Price</th><th>Change</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="trade in dashboard.activeTrades">
                      <td><a href="/hashtag/{{trade.hashtag.id}}">{{trade.hashtag.tag}}</a></td><td class="hidden-xs">{{trade.created_at}}</td><td class="hidden-xs">{{trade.shares_taken}}</td><td>{{trade.price_taken | currency}}</td><td>{{trade.hashtag.current_price | currency}}</td>
                      <td><span ng-class="{'green': (trade.hashtag.current_price - trade.price_taken ) >= 0, 'red': (trade.hashtag.current_price - trade.price_taken ) < 0}">{{trade.change | percentageDifference:trade.price_taken:trade.hashtag.current_price  }}</span></td>
                      <td><cdn-sell-button button-size="xs" trade-id="{{trade.id}}" event-handler="dashboard.updateTrades()" /></td>
                    </tr>
                  </tbody>
                  </table>
                </div>
            </div>


            <div class="x_panel" ng-show="dashboard.popularHashtag">
                <div class="x_title">
                    <h2>Current Popular Hashtag Price History - {{dashboard.popularHashtag.tag}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <price-graph hashtag-id="{{dashboard.popularHashtag.id}}" />
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="x_panel">
                <div class="x_title">
                    <h2>Popular Hashtags</h2>
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
                    <tr ng-repeat="hashtag in dashboard.popularHashtags">
                      <td scope="row"><a href="/hashtag/{{hashtag.id}}">{{hashtag.tag}}</a></td><td>${{hashtag.current_price | number }}</td>
                      <td><cdn-buy-button button-size="xs" hashtag-id="{{hashtag.id}}" tag="{{hashtag.tag}}" price="{{hashtag.current_price}}" event-handler="dashboard.updateTrades()" /></td>
                    </tr>
                  </tbody>
                  </table>
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
                    <tr ng-repeat="league in dashboard.globalLeagues">
                      <td scope="row">{{league.position}}</td><td><a href="/league/{{league.id}}">{{league.name | titlecase}}</a></td>
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
                    <tr ng-repeat="league in dashboard.privateLeagues">
                      <td scope="row">{{league.position}}</td><td><a href="/league/{{league.id}}">{{league.name | titlecase}}</a></td>
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
