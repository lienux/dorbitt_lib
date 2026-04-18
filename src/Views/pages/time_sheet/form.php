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
                <div class="row">
                    <label class="col-sm-3 col-form-label">IJO<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="ijo" data-label="Internal Job Order (IJO)" placeholder="Choose..." disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_ijo" type="button" disabled
                                    data-inputid="ijo" data-modaltitle="List IJO">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Client <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="client" data-label="Client" disabled required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Tugboat <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm is-data-id" data-label="Tugboat" id="tugboat" disabled required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Barge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm is-data-id" id="barge" data-label="Barge / Tongkang" disabled required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Start Time<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="start_time" placeholder="" data-label="Tanggal Surat Perjanjian" readonly disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="start_time" id="btn_iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Finish Time<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="finish_time" placeholder="" data-label="Tanggal Surat Perjanjian" readonly disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="finish_time" id="btn_iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <label class="col-sm-3 col-form-label">Tanggal Kontrak<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" placeholder="Pilih Tanggal Kontrak" data-label="Tanggal Surat Perjanjian" readonly disabled required>
                            <span class="popup-text">ex: Tanggal Kontrak dibuat</span>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDate" id="btn_iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Nomor Kontrak<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="number" id="number" class="form-control form-control-sm endis" placeholder="Masukan Nomor Kontrak" data-label="Nomor Surat Perjanjian" required disabled>
                        <span class="popup-text">Number of contract</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Biaya Angkutan<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="biaya_angkutan" id="biaya_angkutan" placeholder="Masukan Biaya Angkutan" class="form-control form-control-sm endis" data-label="Biaya Angkutan" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Perjanjian<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="kondisi_perjanjian" id="kondisi_perjanjian" placeholder="Masukan Kondisi Perjanjian" class="form-control form-control-sm endis" data-label="Kondisi Perjanjian" required disabled>
                        <span class="popup-text">Kondisi Perjanjian, ex: FIOST</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">File</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <div class="custom-file custom-file-sm">
                                <input type="file" class="custom-file-input endis" id="file_upload" name="file_upload" data-text="File Kontrak / Surat Perjanjian" disabled>
                                <label class="custom-file-label" for="file_upload">Choose file...</label>
                            </div>
                        </div>
                        <div>
                            <a href="#" id="file_url" target="_blank">
                                <span>Click here to open File.</span>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Penyewa Kapal <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" id="client" data-label="Penyewa Kapal" disabled required>
                    </div>
                </div> -->
                <!-- <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Tugboat <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm is-data-id" data-label="Tugboat" id="tugboat" disabled required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Barge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm is-data-id" id="barge" data-label="Barge / Tongkang" disabled required>
                    </div>
                </div> -->
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Jenis Muatan <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" name="load_type" id="load_type" class="form-control form-control-sm" required disabled data-label="Jenis Muatan">
                        <span class="popup-text">ex: Batubara / Pasir / etc.</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Volume Muatan <sup class="text-info">auto</sup></label>
                    <div class="col-sm-5">
                        <input type="text" name="qty" id="qty" class="form-control form-control-sm" required disabled data-label="Volume Muatan">
                        <!-- <span class="popup-text">ex: Batubara / Pasir / etc.</span> -->
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" id="uom" disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Date of Loading From <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm ummu-datepicker" id="iDateLoadingFrom" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Date of Loading To <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm ummu-datepicker" id="iDateLoadingTo" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Port of Loading <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm" required disabled data-label="Port of Loading">
                        <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label text-right">Port of Discharge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-7">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm" required disabled data-label="Port of Discharge">
                        <span class="popup-text">ex: Jettu Pelindo, Bojonegara, Jawa Barat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
