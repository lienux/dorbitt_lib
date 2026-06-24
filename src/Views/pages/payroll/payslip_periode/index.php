<?= $this->extend('layout/'. config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
<?= $this->include('plugins/datatables/style') ?>
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/admin/approval.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card col-md-6 col-sm-12 mb-4 shadow p-0">
    <div class="card-body">
        <?= $this->include('pages/payroll/payslip_periode/table') ?>
    </div>
    <div class="card-footer">
        <div id="response_message">...</div>
    </div>
</div>
<?= $this->include('pages/payroll/payslip_periode/form') ?>
<?= $this->include('pages/payroll/payslip_periode/modal') ?>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('plugins/datatables/script') ?>
<script src="<?= base_url() ?>js/admin/payroll/payslip_periode.js"></script>
<script>
    // 
</script>
<?php
if (session()->get('level_id') != 1) { ?>
    <script>
        table.buttons('#btn_new').nodes().css("display", "none");
    </script>
<?php } ?>
<?= $this->endSection() ?>