<?php $this->load->view('Layout/Header'); ?>
<div class="wrapper">
  <?php $this->load->view('Layout/Navbar'); ?>
  <?php $this->load->view('Layout/Sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view('Layout/Breadcrumb'); ?>
    <!-- Main content -->
    <section class="content">
      <?php $this->load->view($content); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('Layout/Footer'); ?>