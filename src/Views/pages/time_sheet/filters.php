<div id="form_filter">
    <div class="card mb-2">
        <div class="card-body">
            <label class="filter-label-header"><i class="fas fa-filter mr-1"></i>FILTER DATA</label>
            <div class="row">

                <div class="col-md-4">
                    <label class="font-weight-bold small mb-0" for="ijo_id">IJO</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm text-info is-data-id" id="ijo_id" placeholder="Pilih IJO" data-label="Rank" disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary endis show-left-modal btn-endis" id="btn_show_ijo" type="button"  data-inputid="ijo_id" data-modaltitle="List IJO">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button class="btn btn-outline-danger ummu-clear-input" type="button"  for="ijo_id">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="font-weight-bold small mb-0" for="vessel_id">Tugboat</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm text-info is-data-id" id="vessel_id" placeholder="Pilih Tugboat" data-label="Tugboat" disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary endis show-left-modal btn-endis" id="btn_show_vessel" type="button"  data-inputid="vessel_id" data-modaltitle="Master Tugboat">
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
    </div>
</div>