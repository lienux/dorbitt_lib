<div class="collapse" id="form_tr_perubahan_data">
    <div class="card">
        <div class="card-header bg-purple">
            <i class="fas fa-toggle-off"></i> Transaksi Perubahan Data
        </div>
        <div class="card-body">
            <!-- <h5 class="card-title">Transaksi Perubahan Data</h5> -->
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <h5 class="card-title">Transaksi Sign On / Sign Off Crew</h5>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="current_sign">
                                    Current Sign
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="form-control form-control-sm ummu-readonly" id="current_sign" readonly></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_status">
                                    Status <span class="text-danger"> *</span>
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <select class="form-control form-control-sm" id="sign_status">
                                            <option value="">- Pilih Sign On / Off -</option>
                                            <option value="on">Sign On</option>
                                            <option value="off">Sign Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_place">
                                    Sign Place
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm" id="sign_place" title="Tempat Sign">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_date">
                                    Sign Date
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control ummu-datepicker ummu-readonly" id="sign_date" title="Tanggal Sign" placeholder="Pilih tanggal" readonly disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-show-datepicker" type="button"
                                                data-inputid="sign_date">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_remark">
                                    Remark
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <textarea class="form-control form-control-sm" id="sign_remark"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-outline-purple" id="btn_submit_tr_sign" type="button">
                                    <i class="fas fa-save"></i> Update Sign Crew
                                </button>
                                <button class="btn btn-sm btn-outline-danger" id="btn_delete_tr_sign" type="button">
                                    <i class="fas fa-trash"></i> Delete Last Sign
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="dataTable_tr_sign_on_off"
                                    width="100%" cellspacing="0">
                                    <thead class="bg-success text-light"></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-6 col-sm-12">

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi Perpindahan Kapal</h5>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="tr_tugboat">
                                    Perpindahan Kapal
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm is-data-id ummu-readonly" id="tr_tugboat" placeholder="Pilih Kapal" data-label="Vessel" required disabled readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary show-left-modal" id="btn_show_vessel" type="button" data-inputid="tr_tugboat" data-modaltitle="Master Vessel">
                                                <i class="fas fa-list-ul"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="remark_pindah_kapal">
                                    Remark
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <textarea class="form-control form-control-sm" id="remark_pindah_kapal"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-outline-purple" id="btn_update_tr_kapal" type="button">
                                    <i class="fas fa-save"></i> Update Perubahan Kapal
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi Perubahan Rank</h5>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="tr_rank">
                                    Update Rank
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm is-data-id ummu-readonly" id="tr_rank" placeholder="Pilih Rank" data-label="Rank" required disabled readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary endis show-left-modal btn-endis" id="btn_show_rank" type="button" data-inputid="tr_rank" data-modaltitle="Master Rank">
                                                <i class="fas fa-list-ul"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="remark_update_rank">
                                    Remark
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <textarea class="form-control form-control-sm" id="remark_update_rank"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-outline-purple" id="btn_update_tr_rank" type="button">
                                    <i class="fas fa-save"></i> Update Kenaikan Gaji Pokok
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi Kenaikan Gaji Pokok</h5>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="current_gapok">
                                    Gaji Pokok Saat Ini
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="form-control form-control-sm ummu-readonly" id="current_gapok" readonly></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="tgl_kenaikan_gapok">
                                    Tanggal Kenaikan
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control ummu-datepicker ummu-readonly" id="tgl_kenaikan_gapok" title="Tanggal Sign" placeholder="Pilih tanggal" readonly disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-show-datepicker ummu-btn-custom" type="button"
                                                data-inputid="tgl_kenaikan_gapok">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="tr_gapok">
                                    Kenaikan Gaji Pokok
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" inputmode="numeric" step="0.01" min="0" class="form-control form-control-sm endis text-right" id="tr_gapok" placeholder="0" title="Gaji Pokok">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="remark_update_gapok">
                                    Remark
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <textarea class="form-control form-control-sm" id="remark_update_gapok"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-outline-purple" id="btn_update_tr_kenaikan_gapok" type="button">
                                    <i class="fas fa-save"></i> Update Kenaikan Gaji Pokok
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi Sign On / Sign Off Crew</h5>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="current_sign">
                                    Current Sign
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="form-control form-control-sm ummu-readonly" id="current_sign" readonly></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_status">
                                    Status <span class="text-danger"> *</span>
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <select class="form-control form-control-sm" id="sign_status">
                                            <option value="">- Pilih Sign On / Off -</option>
                                            <option value="on">Sign On</option>
                                            <option value="off">Sign Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_place">
                                    Sign Place
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm" id="sign_place" title="Tempat Sign">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_date">
                                    Sign Date
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control ummu-datepicker ummu-readonly" id="sign_date" title="Tanggal Sign" placeholder="Pilih tanggal" readonly disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-show-datepicker" type="button"
                                                data-inputid="sign_date">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-sm-4 mb-0 pb-0" for="sign_remark">
                                    Remark
                                </label>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <textarea class="form-control form-control-sm" id="sign_remark"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-outline-purple" id="btn_submit_tr_sign" type="button">
                                    <i class="fas fa-save"></i> Update Sign Crew
                                </button>
                                <button class="btn btn-sm btn-outline-danger" id="btn_delete_tr_sign" type="button">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>