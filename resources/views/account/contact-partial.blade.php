<form ng-controller="contactController" ng-submit="contact.submit()" class="form-horizontal form-label-left">
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Subject <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="email" ng-model="contact.inputs.subject" type="text" class="form-control col-md-7 col-xs-12" />
        </div>
        <div class="alert" ng-hide="true">Please enter</div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Message <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="email" ng-model="contact.inputs.message" type="text" class="form-control col-md-7 col-xs-12"></textarea>
        </div>
        <div class="alert" ng-hide="true">Please enter</div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" ng-disabled="buy.control.isLoading" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>
