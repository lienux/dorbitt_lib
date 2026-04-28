<div class="mt-2">
    <div class="alert text-light collapse" id="alert_input"></div>
    <div class="collapse" id="loader_input">
        <div class="d-flex justify-content-center mt-2">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- SB Button -->
    <?=$this->include(config('Ummu')->Views('partials/sb_button'))?>

    <!-- Form -->
    <div id="form_input"> 
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0" for="name">
                        Name<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" id="name" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Nama Rute" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0" for="port_of_loading">
                        Port of Loading<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="port_of_loading" data-toggle="tooltip" data-placement="top" title="Pelabuhan Awal" required disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_pelabuhan" type="button" disabled
                                    data-inputid="port_of_loading" data-modaltitle="Master Data Port">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0" for="port_of_discharge">
                        Port of Discharge<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="port_of_discharge" data-toggle="tooltip" data-placement="top" title="Pelabuhan Akhir" required disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_pelabuhan" type="button" disabled
                                    data-inputid="port_of_discharge" data-modaltitle="Master Data Port">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <label class="col-sm-3 col-form-label mb-2 pb-0" for="lintang">
                        Latitude<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control form-control-sm" id="lintang" name="lintang" placeholder="Deg (°)">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control form-control-sm" id="lintang_menit" name="lintang_menit" placeholder="Menit (')">
                    </div>
                    <div class="col-md-2 mb-2">
                        <select id="lintang_s" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                            <option value="S" selected>S</option>
                            <option value="N">N</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label mb-2 pb-0" for="bujur">
                        Longitude<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control form-control-sm" id="bujur" name="bujur" placeholder="Deg (°)">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control form-control-sm" id="bujur_menit" name="bujur_menit" placeholder="Menit (')">
                    </div>
                    <div class="col-md-2 mb-2">
                        <select id="bujur_e" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                            <option value="E" selected>E</option>
                            <option value="W">W</option>
                        </select>
                    </div>
                </div> -->
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="timezone">
                        Time Zone
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="timezone" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Time Zone" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="draft_limit">
                        Draft Limit
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="draft_limit" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Batas Kedalaman" disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label" for="type">Type</label>
                    <div class="col-sm-9">
                        <select id="type" class="form-control form-control-sm endis" data-toggle="tooltip" data-placement="top" title="Tipe Pelabuhan" disabled>
                            <option value="" selected disabled>Choose...</option>
                            <option value="1">Loading</option>
                            <option value="2">Discharge</option>
                            <option value="3">Bunker</option>
                        </select>
                    </div>
                </div> -->
            </div>

            <div class="col-lg-12 mt-3">
                <nav class="ummu-nav">
                    <div class="nav nav-tabs">
                        <button class="nav-link mr-1 py-0 active" id="nav-tab-waypoint" data-toggle="tab" data-target="#nav-waypoint" type="button" role="tab" aria-selected="true">
                            Waypoint
                        </button>
                    </div>
                </nav>
                <div class="section-body">
                    <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                        <div class="card-body pt-2">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-waypoint" role="tabpanel">
                                    <?= $this->include(config('Vh')->ummuView($dir_views . 'table_waypoint')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm_inputWaypoint" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-primary py-2 text-light">
                <h6 class="modal-title"><i class="fal fa-file-contract"></i> Form Input Waypoint</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert text-light collapse" id="alert_waypoint_modal"></div>

                <!-- Lintang -->
                <div class="col-lg-12 col-sm-12 text-sm">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="waypoint_name" class="text-info mb-0">
                                Nama Waypoint<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="waypoint_name"
                                name="waypoint_name">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="lintang" class="text-info mb-0">
                                Lintang (Lat)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="lintang" name="lintang" placeholder="Deg (°)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lintang_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="lintang_menit" name="lintang_menit" placeholder="Menit (')">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="arah_sn" class="text-info mb-0"></label>
                            <select id="arah_sn" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                                <option value="S" selected>S</option>
                                <option value="N">N</option>
                            </select>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="bujur" class="text-info mb-0">
                                Bujur (Lon)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="bujur" name="bujur" placeholder="Deg (°)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bujur_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="bujur_menit" name="bujur_menit" placeholder="Menit (')">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="arah_ew" class="text-info mb-0"></label>
                            <select id="arah_ew" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                                <option value="E" selected>E</option>
                                <option value="W">W</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" id="modal_btnSave_waypoint">
                            <i class="fas fa-plus-circle"></i> 
                            Save Waypoint
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>
