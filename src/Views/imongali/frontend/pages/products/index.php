<?= $this->extend(config('Ummu')->Views($appType.'/frontend/layout/index')) ?>

<?= $this->section('content') ?>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Product Name
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>SparkCode 4.4.0</a>
                            <!-- <br/>
                            <small>Created 01.01.2019</small> -->
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>Omdoo ERP</a>
                            <!-- <br/>
                            <small>Created 01.01.2019</small> -->
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>Open API 2</a>
                            <!-- <br/>
                            <small>Created 01.01.2019</small> -->
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>js/pages/dashboard/index.js"></script> -->
<?= $this->endSection() ?>