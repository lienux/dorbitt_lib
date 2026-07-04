<?= $this->extend(config('Ummu')->Views($appType.'/frontend/layout/index')) ?>

<?= $this->section('content') ?>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Workspace</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($projects->status) && $projects->status == true) {
                        foreach ($projects->rows as $key => $value) { ?>
                            <tr>
                                <td>
                                    <small><?=$value->tahun?></small>
                                </td>
                                <td>
                                    <a>
                                        <?=$value->name?>
                                    </a>
                                </td>
                                <td>
                                    <small>
                                        <?=$value->workspace_name?>
                                    </small>
                                </td>
                                <!-- <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?=$value->progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$value->progress?>%">
                                        </div>
                                    </div>
                                    <small>
                                        <?=$value->progress?>% Complete
                                    </small>
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-success">Success</span>
                                </td> -->
                                <td>
                                    <small>
                                        <?=$value->description?>
                                    </small>
                                </td>
                            </tr>
                        <?php }
                    }?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>js/pages/dashboard/index.js"></script> -->
<?= $this->endSection() ?>