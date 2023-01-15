<script src="<?= adminlte_url('plugins/moment/moment-with-locales.min.js') ?>"></script>

<script>
  const config = {
    'base_url': '<?= base_url() ?>',
    'adminlte_url': '<?= adminlte_url() ?>'
  }
</script>

<script src="<?= base_url('assets/js/core/Main.js' . versionAssets()) ?>"></script>

<?php if (isset($script)) : ?>
  <?php foreach ($script as $path) : ?>
    <script src="<?= $path ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>