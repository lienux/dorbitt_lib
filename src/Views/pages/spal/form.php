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
                    <div class="col-sm-9">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Nome<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="nome" id="nome" class="form-control form-control-sm" required disabled>
                    </div>
                    <label class="col-sm-3 col-form-label text-right">HP<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="hp" id="hp" class="form-control form-control-sm" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Lightship<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="lightship" id="lightship" class="form-control form-control-sm" required disabled>
                    </div>
                    <label class="col-sm-3 col-form-label text-right">Capacity<span class="text-danger small"> *</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="capacity" id="capacity" class="form-control form-control-sm inputAngka" required disabled>
                        <!-- <span class="unit">Liter</span> -->
                    </div>
                </div>
                <!-- <div class="row">
                    <label class="col-sm-3 col-form-label">Client</label>
                    <div class="col-sm-9">
                        <input type="text" name="client" id="client" class="form-control form-control-sm" required disabled>
                    </div>
                </div> -->

                 <div class="row">
                    <label class="col-sm-3 col-form-label">Stb Fuelcons</label>
                    <div class="col-sm-9 input-container-unit">
                        <input type="text" name="stby_fuelcons" id="stby_fuelcons" class="form-control form-control-sm fuelcons" required disabled>
                        <span class="unit">Liter</span>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        Laden
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">River speed<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="laden_river_speed" id="laden_river_speed" class="form-control form-control-sm speed" required disabled>
                                <span class="unit">Knot</span>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">River fuelcons<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="laden_river_fuelcons" id="laden_river_fuelcons" class="form-control form-control-sm fuelcons" required disabled>
                                <span class="unit">Liter</span>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Sea speed<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="laden_sea_speed" id="laden_sea_speed" class="form-control form-control-sm speed" required disabled>
                                <span class="unit">Knot</span>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">Sea fuelcons<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="laden_sea_fuelcons" id="laden_sea_fuelcons" class="form-control form-control-sm fuelcons" required disabled>
                                <span class="unit">Liter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header">
                        Ballast
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">River speed<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="ballast_river_speed" id="ballast_river_speed" class="form-control form-control-sm speed" required disabled>
                                <span class="unit">Knot</span>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">River fuelcons<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="ballast_river_fuelcons" id="ballast_river_fuelcons" class="form-control form-control-sm fuelcons" required disabled>
                                <span class="unit">Liter</span>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Sea speed<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="ballast_sea_speed" id="ballast_sea_speed" class="form-control form-control-sm speed" required disabled>
                                <span class="unit">Knot</span>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">Sea fuelcons<span class="text-danger small"> *</span></label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="ballast_sea_fuelcons" id="ballast_sea_fuelcons" class="form-control form-control-sm fuelcons" required disabled>
                                <span class="unit">Liter</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        Runningfree
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Speed</label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="runningfree_speed" id="runningfree_speed" class="form-control form-control-sm speed" required disabled>
                                <span class="unit">Knot</span>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">Consum</label>
                            <div class="col-sm-3 input-container-unit">
                                <input type="text" name="runningfree_cons" id="runningfree_cons" class="form-control form-control-sm fuelcons" required disabled>
                                <span class="unit">Liter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
