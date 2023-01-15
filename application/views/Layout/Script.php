<?php $this->load->library('user_agent'); ?>

<script src="<?= adminlte_url('plugins/moment/moment-with-locales.min.js') ?>"></script>

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