<div id="form_filter">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title text-info"><i class="fas fa-filter"></i> FILTER DATA</h5>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="vessel_id">Vessel</label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm border-info text-info is-data-id" id="vessel_id" placeholder="Pilih Vessel" data-label="Vessel" disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary endis show-left-modal btn-endis" id="btn_show_vessel" type="button"  data-inputid="vessel_id" data-modaltitle="Master Vessel">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button class="btn btn-outline-danger ummu-clear-input" type="button"  for="vessel_id">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-sm-12">
                    <!--  -->
                </div>
            </div>
            <!-- <div>
                <button class="btn btn-sm btn-primary" id="btn_clear_filter">
                    <i class="bi bi-arrow-clockwise"></i> Reset Filter
                </button>
            </div> -->
        </div>
    </div>
</div>