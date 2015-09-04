@extends('shared.sidebar')

@section('content')
<div ng-controller="listController" ng-init="list.init()" ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h2>Find Hashtags</h2>
    </div>
    <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <form ng-submit="search.searchHashtags()" >
        <div class="input-group" ng-class="{bad: search.invalidSearch}">
            <input type="text" class="form-control" ng-model="search.inputs.hashtag" placeholder="Search for hashtags">
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

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" ng-hide="search.control.isLoading">
                <div class="x_title">
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
                    <tr ng-repeat="hashtag in list.hashtags">
                      <td scope="row"><a href="/hashtag/{{hashtag.id}}">{{hashtag.tag}}</a></td><td>{{hashtag.current_price | currency}}</td>
                      <td><cdn-buy-button button-size="xs" hashtag-id="{{hashtag.id}}" tag="{{hashtag.tag}}" price="{{hashtag.current_price}}" event-handler="" /></td>
                    </tr>
                  </tbody>
                  </table>
                  <paging
                    page="list.paging.currentPage" 
                    page-size="list.paging.pageLength" 
                    total="list.paging.total"
                    paging-action="list.listHashtags('hashtag', page)">
                  </div> 
                </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop