<?= (isset($page_content_title)) ? $page_content_title : '' ?>

<div id="ummuPageContent">
    <div class="card mb-3 rounded-0 rounded-bottom">
        <div class="card-body pt-2">
            <?php
                if (is_file(ROOTPATH . 'vendor/dorbitt/lib/src/Views/' . $dir_views . 'filters.php')) {
                    echo $this->include(config('Ummu')->Views($dir_views . 'filters'));
                }
                            
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
    <?= $this->include('partials/modal') ?>

    <div class="modal fade" id="modalForm_updateStatus" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal" id="modal_dialog">
            <div class="modal-content bg-light">
                <div class="modal-header bg-primary py-2 text-light">
                    <h6 class="modal-title"><i class="fal fa-file-contract"></i> Update Status IJO</h6>
                    <div class="">
                        <button type="button" class="btn btn-sm btn-outline-light ummu-close-modal" data-bs-dismiss="modal" for="modalForm_updateStatus">
                            <i class="fa-light fa-rectangle-xmark"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <!-- <div class="alert text-light collapse" id="alert_waypoint_modal"></div> -->
                    <div class="col-lg-12 col-sm-12 text-sm">
                        <div class="form-group">
                            <label for="ijo_status" class="text-info">ID</label>
                            <input type="text" name="id" id="id" class="form-control form-control-sm" readonly disabled>
                        </div>

                        <div class="form-group">
                            <label for="ijo_status" class="text-info">Nomor IJO</label>
                            <input type="text" name="nomor_ijo" id="nomor_ijo" class="form-control form-control-sm" readonly disabled>
                        </div>

                        <div class="form-group">
                            <label for="ijo_status" class="text-info">IJO Status</label>
                            <select id="ijo_status" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                                <option value="" selected disabled>Pilih Status...</option>
                                <option value="3">Progress</option>
                                <option value="5">Close</option>
                                <!-- <option value="1">Relese</option> -->
                                <!-- <option value="6">Pending</option> -->
                                <!-- <option value="2">Approve</option> -->
                                <!-- <option value="4">Reject</option> -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="modal_btnUpdate_status">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>