<div class="x_panel" ng-controller="sideNavController">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <span>
        <select ng-options="obj.name for obj in sideNav.userPortfolios" ng-model="sideNav.portfolio" class="form-control" ng-change="sideNav.change()">
        </select>
    </span>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <span>
        <h3 class="no-margin" ng-hide="sideNav.portfolio == null">${{sideNav.portfolio.balance | number }}</h3>
    </span>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 form-group top_search">
    <form ng-submit="sideNav.searchHashtags()" >
      <div class="input-group" ng-class="{bad: sideNav.invalidSearch}">
          <input type="text" class="form-control" ng-model="sideNav.searchTerm" placeholder="Search for profiles">
          <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Go!</button>
          </span>
        </div>
      </form>
    </div>
</div>
