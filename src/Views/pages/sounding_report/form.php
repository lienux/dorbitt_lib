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
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Type<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="sr_type" class="form-control form-control-sm endis" disabled>
                            <option selected disabled>Choose...</option>
                            <option value="1">SR Arrival</option>
                            <option value="2">SR Before Bunker</option>
                            <option value="3">SR After Bunker</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Tugboat<span class="text-danger small"> *</span></label>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="tugboat" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis" id="btn_show_tugboat" type="button" disabled
                                    data-inputid="tugboat">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">HP Engine</span>
                            </div>
                            <input type="text" class="form-control" id="hp_engine" placeholder="" aria-label="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Barge<span class="text-danger small"> *</span></label>
                    <div class="col-sm-4">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="barge" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis" id="btn_show_barge" type="button" disabled
                                    data-inputid="barge">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cargo</span>
                            </div>
                            <input type="text" class="form-control" id="cargo" placeholder="" aria-label="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Trip Number:<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="trip_number" id="trip_number" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Departure<span class="text-danger small"> *</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" placeholder="Location" required disabled>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="departure_date" placeholder="Date Time" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="departure_date" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Arrival<span class="text-danger small"> *</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" placeholder="Location" required disabled>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="arrival_date" placeholder="Date Time" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="arrival_date" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Stop Engine<span class="text-danger small"> *</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" placeholder="Location" required disabled>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="arrival_date" placeholder="Date Time" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis" type="button"
                                    data-inputid="arrival_date" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Additional Report</label>
                    <div class="col-sm-9">
                        <textarea type="text" rows="1" id="additional_report" class="form-control form-control-sm endis" required disabled></textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Upload Foto:<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="upload_foto" id="upload_foto" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <!-- <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Phone Number</label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" id="phone" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Email</span></label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Role <span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <select id="role" name="role" class="form-select form-select-sm" disabled>
                            <option value="" selected disabled>Choose...</option>
                            
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
