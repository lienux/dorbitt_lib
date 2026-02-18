<div class="mt-2">
    <div class="alert text-light collapse" id="alert_input"></div>
    <div class="collapse" id="loader_input">
        <div class="d-flex justify-content-center mt-2">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="mb-2" id="classic_button">
        <div class="sb-toolbar">
            <button class="btn btn-sm btn-primary" type="button" id="btn_new">
                <i class="bi bi-plus-circle-fill"></i> New
            </button>
            <button class="btn btn-sm" type="button" id="btn_edit" disabled>
                <i class="bi bi-pencil-square"></i> Edit
            </button>
            <button class="btn btn-sm" type="button" id="btn_delete" disabled>
                <i class="bi bi-trash-fill"></i> Delete
            </button>
            <button class="btn btn-sm" type="button" id="btn_cancle" disabled>
                <i class="bi bi-x-circle-fill"></i> Cancle
            </button>
            <button class="btn btn-sm" type="button" id="btn_save" disabled>
                <i class="bi bi-floppy-fill"></i> Save
            </button>
            <!-- <button class="btn btn-sm btn-secondary" type="button" id="btn_close" disabled>
                <i class="bi bi-box-arrow-right"></i> Close
            </button> -->
        </div>
    </div>

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
                    <label class="col-sm-3 col-form-label">Voyage Code<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Tugboat<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
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
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Conditions<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="location" class="form-control form-control-sm endis" disabled>
                            <option selected disabled>Choose...</option>
                            <option value="1">Laden</option>
                            <option value="2">Ballast</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">From<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">To<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Remark</label>
                    <div class="col-sm-9">
                        <textarea type="text" id="remark" class="form-control form-control-sm endis" required disabled></textarea>
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
