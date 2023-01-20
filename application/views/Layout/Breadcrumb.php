<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title; ?></h1>
      </div><!-- /.col -->
      <?php if (isset($breadcrumb)) :  ?>
        <?php $breadcrumb = $breadcrumb ? arrayToObject($breadcrumb) : '{}'; ?>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <?php foreach ($breadcrumb as $key => $row) : ?>
              <li class="breadcrumb-item <?= $row == '' ? 'active' : ''; ?>">
                <?php if ($row !== '') : ?>
                  <a href="<?= $row; ?>"><?= $key; ?></a>
                <?php else : ?>
                  <?= $key; ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ol>
        </div><!-- /.col -->
      <?php endif; ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->