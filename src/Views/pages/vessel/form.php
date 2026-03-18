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
                    <label class="col-sm-3 col-form-label">Type<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <select id="type" class="form-control form-control-sm" disabled>
                            <option value="" selected disabled>Choose...</option>
                            <option value="1">Tugboat</option>
                            <option value="2">Barge</option>
                            <option value="3">Cargo</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Kode</label>
                    <div class="col-sm-9">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm" required disabled>
                        <span class="popup-text">Kode Kapal</span>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" required disabled>
                        <span class="popup-text">Nama Kapal</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="row">
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
                </div>
            </div>
        </div>

        <div class="mt-4">
            <nav class="ummu-nav">
                <div class="nav nav-tabs">
                    <button class="nav-link mr-1 py-0" id="nav-tab-machinery" data-toggle="tab" data-target="#nav-machinery" type="button" role="tab" aria-selected="true" disabled>
                        Machinery & Propulsion
                    </button>
                    <button class="nav-link mr-1 py-0" id="nav-tab-tank" data-toggle="tab" data-target="#nav-tank" type="button" role="tab" aria-selected="true" disabled>
                        Tank Capacity
                    </button>
                    <button class="nav-link mr-1 py-0" id="nav-tab-dimension" data-toggle="tab" data-target="#nav-dimension" type="button" role="tab" aria-selected="true" disabled>
                        Dimension & Capacity
                    </button>
                    <button class="nav-link mr-1 py-0" id="nav-tab-fuelconsum" data-toggle="tab" data-target="#nav-fuelconsum" type="button" role="tab" aria-selected="true" disabled>
                        Fuel Consumtion
                    </button>
                    <button class="nav-link mr-1 py-0" id="nav-tab-speed" data-toggle="tab" data-target="#nav-speed" type="button" role="tab" aria-selected="true" disabled>
                        Speed
                    </button>
                </div>
            </nav>
            <div class="section-body">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <div class="tab-content">
                            <div class="tab-pane fade" id="nav-machinery" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'form_machinery')) ?>
                            </div>
                            <div class="tab-pane fade" id="nav-tank" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'form_tank')) ?>
                            </div>
                            <div class="tab-pane fade" id="nav-dimension" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'form_dimension')) ?>
                            </div>
                            <div class="tab-pane fade" id="nav-fuelconsum" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'form_fuelconsum')) ?>
                            </div>
                            <div class="tab-pane fade" id="nav-speed" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'form_speed')) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
