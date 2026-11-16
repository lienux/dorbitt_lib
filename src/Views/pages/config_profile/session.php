<?php
if (isset($tmp)) {
    $temp = $tmp;
} else {
    $temp = 'admin';
}
?>

<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
<style></style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section profile">
    <pre id="json_session" class="json-display"></pre>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $ummu.vars.page_url = $base_url + 'admin/config_profile/';
</script>
<script src="<?= base_url(); ?>js/admin/pages/profile/session.js"></script>
<?= $this->endSection() ?>