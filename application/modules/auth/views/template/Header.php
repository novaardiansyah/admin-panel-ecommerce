<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $pageTitle; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= adminlte_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= adminlte_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= adminlte_url('dist/css/adminlte.min.css'); ?>">
  <?php $this->load->view('Layout/Style'); ?>
</head>

<body class="hold-transition <?= $page; ?>-page">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= adminlte_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTELogo" height="60" width="60" />
  </div>