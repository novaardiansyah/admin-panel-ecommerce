<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?= adminlte_url('plugins/fontawesome-free/css/all.min.css'); ?>" />
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= adminlte_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>" />
<!-- icheck bootstrap -->
<link rel="stylesheet" href="<?= adminlte_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?= adminlte_url('dist/css/adminlte.min.css'); ?>" />
<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Datatables -->
<link rel="stylesheet" href="<?= adminlte_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= adminlte_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= adminlte_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<?php if (isset($style)) : ?>
  <?php foreach ($style as $path) : ?>
    <link rel="stylesheet" href="<?= $path ?>" />
  <?php endforeach; ?>
<?php endif; ?>