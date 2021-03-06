      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./demo/brand/tabler.svg" class="h-6" alt="">
              </div>
              <form class="card" action="./login" method="post">

                <?php if ($flash): ?>
                
                <div class="alert alert-danger" role="alert">
                    <?= ($flash)."
" ?>
                </div>
                
                <?php endif; ?>

                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="password">
                      Password
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                    </label>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Don't have account yet? <a href="./signup">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
