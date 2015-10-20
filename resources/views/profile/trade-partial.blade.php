<div ng-controller="buyController" ng-init="buy.init()" ng-class="{loadingsection: buy.control.isLoading}">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{buy.hashtag.tag}}</h3>
    </div>
</div>

<form class="form-horizontal form-label-left" ng-submit="buy.buy()">
<div class="form-group item" ng-class="{bad: !buy.validation.portfolio.isValid}">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Portfolio <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select ng-model="buy.hashtag.portfolio" class="form-control">
                    <option
                            ng-repeat="portfolio in buy.userPortfolios"
                            value="{{portfolio.id}}">
                        {{portfolio.name}}
                    </option>
                </select>
            </div>
            <div class="alert" ng-hide="buy.validation.portfolio.isValid">{{buy.validation.portfolio.message}}</div>
    </div>
</div>
</div>
<div class="form-group item" ng-class="{bad: !buy.validation.shares_taken.isValid}">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number of Shares <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" max="1000" id="number-shares" ng-model="buy.hashtag.shares_taken" class="form-control">
            </div>
            <div class="alert" ng-hide="buy.validation.shares_taken.isValid">{{buy.validation.shares_taken.message}}</div>
    </div>
</div>
</div>
<div class="form-group">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4>{{layout.consts.siteCurrency}}{{buy.hashtag.price}}</h4>
            </div>

    </div>
</div>
</div>
        <div class="form-group">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4>${{buy.total}}</h4>
            </div>

    </div>
</div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button ng-disabled="buy.control.isLoading" type="submit" class="btn btn-success"><span ng-hide="buy.control.isLoading">Submit</span><img src="/cdn/ajax-loader.gif" ng-show="buy.control.isLoading" /></button>
    </div>
</div>

</form>
</div>
