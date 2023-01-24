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

    <?php $this->load->view('Layout/Script'); ?>
  </body>
</html>