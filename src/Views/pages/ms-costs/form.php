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
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="category">Category<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="category" class="form-control form-control-sm endis" title="Category" disabled required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="port_charges">Port Charges</option>
                            <option value="fixed_cost">Fixed Cost</option>
                            <option value="variable_cost">Variable Cost</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="name">
                        Name<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="name" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Cost Name" disabled required>
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
