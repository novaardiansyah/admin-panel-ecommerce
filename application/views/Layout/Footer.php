    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      Copyright &copy; 2022-<?= getTimes('now', 'Y'); ?> <a href="https://github.com/novaardiansyah/">Nova Ardiansyah</a>.
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <?= env('APP_VERSION'); ?>
      </div>
    </footer>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= adminlte_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= adminlte_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= adminlte_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= adminlte_url('dist/js/adminlte.js'); ?>"></script>
  </body>
</html>