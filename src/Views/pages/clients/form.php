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
            <!-- <div>
                <img src="https://cdn.openapi2.com/img/icon/boat_2485049.png" width="100px">
            </div> -->
            <div class="col">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" id="phone" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Email</span></label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea type="text" id="address" class="form-control form-control-sm" required disabled></textarea>
                    </div>
                </div>
                <!-- <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">
                        Password<span class="text-danger small"> *</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="password" class="form-control form-control-sm" id="password" disabled>
                            <button class="btn btn-sm btn-secondary" type="button" id="btn_show_password">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary" type="button" id="btn_generate_password">
                                Generate
                            </button>
                        </div>
                    </div>
                </div> -->
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
