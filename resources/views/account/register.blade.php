@extends('shared.full')

@section('content')
      <div class="page-title">
          <div class="title_left">
              <h3>Register</h3>
          </div>
      </div>

      <div class="row" ng-controller="registerController">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_content">

            <form ng-submit="register.submit()" class="form-horizontal form-label-left">

              <div class="item form-group" ng-class="{bad: !register.validation.firstname.isValid}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firstname <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="firstname" ng-model="register.inputs.firstname" type="text" class="form-control col-md-7 col-xs-12" /> 
                  </div>
                  <div class="alert" ng-hide="register.validation.firstname.isValid">{{register.validation.firstname.message}}</div>
              </div>

              <div class="item form-group" ng-class="{bad: !register.validation.surname.isValid}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Surname <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="surname" ng-model="register.inputs.surname" type="text" class="form-control col-md-7 col-xs-12" /> 
                  </div>
                  <div class="alert" ng-hide="register.validation.surname.isValid">{{register.validation.surname.message}}</div>
              </div>


              <div class="item form-group" ng-class="{bad: !register.validation.email.isValid}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="email" ng-model="register.inputs.email" type="text" class="form-control col-md-7 col-xs-12" />
                  </div>
                  <div class="alert" ng-hide="register.validation.email.isValid">{{register.validation.email.message}}</div> 
              </div>

              <div class="item form-group" ng-class="{bad: !register.validation.password.isValid}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" ng-model="register.inputs.password" type="password" class="form-control col-md-7 col-xs-12" />
                  </div>
                  <div class="alert" ng-hide="register.validation.password.isValid">{{register.validation.password.message}}</div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-success">Submit</button>
                  </div>
              </div>
            </form>
        </div>
        </div>
      </div>
      </div>
@stop