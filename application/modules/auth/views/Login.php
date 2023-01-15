<?php $this->load->view('auth/template/Header'); ?>
  <div class="<?= $page; ?>-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b>Panel</a>
      </div>
      <div class="card-body">
        <p class="<?= $page; ?>-box-msg">Sign in to start your session</p>

        <form action="" method="post" enctype="multipart/form-data" id="U9Q-Login-Form">
          <div class="input-group mb-3">
            <input type="text" class="form-control autohide-invalid" name="username" id="U9Q-username" placeholder="Username" />
            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-fw fa-user"></span>
              </div>
            </div>

            <div class="invalid-feedback username">Something went wrong.</div>
          </div>
          <!-- /.input-group -->

          <div class="input-group mb-3">
            <input type="password" class="form-control autohide-invalid" name="password" id="U9Q-password" placeholder="Password" />

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-fw fa-lock"></span>
              </div>
            </div>

            <div class="invalid-feedback password">Something went wrong.</div>
          </div>
          <!-- /.input-group -->

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="button" class="btn btn-primary btn-block" onclick="return onLogin(event)">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3 d-none">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i> Sign in using Google
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="<?= base_url('auth/forgot_password') ?>">I forgot my password</a>
        </p>
        <p class="mb-0 d-none">
          <a href="<?= base_url('auth/register'); ?>" class="text-center">Register a new account</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
<?php $this->load->view('auth/template/Footer'); ?>