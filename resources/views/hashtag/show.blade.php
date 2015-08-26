@extends('shared.sidebar')

@section('content')
<div ng-controller="hashtagShowController" ng-init="hashtagShow.init('[[$id]]')" ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h3>Hashtag Detail</h3>
    </div>

    

  </div>
  <div>
      
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Hashtag Detail</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <h3 ng-show="hashtagShow.hashtag">#{{hashtagShow.hashtag.tag}}</h3>
                    <h4 ng-show="hashtagShow.hashtag">Current price: {{hashtagShow.hashtag.current_price | currency}}</h4>
                    <cdn-buy-button button-size="s" hashtag-id="{{hashtagShow.hashtag.id}}" tag="{{hashtagShow.hashtag.tag}}" price="{{hashtagShow.hashtag.current_price}}" event-handler="" ng-hide="hashtagShow.control.isLoading" />
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div class="profile_title">
                      <div class="col-md-12">
                          <h2>Recent Price History</h2>
                      </div>
                  </div>
                  <price-graph hashtag-id="[[$id]]" />
                </div>
              </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop