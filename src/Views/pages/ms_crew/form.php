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
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="behavior">Cost Behavior<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="px-3">
                                <input type="radio" id="fixed_cost" name="behavior" value="1" class="endis" disabled>
                                <label for="fixed_cost">Fixed Cost</label>
                            </div>
                            <div class="px-3">
                                <input type="radio" id="variable_cost" name="behavior" value="2" class="endis" disabled>
                                <label for="variable_cost">Variable Cost</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="category">Cost Category<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="category" class="form-control form-control-sm endis" title="Category" disabled required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="1">Constants</option>
                            <option value="2">Rates</option>
                            <option value="3">Vessel Particular</option>
                            <option value="4">Crew Cost</option>
                            <option value="5">Port Costs</option>
                            <option value="6">Time in Ports</option>
                            <option value="7">Sailing Distances</option>
                            <option value="8">Time Sailing</option>
                            <option value="9">Costs</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="name">
                        Cost Name<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="name" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Cost Name" disabled required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label mb-0 pb-0" for="amount">
                        Amount
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="amount" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Tarif / Charges" disabled required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- <div class="row mb-2">
                    <label class="col-sm-3z col-form-label mb-0 pb-0" for="tarif">
                        Test : 
                    </label>
                    <div class="checkbox-wrap">
                        <input type="checkbox"/>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
