@extends('shared.full')

@section('content')
      <div class="page-title">
          <div class="title_left">
              <h3>Login</h3>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              @include('account.login-partial')
          </div>
        </div>
      </div>
      </div>
@stop