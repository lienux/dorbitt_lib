<div id="ummuPageContent">
    <nav class="ummu-nav">
        <div class="nav nav-tabs" id="ummu_nav_tab">
            <button class="nav-link btn-nav-link-form mr-1 active" id="nav-tab-form" data-toggle="tab" data-target="#nav-form" type="button"
                role="tab" aria-selected="true">
                <span class="d-none d-sm-block"><i class="far fa-clipboard-list"></i> Form</span>
                <span class="d-block d-sm-none"><i class="far fa-clipboard-list"></i></span>
            </button>
            <button class="nav-link btn-nav-link-table mr-1" id="nav-tab-listData" data-toggle="tab" data-target="#nav-listData" type="button" role="tab"
                aria-selected="false">
                <span class="d-none d-sm-block"><i class="far fa-list-alt"></i> List Data</span>
                <span class="d-block d-sm-none"><i class="far fa-list-alt"></i></span>
            </button>
        </div>
    </nav>
    <div class="section-body">
        <div class="tab-content" id="ummu_tab_content">
            <div class="tab-pane fade show active" id="nav-form" role="tabpanel">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <?= $this->include(config('Ummu')->Views($dir_views . 'form')) ?>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <ul class="list-group text-muted small">
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-calendar-plus"></i> Created at : <span class="badge badge-info" id="created_at"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-calendar-check"></i> Updated at : <span class="badge badge-info" id="updated_at"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-user-plus"></i> Created by : <span class="badge badge-info" id="created_by"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-user-edit"></i> Updated by : <span class="badge badge-info" id="updated_by"></span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-6 col-sm-12"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="nav-listData" role="tabpanel">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <?php
                            if (is_file(VENDORPATH . 'dorbitt/lib/src/Views/' . $dir_views . 'table.php')) {
                                echo $this->include(config('Ummu')->Views($dir_views . 'table'));
                            }else{
                                echo $this->include(config('Ummu')->Views('partials/table'));
                            }
                        ?>
                        <div class="pt-2" id="dtNote">
                            <div class="alert alert-warning collapse" role="alert" id="info_localStorage_true">
                                Anda mengaktifkan penyimpanan data sementara pada localStorage, untuk mendapatkan data terbaru silahkan klik button <span class='font-weight-bold text-danger'>Get Data</span> di atas
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('partials/modal') ?>
</div>