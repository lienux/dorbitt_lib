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
            <div class="col">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Kode</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm endis" required disabled>
                    </div>
                    <label class="col-sm-3 col-form-label text-right">Category</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="category" id="category" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Model</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="model" id="model" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Serial Number</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="serial_number" id="serial_number" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Manufacture</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="manufacture" id="manufacture" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Maintenance</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="maintenace_schedule" id="maintenace_schedule" class="form-control form-control-sm endis" placeholder="Maintenance Schedule" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Criticality Level</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="criticality_level" id="criticality_level" class="form-control form-control-sm endis" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Location</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="location" id="location" class="form-control form-control-sm endis" required disabled>
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
</div>
