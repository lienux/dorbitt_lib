<!-- Form -->
<div id="form_input">

    <div class="row">
        <!-- Data Personal -->
        <div class="col-lg-6 col-sm-12">
            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0" for="full_name">
                    Captain<span class="text-danger"> *</span>
                </label>
                <div class="col">
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

            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="seafarer_code">
                    Seafarer Code
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm endis" id="seafarer_code" placeholder="10 digit kode pelaut" title="Seafarer Code" disabled>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="birth_place">
                    Tempat Lahir
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm endis" id="birth_place" title="Tempat Lahir" disabled>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="birth_date">
                    Tanggal Lahir<!-- <span class="text-danger"> *</span> -->
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-birth-datepicker" id="birth_date" title="Tanggal Lahir" placeholder="Pilih tanggal" readonly disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="birth_date" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                            <div class="input-group-text" id="info-umur"><strong class="mr-1">Usia:</strong>. . . . . . . .</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="gender">
                    Jenis Kelamin <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-sm endis" id="gender" disabled required>
                            <option value="">- Pilih -</option>
                            <option value="1">Laki-laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="blood_type">
                    Golongan Darah
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-sm endis" id="blood_type" disabled>
                            <option value="">- Pilih -</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <!--  -->
        </div>
    </div>
</div>
<!-- /Form -->