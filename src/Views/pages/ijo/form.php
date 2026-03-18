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
                    <label class="col-sm-3 col-form-label">Date<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control ummu-datepicker" id="iDate" readonly disabled>
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
                    <label class="col-sm-3 col-form-label">Number<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="number" id="number" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: 040/IJO/WGM/0226</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">From<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="from" id="from" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Marketing Departement</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">To<span class="text-danger small"> *</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="to" id="to" class="form-control form-control-sm endis" required disabled>
                        <span class="popup-text">ex: Operation Departement</span>
                    </div>
                </div>
                
            </div>
            <div class="col">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Contract<span class="text-danger small"> *</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="contract" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_spal" type="button" disabled
                                    data-inputid="contract" data-modaltitle="List Surat Perjanjian / Contract">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Port of Loading</label>
                    <div class="col-sm-8">
                        <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm" placeholder="Auto from contract" required disabled>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Port of Discharge</label>
                    <div class="col-sm-8">
                        <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm" placeholder="Auto from contract" required disabled>
                    </div>
                </div>
               <!--  <div class="row">
                    <label class="col-sm-4 col-form-label">SI</label>
                    <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="si" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary endis show-left-modal" id="btn_show_si" type="button" disabled
                                    data-inputid="si" data-modaltitle="Master Data Barge">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Tugboat/Barge Nomination (Default auto from contract)
    </div>
    <div class="card-body">
        <div class="mb-2">
            <button type="button" class="btn btn-sm btn-outline-primary show-left-modal" id="new_item" data-tableid="tbIjoDetail" data-modaltitle="List Shipping Instruction (SI)">New item from other SI</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="tbIjoDetail"
                width="100%" cellspacing="0">
                <thead class="bg-success text-light">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Tugboat</th>
                        <th>Barge</th>
                        <th>Barge Capacity</th>
                        <th>Tonnage</th>
                        <th>ETA Loading Port</th>
                        <th>ETA Discharging Port</th>
                        <th>ETD/Cost Off Discharging Port</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
