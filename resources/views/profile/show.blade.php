@extends('shared.full')

@section('content')
<div ng-controller="profileShowController" ng-init="profileShow.init('[[$id]]')" ng-cloak>
  <div>
      @include('account.account-header-partial')
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Profile Detail</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <h3 ng-show="profileShow.profile">{{profileShow.profile.name}}</h3>
                    <h4 ng-show="profileShow.profile">Current price: {{layout.consts.siteCurrency}}{{profileShow.profile.current_price | number }}</h4>
                    <cdn-buy-button button-size="s" profile-id="{{profileShow.profile.id}}" tag="{{profileShow.profile.name}}" price="{{profileShow.profile.current_price}}" event-handler="" ng-hide="profileShow.control.isLoading" />
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div class="profile_title">
                      <div class="col-md-12">
                          <h2>Recent Price History</h2>
                      </div>
                  </div>
                  <price-graph profile-id="[[$id]]" />
                </div>
              </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop
