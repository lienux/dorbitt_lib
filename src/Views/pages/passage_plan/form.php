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
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" placeholder="Pilih tanggal berlayar" disabled data-toggle="tooltip" data-placement="top" title="Pilih tanggal berlayar">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">IJO<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="ijo" data-label="Internal Job Order (IJO)" placeholder="Pilih daftar IJO" disabled required data-toggle="tooltip" data-placement="top" title="Daftar IJO yang ditampilkan adalah Dokumen yang statusnya sudah Release dan On Progress.">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_ijo" type="button" disabled
                                    data-inputid="ijo" data-modaltitle="List IJO">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Tugboat<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="tugboat" data-label="Tugboat" disabled data-toggle="tooltip" data-placement="top" title="Tugboat terisi otomatis saat setelah memilih Daftar SI, hasil dari inputan Form SI oleh marketing.">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Conditions<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3 mb-2">
                        <select id="sailing_conditions" class="form-control form-control-sm endis" disabled data-toggle="tooltip" data-placement="top" title="Silahkan pilih kondisi berlayar">
                            <option value="" selected disabled>Choose...</option>
                            <option value="1">Laden</option>
                            <option value="2">Ballast</option>
                        </select>
                    </div>

                    <label class="col-sm-3 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Speed<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-3 mb-2">
                        <div class="input-group input-group-sm">
                            <input type="text" name="kecepatan" id="kecepatan" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" required disabled placeholder="" title="Kecepatan Pelayaran (Avg.) otomatis terisi setelah pilih Conditions, nilai ini diambil dari master vessel.">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Knots</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Loading<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" required disabled placeholder="" title="Pelabuhan berangkat">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Discharge<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" required disabled placeholder="" title="Pelabuhan tujuan">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Captain<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="captain" id="captain" class="form-control form-control-sm" required disabled placeholder="" data-toggle="tooltip" data-placement="top" title="Captain otomatis setelah pilih IJO, hasil dari Setting Crew Assignment terhadap IJO.">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Chief Engineer<sup class="text-info"> auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="chief_engineer" id="chief_engineer" class="form-control form-control-sm" required disabled placeholder="" data-toggle="tooltip" data-placement="top" title="Chief Engineer / Kepala Kamar Mesin (KKM) otomatis setelah pilih IJO, hasil dari Setting Crew Assignment terhadap IJO.">
                    </div>
                </div>
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
    <div class="modal-dialog modal-dialog-scrollable modal-xl" id="modal_dialog">
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
                <div class="col-lg-12 col-sm-12 text-sm">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="waypoint_name" class="text-info mb-0">
                                Nama Waypoint<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="waypoint_name"
                                name="waypoint_name">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="lintang" class="text-info mb-0">
                                Lintang (Lat)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="lintang" name="lintang" placeholder="Deg (°)">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="lintang_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="lintang_menit" name="lintang_menit" placeholder="Menit (')">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="lintang_s" class="text-info mb-0"></label>
                            <select id="lintang_s" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                                <option value="S" selected>S</option>
                                <option value="N">N</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="bujur" class="text-info mb-0">
                                Bujur (Lon)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="bujur" name="bujur" placeholder="Deg (°)">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="bujur_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="bujur_menit" name="bujur_menit" placeholder="Menit (')">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="bujur_e" class="text-info mb-0"></label>
                            <select id="bujur_e" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
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
