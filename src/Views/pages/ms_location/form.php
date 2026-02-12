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
            <div class="col">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Kode</span></label>
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
                <div class="row">
                    <label class="col-sm-3 col-form-label">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="latitude" id="latitude" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="longitude" id="longitude" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea type="text" id="address" class="form-control form-control-sm endis" required disabled></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" id="description" class="form-control form-control-sm endis" required disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <!-- <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" id="phone" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Email</span></label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Role <span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="role" name="role" class="form-select form-select-sm" disabled>
                            <option value="" selected disabled>Choose...</option>
                            
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
