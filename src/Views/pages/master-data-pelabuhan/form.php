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
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="kode">Code</label>
                    <div class="col-sm-9">
                        <input type="text" id="kode" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Kode Pelabuhan" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="name">
                        Name<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="name" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Nama Pelabuhan" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="country">
                        Country<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="country" data-toggle="tooltip" data-placement="top" title="Negara" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_country" type="button" disabled
                                    data-inputid="country" data-modaltitle="Master Data Country">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="province">
                        Province<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="province" data-toggle="tooltip" data-placement="top" title="Wilayah/Provinsi" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_province" type="button" disabled
                                    data-inputid="province" data-modaltitle="Master Data Province">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="coordinates">
                        Coordinates<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="coordinates" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Coordinates" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="timezone">
                        Time Zone<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="timezone" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Time Zone" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="draft_limit">
                        Draft Limit<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="draft_limit" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Batas Kedalaman" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label" for="type">Type<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="type" class="form-control form-control-sm endis" data-toggle="tooltip" data-placement="top" title="Tipe Pelabuhan" disabled required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="1">Loading</option>
                            <option value="2">Discharge</option>
                            <option value="3">Bunker</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
