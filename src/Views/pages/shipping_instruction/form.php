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
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" data-label="Tanggal SI" placeholder="Pilih tanggal SI" readonly disabled required>
                            <span class="popup-text">ex: Tanggal SI</span>
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
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Number<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="number" id="number" class="form-control form-control-sm endis" placeholder="Masukan Nomor SI" data-label="Number" required disabled required>
                        <span class="popup-text">ex: Nomor SI</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Shipper<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="client" placeholder="Pilih Shipper / Client" data-label="Shipper" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_client" type="button" disabled
                                    data-inputid="client" data-modaltitle="Master Data Clients">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Tugboat<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="tugboat" placeholder="Pilih Tugboat" data-label="Tugboat" required disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_tugboat" type="button" disabled
                                    data-inputid="tugboat" data-modaltitle="Master Data Vessel - Tugboat">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Barge<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="barge" placeholder="Pilih Barge" data-label="Barge" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_barge" type="button" disabled
                                    data-inputid="barge" data-modaltitle="Master Data Vessel - Barge">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Load Type<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="load_type" id="load_type" class="form-control form-control-sm endis" placeholder="Enter Load Type" data-label="Load Type" required disabled>
                        <span class="popup-text">ex: Batubara / Pasir / etc.</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label mb-0 pb-0">Quantity<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3 mb-2">
                        <input type="text" name="qty" id="qty" class="form-control form-control-sm endis" placeholder="Masukan Jumlah Muatan" data-label="Quantity" required disabled>
                    </div>

                    <label class="col-sm-3 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                        UoM<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-3 mb-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="uom" placeholder="Pilih Satuan" data-label="UoM" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_uom" type="button" disabled
                                    data-inputid="uom" data-modaltitle="Master Data - Unit of Measure">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- <input type="text" id="rangePicker" placeholder="Pilih rentang tanggal.."> -->

                <!-- <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading From<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingFrom" placeholder="Pilih Batas Awal Tanggal Muat" data-label="Date of Loading From" readonly disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDateLoadingFrom" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading To</label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Pilih Batas Akhir Muat" data-label="Date of Loading To" required readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDateLoadingTo" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingFrom" placeholder="Pilih Tanggal Muat" data-label="Date of Loading From" readonly disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDateLoadingFrom" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Sampai tanggal." data-label="Date of Loading To" required readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDateLoadingTo" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Pilih Batas Akhir Muat" data-label="Date of Loading To" required readonly disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDateLoadingTo" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Loading<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm endis" placeholder="Masukan Nama Pelabuhan Muat" data-label="Port of Loading" required disabled>
                        <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Discharge<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm endis" placeholder="Masukan Nama Pelabuhan Bongkar" data-label= "Port of Discharge" required disabled>
                        <span class="popup-text">ex: Jettu Pelindo, Bojonegara, Jawa Barat</span>
                    </div>
                </div> -->
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                        Voyage Route<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-8">
                        <!-- <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm endis" placeholder="Pilih list voyage route" data-label="Port of Loading" required disabled>
                        <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span> -->
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="voyage_route" placeholder="Pilih voyage route" data-label="Voyage Route" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_voyage_route" type="button" disabled
                                    data-inputid="voyage_route" data-modaltitle="Master Data Voyage Route">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                        Port of Loading
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm" placeholder="Auto setelah pilih Voyage Route..." disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                        Port of Discharge
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm" placeholder="Auto setelah pilih Voyage Route..." disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">File<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <!-- <input type="file" class="form-control endis" id="file_upload" disabled> -->
                            <div class="custom-file custom-file-sm">
                                <input type="file" class="custom-file-input endis" id="file_upload" name="file_upload" data-label="File" disabled>
                                <label class="custom-file-label" for="file_upload">Choose file...</label>
                            </div>
                        </div>
                        <div>
                            <a id="file_url" target="_blank">
                                <span>Click here to open File.</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
