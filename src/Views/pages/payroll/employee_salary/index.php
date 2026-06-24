<?= $this->extend('layout/'. config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
<?= $this->include('plugins/datatables/style') ?>
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/admin/approval.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-4 shadow">
    <div class="card-body">
        <!-- <?//= $this->include('partials/filter') ?> -->
        <?= $this->include('pages/payroll/employee_salary/table') ?>
    </div>
    <div class="card-footer">
        <div id="response_message">...</div>
    </div>
</div>
<?= $this->include('pages/payroll/employee_salary/form') ?>
<?= $this->include('pages/payroll/employee_salary/modal') ?>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('plugins/datatables/script') ?>
<script>
    $ummu.vars.page_url = $base_url + 'admin/employee_salary/';
    var globalVar = {
        qUrl: $base_url + 'admin/payroll/employee_salary/',
        errors_params: [],
        id: null
    }
</script>
<script src="<?= base_url("js/admin/payroll/employee_salary.js?time=" . date('YmdHis')) ?>"></script>
<script>
    // 
    new DateTime(document.getElementById('date_from'));
    new DateTime(document.getElementById('date_to'));

    $('#delete_pdf').on('click', function () {
        $('#loader_delete_pdf').removeClass('collapse');

        var url = "<?= base_url('admin/payslip/delete_pdf/') ?>" + globalVar.id;

        var ummu = $ummu.ajax.show0(url);
        ummu.done(function (result) {
            console.log(result)
            var response = result;
            // var response = JSON.parse(result);
            if (response.status == true) {
                $('#loader_delete_pdf').addClass('collapse');
            }
        })
    });
</script>
<?php if (session()->get('level_id') != 1) { ?>
    <script>
        table.buttons('#btn_import').nodes().css("display", "none");
        table.buttons('#btn_delete').nodes().css("display", "none");
    </script>
<?php } ?>
<?= $this->endSection() ?>