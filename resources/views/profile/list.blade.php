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
                  <div class="row" ng-show="list.control.isLoading">
                    <div class="col-xs-12 no-record"><img src="/cdn/ajax-loader.gif" /></div>
                  </div>
                  <div class="row">
                    <div ng-repeat="profile in list.profiles" class="col-xs-12 col-md-3">
                        <div class="tile-stats container">
                          <div class="row name-container">
                            <div class="col-xs-8">
                              <div class="count">
                                <a href="/profile/{{profile.id}}">{{profile.name}}</a>
                                <a href="/profile/{{profile.id}}"><span class="handle">{{profile.handle}}</span></a>
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <a href="/profile/{{profile.id}}" class="right">
                                <img src="{{profile.image}}" />
                              </a>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-4">
                              <cdn-buy-button button-size="sm" profile-id="{{profile.id}}" tag="{{profile.name}}" price="{{profile.current_price}}" event-handler="dashboard.updateTrades()" />
                            </div>
                            <div class="col-xs-8">
                                <div class="right">
                                  <h3>{{layout.consts.siteCurrency}}{{profile.current_price | number:2}}</h3>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="right">
                                <span ng-class="{'green': (profile.current_price - profile.historic_price ) >= 0, 'red': (profile.current_price - profile.historic_price ) < 0}">
                                  <h5><i ng-hide="(profile.current_price - profile.historic_price ) >= 0" class="fa fa-caret-down"></i><i ng-hide="(profile.current_price - profile.historic_price ) < 0" class="fa fa-caret-up"></i> {{profile.current_price - profile.historic_price | number:2}} ({{trade.change | percentageDifference:profile.historic_price:profile.current_price  }})</h5></span>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
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
