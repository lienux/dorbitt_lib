<!-- Form -->
<div id="form_input"> 
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Type<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-sm endis" id="type" disabled required>
                            <option value="">- Pilih -</option>
                            <option value="fc">Freight Charter</option>
                            <option value="tc">Time Charter</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Client<span class="text-danger small"> *</span></label>
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
                <label class="col-sm-3 col-form-label mb-0 pb-0">Tugboat</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="tugboat" placeholder="Pilih Tugboat" data-label="Tugboat" disabled>
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
                <label class="col-sm-3 col-form-label mb-0 pb-0">Barge</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="barge" placeholder="Pilih Barge" data-label="Barge" disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_barge" type="button" disabled
                                data-inputid="barge" data-modaltitle="Master Data Vessel - Barge">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Rute<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <input type="text" name="rute_perjalanan" id="rute_perjalanan" class="form-control form-control-sm endis" required disabled data-label="Rute perjalanan" placeholder="Rute perjalanan">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">ETA Loading Port</label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" placeholder="Choose..." id="eta_loading_port" data-label="ETA Discharge Port" readonly disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="eta_loading_port" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
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

            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Remark</label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <textarea class="form-control endis" id="remark" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>