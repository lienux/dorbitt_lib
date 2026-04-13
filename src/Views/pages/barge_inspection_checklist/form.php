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
                    <label class="col-sm-3 col-form-label">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" placeholder="Choose..." data-label="Date" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="iDate" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Barge <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="barge" data-label="Barge" disabled required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Location<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm endis" id="location" data-label="Location" disabled required>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label text-right">Auditor Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="auditor" data-label="Auditor Name" placeholder="Choose..." disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_crew" type="button" disabled
                                    data-inputid="auditor" data-modaltitle="List Crew">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label text-right">Job Title <sup class="text-info">auto</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="job_title" data-label="Job Title" disabled required>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($equipment as $key => $value) { ?>
        <div class="card my-2 border-left-primary shadow h-100">
            <div class="col-ajah mt-2">
                <div class="row mb-0">
                    <div class="col-lg-2 mb-2">
                        <div class="custom-control custom-checkbox custom-purple-lg">
                            <input type="checkbox" class="custom-control-input endis" id="equipment<?=$value->id?>" data-equipment="<?=$value->id?>" required disabled>
                            <label class="custom-control-label font-weight-boldz" for="equipment<?=$value->id?>">
                                <?=$value->name ?>
                            </label>
                            <!-- <div class="invalid-feedback">Anda harus menyetujui ini sebelum upload.</div> -->
                        </div>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <input type="text" name="" class="form-control form-control-sm endis" id="condition<?=$value->id?>" data-condition="<?=$value->id?>" placeholder="Condition (%)" required disabled>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="last_supply<?=$value->id?>" data-lastsupply="<?=$value->id?>" placeholder="Last Supply" data-label="Date" disabled required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                    data-inputid="last_supply<?=$value->id?>" disabled>
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <textarea class="form-control form-control-sm endis" rows="1" id="keterangan<?=$value->id?>" data-keterangan="<?=$value->id?>" placeholder="Keterangan" disabled required></textarea>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <div class="input-group">
                            <div class="custom-file custom-file-sm">
                                <input type="file" class="custom-file-input" id="file<?=$value->id?>" disabled required>
                                <label class="custom-file-label" for="file<?=$value->id?>">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
