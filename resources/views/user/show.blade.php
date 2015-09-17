@extends('shared.full')

@section('content')
<div ng-controller="userShowController" ng-init="userShow.init('[[$id]]')" >

  <section class="section_light" ng-show="userShow.control.isLoading" >
    <img src='/cdn/ajax-loader.gif' />
  </section>

    <div ng-hide="userShow.control.isLoading">
      <section class="section_light">
          <div class="row">
            <div class="two columns text-center">
              <div class="profile-photo media-round">
                  <cdn-image
                         cdn-src="user/{{userShow.user.id}}"
                         cdn-file="{{userShow.user.profile_image}}" />
              </div>
            </div>
            <div class="ten columns">
              <h2>Hey, its {{userShow.user.firstname | titlecase}} {{userShow.user.surname | titlecase}} here.</h2>
              <div>Joined {{ userShow.user.created_at | date:'yyyy-MM-dd'}}<div>
            </div>
         </div>

        </section>

  </div>
</div>
@stop
