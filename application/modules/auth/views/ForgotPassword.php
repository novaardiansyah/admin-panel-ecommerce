<?php $this->load->view('auth/template/Header'); ?>
  <div class="<?= $page; ?>-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b>Panel</a>
      </div>
      <div class="card-body">
        <p class="<?= $page; ?>-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="recover-password.html" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-primary btn-block">Request new password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="<?= base_url('auth/login'); ?>">Login</a>
        </p>
      </div>
      <!-- /.forgot-password-card-body -->
    </div>
  </div>
  <!-- /.forgot-password-box -->
<?php $this->load->view('auth/template/Footer'); ?>