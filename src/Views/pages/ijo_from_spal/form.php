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
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Status <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9" id="status"></div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">SPAL<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="spal" placeholder="Choose..." data-label="Surat Perjanjian (SPAL)" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_spal" type="button" disabled
                                    data-inputid="spal" data-modaltitle="List Surat Perjanjian / Contract">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Tgl Ijo<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" placeholder="Choose..." id="iDate" data-label="Tanggal IJO" readonly disabled required>
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
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Nomor IJO<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="number" id="number" class="form-control form-control-sm endis" data-label="Nomor IJO" required disabled>
                        <span class="popup-text">ex: 040/IJO/WGM/0226</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">From Dept <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" name="from_dept" id="from_dept" class="form-control form-control-sm" data-label="Job From" required disabled >
                        <span class="popup-text">ex: Marketing</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">To Dept<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <!-- <input type="text" name="to_dept" id="to_dept" class="form-control form-control-sm endis" data-label="Job To" required disabled placeholder="Operation Department"> -->

                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm" placeholder="Choose..." id="to_dept" data-label="To Department" disabled required>
                            <span class="popup-text">ex: Operation</span>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_dept" type="button" disabled
                                    data-inputid="to_dept" data-modaltitle="Master Department">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0">Port of Loading <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm" required disabled data-label="Port of Loading">
                        <!-- <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span> -->
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0">Port of Discharge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm" required disabled data-label="Port of Discharge">
                        <!-- <span class="popup-text">ex: Jettu Pelindo, Bojonegara, Jawa Barat</span> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Client <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="client" data-label="Client" disabled required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Tugboat <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="tugboat" id="tugboat" class="form-control form-control-sm" data-label="Tugboat" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Barge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="barge" id="barge" class="form-control form-control-sm" data-label="Barge" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Ukuran Barge (LOA) <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" name="ukuran_barge" id="ukuran_barge" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" required disabled placeholder="" title="Ukuran Barge (LOA)" data-label="Ukurang Barge">
                            <div class="input-group-append">
                                <span class="input-group-text">Meter</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Tonnage <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <!-- <input type="text" name="tonnage" id="tonnage" class="form-control form-control-sm" data-label="Tonage" required disabled> -->
                        <div class="input-group input-group-sm">
                            <input type="text" name="tonnage" id="tonnage" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" required disabled placeholder="" title="Tonage" data-label="Tonage">
                            <div class="input-group-append">
                                <span class="input-group-text" id="uom"></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" id="uom" disabled>
                    </div> -->
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">ETA Loading Port <sup class="text-info">auto</sup></label>
                    <div class="col-sm-8">
                        <input type="text" name="eta_loading_port" id="eta_loading_port" class="form-control form-control-sm" data-label="ETA Loading Port" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">ETA Discharge Port</label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" placeholder="Choose..." id="eta_discharge_port" data-label="ETA Discharge Port" readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="eta_discharge_port" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <label class="col-sm-4 col-form-label">SI Number</label>
                    <div class="col-sm-8">
                        <input type="text" name="si_number" id="si_number" class="form-control form-control-sm" data-label="SI Number" disabled>
                    </div>
                </div>
                 <div class="row">
                    <label class="col-sm-4 col-form-label">SI File</label>
                    <div class="col-sm-8">
                        <div>
                            <a id="si_url" target="_blank">
                                <span>Click here to open SI File.</span>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- <div class="card mt-3">
    <div class="card-header">
        Tugboat/Barge Nomination (Default auto from contract)
    </div>
    <div class="card-body">
        <div class="mb-2">
            <button type="button" class="btn btn-sm btn-outline-primary show-left-modal" id="new_item" data-tableid="tbIjoDetail" data-modaltitle="List Shipping Instruction (SI)">New item from other SI</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="tbIjoDetail"
                width="100%" cellspacing="0">
                <thead class="bg-success text-light">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Tugboat</th>
                        <th>Barge</th>
                        <th>Barge Capacity</th>
                        <th>Tonnage</th>
                        <th>ETA Loading Port</th>
                        <th>ETA Discharging Port</th>
                        <th>ETD/Cost Off Discharging Port</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div> -->
