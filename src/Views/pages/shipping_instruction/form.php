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
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" readonly disabled>
                            <span class="popup-text">ex: Tanggal SI</span>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Number<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="number" id="number" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Nomor SI</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Shipper<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="shipper" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_barge" type="button" disabled
                                    data-inputid="shipper" data-modaltitle="Master Data Clients">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Tugboat<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="tugboat" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_barge" type="button" disabled
                                    data-inputid="tugboat" data-modaltitle="Master Data Vessel - Tugboat">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Barge<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="barge" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_barge" type="button" disabled
                                    data-inputid="barge" data-modaltitle="Master Data Vessel - Barge">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Load Type<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="load_type" id="load_type" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Batubara / Pasir / etc.</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Quantity<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="qty" id="qty" class="form-control form-control-sm endis" required disabled>
                    </div>
                    <label class="col-sm-3 col-form-label text-right">UoM<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="uom" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_uom" type="button" disabled
                                    data-inputid="uom" data-modaltitle="Master Data - Unit of Measure">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Date of Loading From<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingFrom" readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="iDateLoadingFrom" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Date of Loading To</label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="iDateLoadingTo" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Port of Loading<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Port of Discharge<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Jettu Pelindo, Bojonegara, Jawa Barat</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">File<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <!-- <input type="file" class="form-control endis" id="file_upload" disabled> -->
                            <div class="custom-file custom-file-sm">
                                <input type="file" class="custom-file-input endis" id="file_upload" name="file_upload" required disabled>
                                <label class="custom-file-label" for="file_upload">Choose file...</label>
                            </div>
                        </div>
                        <div>
                            <a href="#" id="file_url" target="_blank">
                                <span>Click here to open File.</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
