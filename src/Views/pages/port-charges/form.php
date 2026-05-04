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
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="ijo">
                        IJO
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="ijo" data-toggle="tooltip" data-placement="top" title="IJO (Internal Job Order)" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_ijo" type="button" disabled
                                    data-inputid="ijo" data-modaltitle="List IJO">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="ms_port">
                        Port
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="ms_port" data-toggle="tooltip" data-placement="top" title="Port / Pelabuhan" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_port" type="button" disabled
                                    data-inputid="ms_port" data-modaltitle="Master Data Port">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="ms_cost">
                        Cost Name
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="ms_cost" data-toggle="tooltip" data-placement="top" title="Cost Name" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_cost" type="button" disabled
                                    data-inputid="ms_cost" data-modaltitle="Master Data Cost">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="tarif">
                        Rates
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="tarif" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Tarif / Charges" disabled required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!--  -->
            </div>
        </div>
    </div>
</div>
