<?php if (isset($style)) : ?>
  <?php foreach ($style as $path) : ?>
    <link rel="stylesheet" href="<?= $path ?>" />
  <?php endforeach; ?>
<?php endif; ?>