<form ng-controller="loginController" ng-submit="login.submit()" class="form-horizontal form-label-left">
    <div class="item form-group" ng-class="{bad: !login.validation.email.isValid}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="email" ng-model="login.inputs.email" type="text" class="form-control col-md-7 col-xs-12" />
        </div>
        <div class="alert" ng-hide="login.validation.email.isValid">{{login.validation.email.message}}</div> 
    </div>

    <div class="item form-group" ng-class="{bad: !login.validation.password.isValid}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password" ng-model="login.inputs.password" type="password" class="form-control col-md-7 col-xs-12" />
        </div>
        <div class="alert" ng-hide="login.validation.password.isValid">{{login.validation.password.message}}</div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>