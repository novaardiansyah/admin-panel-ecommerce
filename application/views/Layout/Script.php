<?php $this->load->library('user_agent'); ?>

<!-- jQuery -->
<script src="<?= adminlte_url('plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap -->
<script src="<?= adminlte_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= adminlte_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= adminlte_url('dist/js/adminlte.js'); ?>"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Moment -->
<script src="<?= adminlte_url('plugins/moment/moment-with-locales.min.js') ?>"></script>
<!-- Datatables & Plugins -->
<script src="<?= adminlte_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

<script>
  const config = {
    'base_url': '<?= base_url() ?>',
    'adminlte_url': '<?= adminlte_url() ?>'
  }

  const userAgent = {
    'user_agent': '<?= $this->agent->agent_string(); ?>',
    'ip_address': '<?= $this->input->ip_address(); ?>',
    'browser': '<?= $this->agent->browser(); ?>',
    'browser_version': '<?= $this->agent->version(); ?>',
    'platform': '<?= $this->agent->platform(); ?>',
    'mobile': '<?= $this->agent->mobile(); ?>',
    'robot': '<?= $this->agent->robot(); ?>',
    'referrer': '<?= $this->agent->referrer(); ?>'
  }
</script>

<script src="<?= base_url('assets/js/core/Main.js' . versionAssets()) ?>"></script>

<?php if (isset($script)) : ?>
  <?php foreach ($script as $path) : ?>
    <script src="<?= $path ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>