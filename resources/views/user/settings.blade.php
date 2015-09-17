@extends('shared.full')

@section('content')
  <div class="page-title">
    <div class="title_left">
        <h2>Settings</h2>
    </div>


  </div>
  <div ng-controller="settingsController" ng-init="settings.init()" ng-cloak>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                    <h2>Update Name</h2>
                    <div class="clearfix"></div>
                </div>
              <div class="x_content">

                <form ng-submit="settings.changeName()" class="form-horizontal form-label-left">

                  <div class="item form-group" ng-class="{bad: !settings.nameValidation.firstname.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firstname <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="firstname" ng-model="settings.nameInputs.firstname" type="text" class="form-control col-md-7 col-xs-12" />
                      </div>
                      <div class="alert" ng-hide="settings.nameValidation.firstname.isValid">{{settings.nameValidation.firstname.message}}</div>
                  </div>

                  <div class="item form-group" ng-class="{bad: !settings.nameValidation.surname.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Surname <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="surname" ng-model="settings.nameInputs.surname" type="text" class="form-control col-md-7 col-xs-12" />
                      </div>
                      <div class="alert" ng-hide="settings.nameValidation.surname.isValid">{{settings.nameValidation.surname.message}}</div>
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

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                    <h2>Change Password</h2>
                    <div class="clearfix"></div>
                </div>
              <div class="x_content">

                <form ng-submit="settings.changePassword()" class="form-horizontal form-label-left">
                  <div class="item form-group" ng-class="{bad: !settings.passwordValidation.currentPassword.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="password" ng-model="settings.passwordInputs.currentPassword" type="password" class="form-control col-md-7 col-xs-12" />
                      </div>
                      <div class="alert" ng-hide="settings.passwordValidation.currentPassword.isValid">{{settings.passwordValidation.currentPassword.message}}</div>
                  </div>

                  <div class="item form-group" ng-class="{bad: !settings.passwordValidation.newPassword.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="password" ng-model="settings.passwordInputs.newPassword" type="password" class="form-control col-md-7 col-xs-12" />
                      </div>
                      <div class="alert" ng-hide="settings.passwordValidation.newPassword.isValid">{{settings.passwordValidation.newPassword.message}}</div>
                  </div>

                  <div class="item form-group" ng-class="{bad: !settings.passwordValidation.confirmPassword.isValid}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirm Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" ng-model="settings.passwordInputs.confirmPassword" type="password" class="form-control col-md-7 col-xs-12" />
                      </div>
                      <div class="alert" ng-hide="settings.passwordValidation.confirmPassword.isValid">{{settings.passwordValidation.confirmPassword.message}}</div>
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
  </div>
@stop
