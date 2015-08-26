@extends('shared.sidebar')

@section('content')
<div ng-cloak>
  <div class="page-title">
    <div class="title_left">
        <h3>Leagues</h3>
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
                <a href="leagues/create">Create New League</a>
              </div>
            </div>
        </div>

      </div>
  </div>
</div>
@stop