<?php $this->load->view('auth/template/Header'); ?>

<?php
$hasSession = false;
if ($params['name'] !== '' && $params['username'] !== '') {
  $hasSession = true;
}
?>

<!-- Automatic element centering -->
<div class="<?= $page; ?>-wrapper">
  <div class="<?= $page; ?>-logo">
    <a href="#" class="h1"><b>Admin</b>Panel</a>
  </div>

  <?php if ($hasSession) : ?>
    <!-- User name -->
    <div class="<?= $page; ?>-name"><?= textCapitalize(decode($params['name'])); ?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="<?= $page; ?>-item">
      <!-- lockscreen image -->
      <div class="<?= $page; ?>-image">
        <img src="<?= adminlte_url('dist/img/user1-128x128.jpg'); ?>" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form class="<?= $page; ?>-credentials" action="<?= base_url('auth/on-lockScreen'); ?>" method="post" id="lockscreen-form">
        <div class="input-group">
          <input type="password" id="ls-password" name="password" class="form-control autohide-invalid" placeholder="password" />

          <div class="input-group-append">
            <button type="button" class="btn" onclick="return onLockScreen(event);">
              <i class="fas fa-arrow-right text-muted"></i>
            </button>
          </div>

          <div class="invalid-feedback password">Something went wrong.</div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
      Enter your password to retrieve your session
    </div>

    <div class="text-center">
      <a href="<?= base_url('auth/login'); ?>">Or sign in as a different user</a>
    </div>

  <?php else : ?>
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning">403</h2>

        <div class="error-content">
          <h3 class="mb-3">
            <i class="fas fa-exclamation-triangle text-warning"></i>
            Oops! Something unexpected happened.
          </h3>

          <p>
            We apologize, but your session has expired, and thus you cannot access this page. With all due respect we apologize for the inconvenience.
          </p>

          <p>
            The system will direct you to the inside login page <span id="countdown">5</span> seconds. If you do not want to wait, please click <a href="<?= base_url('auth/login'); ?>">here</a>.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
  <?php endif; ?>

  <div class="<?= $page; ?>-footer text-center">
    Copyright &copy; 2022-<?= getTimes('now', 'Y'); ?> <a href="https://github.com/novaardiansyah/">Nova Ardiansyah</a>. All rights reserved.
  </div>
</div>
<!-- /.center -->

<script>
  const hasSession = <?= $hasSession ? 'true' : 'false'; ?>;
</script>

<?php $this->load->view('auth/template/Footer'); ?>
