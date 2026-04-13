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
            <div class="col-lg-6 col-sm-12 mb-2">
                <div class="row">
                    <label class="col-sm-3 col-form-label">NIK<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" id="nik" class="form-control form-control-sm endis" disabled required placeholder="Masukan Nomor Induk Karyawan (NIK)">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" data-label="Name Karyawan" required disabled placeholder="Masukan Nama Karyawan">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- <div class="row">
                    <label class="col-sm-3 col-form-label">Flag / Registry<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="flag_registry" id="flag_registry" class="form-control form-control-sm" required disabled>
                        <span class="popup-text">Bendera negara tempat kapal terdaftar. ex : Indonesia / [Kota Pendaftaran]</span>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Classification<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="classification" id="classification" class="form-control form-control-sm" required disabled>
                        <span class="popup-text">Lembaga yang mengaudit kelayakan kapal (contoh: BKI di Indonesia, ABS, atau LR).</span>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Year / Place<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="yearBuild_place" id="yearBuild_place" class="form-control form-control-sm" required disabled>
                        <span class="popup-text">Tahun kapal selesai dibangun. ex: [Tahun] / [Nama Galangan]</span>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
