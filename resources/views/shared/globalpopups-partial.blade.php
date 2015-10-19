



    <div class="modal fade" id="contact-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Contact</h4>
                </div>
                <div class="modal-body">
                    @include('account.contact-partial')
                </div>
            </div>
        </div>
    </div>


@if (Auth::check())
    <!-- buy modal -->
    <div class="modal fade" id="buy-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                      <button class="close" data-dismiss="modal" type="button">&times;</button>
                      <h4 class="modal-title" id="avatar-modal-label">Buy Shares</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                            @include('profile.trade-partial')
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <!-- /.modal -->
@else
  <!-- login -->
  <div class="modal fade" ng-controller="buyController" ng-init="buy.init()" id="login-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <div class="modal-header">
                 <button class="close" data-dismiss="modal" type="button">&times;</button>
                 <h4 class="modal-title" id="avatar-modal-label">Login</h4>
             </div>
             <div class="modal-body">
                 @include('account.login-partial')
             </div>
         </div>
     </div>
  </div>
@endif
