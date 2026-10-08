<!-- Form -->
<div id="form_input"> 
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <!-- <div class="fc-section">
                <div class="fc-section-header">
                    <span class="fc-icon"><i class="fas fa-file-signature"></i></span>
                    <h6>Informasi Activity</h6>
                    <small>Activity Header</small>
                </div> -->
                <div class="row">
                    <label class="col-sm-3 col-form-label">Domains <span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control is-data-id" id="domains" data-toggle="tooltip" data-placement="top" title="Activity Domains" required disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_sektor" type="button" disabled
                                    data-inputid="domains" data-modaltitle="Activity Domains">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                                <button class="btn btn-outline-danger ummu-clear-input endis" type="button" data-inputid="domains" data-modaltitle="Clear Responsibility" for="domains" disabled>
                                    <i class="fas fa-backspace"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Kode</label>
                    <div class="col-sm-9">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0" for="category">
                    Category<!-- <span class="text-danger small"> *</span> -->
                </label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control is-data-id" id="category" data-toggle="tooltip" data-placement="top" title="Master Category" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_category" type="button" disabled
                                data-inputid="category" data-modaltitle="Master Data Category">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button class="btn btn-outline-danger ummu-clear-input endis" type="button" data-inputid="category" data-modaltitle="Clear Responsibility" for="category" disabled>
                                <i class="fas fa-backspace"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0" for="tcode">
                    TCODE<!-- <span class="text-danger small"> *</span> -->
                </label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control is-data-id" id="tcode" data-toggle="tooltip" data-placement="top" title="Master Data TCODE" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_tcode" type="button" disabled
                                data-inputid="tcode" data-modaltitle="Master Data Tcode">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button class="btn btn-outline-danger ummu-clear-input endis" type="button" data-inputid="tcode" data-modaltitle="Clear Responsibility" for="tcode" disabled>
                                <i class="fas fa-backspace"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0" for="responsibility">
                    Responsibility
                </label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control is-data-id" id="responsibility" data-toggle="tooltip" data-placement="top" title="Master Data Responsibility" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_responsibility" type="button" disabled
                                data-inputid="responsibility" data-modaltitle="Master Data Responsibility">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button class="btn btn-outline-danger ummu-clear-input endis" type="button" data-inputid="responsibility" data-modaltitle="Clear Responsibility" for="responsibility" disabled>
                                <i class="fas fa-backspace"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea type="text" id="description" class="form-control form-control-sm endis" required disabled></textarea>
                </div>
            </div>
        </div>
    </div>
</div>