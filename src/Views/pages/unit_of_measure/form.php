<div class="mt-2">
    <div class="alert text-light collapse" id="alert_input"></div>

    <?=$this->include(config('Ummu')->Views('partials/sb_button'))?>

    <div id="form_input"> 
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="row">
                    <label class="col-sm-3 col-form-label" for="kode">Kode<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="kode" id="kode" class="form-control form-control-sm endis" title="UoM Code" required disabled>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label" for="name">Name<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control form-control-sm endis" title="UoM Name" required required disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!--  -->
            </div>
        </div>
    </div>
</div>
