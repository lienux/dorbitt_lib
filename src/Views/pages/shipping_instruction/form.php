<style>
    .popup-text {
        font-size: 11px;
        color: #94a3b8;
        display: block;
        margin-top: 4px;
        font-style: italic;
    }
    .form-control:disabled {
        background-color: #f8fafc;
        cursor: not-allowed;
    }
    .col-form-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    /* State Error & Warning */
    .invalid-feedback-custom {
        display: none;
        font-size: 11px;
        color: #dc3545;
        margin-top: 4px;
        font-weight: 600;
    }
    .warning-feedback-custom {
        display: none;
        font-size: 11px;
        color: #d97706; /* Orange */
        margin-top: 4px;
        font-weight: 600;
    }
    .is-invalid-custom {
        border-color: #dc3545 !important;
    }
    .is-warning-custom {
        border-color: #f59e0b !important;
        background-color: #fffbeb !important;
    }

    /* ============================================================
       MODERN QUANTITY + UoM (Inline Group + Suffix)
       ============================================================ */
    .quantity-uom-group {
        border-radius: 6px;
        border: 1px solid #ced4da; 
        background: #fff;
        overflow: hidden;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        display: flex;
        align-items: stretch;
    }
    .quantity-uom-group:focus-within {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .quantity-uom-group.is-invalid-custom {
        border-color: #dc3545 !important;
    }
    .quantity-uom-group.is-invalid-custom:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    .quantity-uom-group .qty-input {
        border: none !important;
        box-shadow: none !important;
        height: 31px;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 700;
        text-align: right;
        background: transparent;
        color: #495057;
        flex: 1;
    }
    .quantity-uom-group .qty-input:focus {
        outline: none;
    }
    .quantity-uom-group .uom-select {
        border: none !important;
        border-left: 1px dashed #ced4da !important; 
        box-shadow: none !important;
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        cursor: pointer;
        height: 31px;
        padding: 0 1.75rem 0 0.75rem;
        font-size: 0.875rem;
        border-radius: 0;
        min-width: 85px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 12px;
    }
    .quantity-uom-group .uom-select:focus {
        background-color: #fff;
        outline: none;
    }
    .quantity-uom-group .input-group-append {
        margin-left: 0;
        display: flex;
    }

    /* ============================================================
       MODERN DATE OF LOADING (Stacked Text)
       ============================================================ */
    .date-range-group {
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: 6px;
        background: #fff;
        padding: 0 0.5rem;
        height: 38px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .date-range-group:focus-within {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .date-range-group.is-invalid-custom {
        border-color: #dc3545 !important;
    }
    .date-range-group.is-invalid-custom:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    .date-range-group .date-input-wrapper {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }
    .date-range-group .date-label {
        font-size: 9px;
        font-weight: 800;
        color: #475569; 
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: -2px;
        pointer-events: none;
    }
    .date-range-group input.form-control {
        border: none !important;
        box-shadow: none !important;
        height: 18px;
        padding: 0;
        font-size: 0.875rem;
        background: transparent;
        color: #1e293b;
        font-weight: 600;
    }
    .date-range-group input.form-control:focus {
        outline: none;
        box-shadow: none !important;
    }
    .date-range-group input.form-control::placeholder {
        color: #cbd5e1;
        font-weight: 400;
        font-size: 0.8rem;
    }
    .date-range-divider {
        color: #94a3b8;
        font-size: 12px;
        padding: 0 10px;
        display: flex;
        align-items: center;
        pointer-events: none;
    }
    .btn-datepicker-clean {
        background: transparent;
        border: none;
        color: #64748b;
        padding: 0 4px;
        cursor: pointer;
        height: 100%;
        display: flex;
        align-items: center;
        transition: color 0.15s;
    }
    .btn-datepicker-clean:hover {
        color: #0d6efd;
    }

    /* ============================================================
       PREVIEW PAYLOAD
       ============================================================ */
    #preview_payload {
        background: #1e293b;
        color: #a5f3fc;
        border-radius: 8px;
        font-size: 12px;
        line-height: 1.5;
        border: none;
    }
</style>

<div id="form_input">
    <div class="row">
        <!-- ================= KOLOM KIRI ================= -->
        <div class="col-lg-6 col-sm-12">

            <!-- Shipper -->
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Shipper<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="client" placeholder="Pilih Shipper / Client" data-label="Shipper" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_client" type="button" disabled
                                data-inputid="client" data-modaltitle="Master Data Clients">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugboat -->
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Tugboat<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="tugboat" placeholder="Pilih Tugboat" data-label="Tugboat" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_tugboat" type="button" disabled
                                data-inputid="tugboat" data-modaltitle="Master Data Vessel - Tugboat">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barge -->
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Barge<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="barge" placeholder="Pilih Barge" data-label="Barge" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_barge" type="button" disabled
                                data-inputid="barge" data-modaltitle="Master Data Vessel - Barge">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cargo Type (Datalist + Smart Validation) -->
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Cargo Type<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <input type="text" name="load_type" id="load_type" list="list_cargo_type" class="form-control form-control-sm endis" placeholder="Pilih atau ketik Cargo Type" data-label="Cargo Type" required disabled>
                    <datalist id="list_cargo_type">
                        <!-- <option value="Batubara"></option>
                        <option value="Pasir Besi"></option>
                        <option value="Biji Kelapa"></option>
                        <option value="Pupuk"></option>
                        <option value="General Cargo"></option>
                        <option value="Semen"></option>
                        <option value="Kontainer"></option> -->
                    </datalist>
                    <span class="popup-text">Pilih dari list atau ketik manual jika tidak ada.</span>
                    <div class="warning-feedback-custom" id="warn_load_type"></div>
                </div>
            </div>

            <!-- Modern Quantity + UoM -->
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">
                    Quantity<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm quantity-uom-group" id="qty_group">
                        <input type="text" 
                               name="qty" 
                               id="qty" 
                               class="form-control text-right font-weight-bold qty-input endis" 
                               placeholder="0" 
                               data-label="Quantity" 
                               inputmode="decimal"
                               disabled required>
                        <div class="input-group-append">
                            <select class="form-control uom-select endis" id="uom" name="uom" disabled required style="min-width:90px;">
                                <option value="" disabled selected>UoM</option>
                                <option value="MT">MT</option>
                                <option value="KG">KG</option>
                                <option value="TON">TON</option>
                                <option value="CBM">CBM</option>
                                <option value="LTR">LTR</option>
                            </select>
                        </div>
                    </div>
                    <span class="popup-text">Masukkan jumlah muatan, pilih satuan di kanan.</span>
                    <div class="invalid-feedback-custom" id="err_qty">Quantity dan UoM wajib diisi.</div>
                </div>
            </div>
        </div>

        <!-- ================= KOLOM KANAN ================= -->
        <div class="col-lg-6 col-sm-12">

            <!-- Modern Date of Loading -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <div class="date-range-group" id="date_group">
                        <div class="date-input-wrapper">
                            <span class="date-label">FROM</span>
                            <input type="text" class="form-control ummu-datepicker endis" id="iDateLoadingFrom" placeholder="Tgl Mulai" data-label="Date of Loading From" readonly disabled required>
                        </div>
                        <div class="date-range-divider"><i class="fas fa-arrow-right"></i></div>
                        <div class="date-input-wrapper">
                            <span class="date-label">TO</span>
                            <input type="text" class="form-control ummu-datepicker endis" id="iDateLoadingTo" placeholder="Tgl Akhir" data-label="Date of Loading To" readonly disabled required>
                        </div>
                    </div>
                    <span class="popup-text">Tentukan rentang tanggal muat.</span>
                    <div class="invalid-feedback-custom" id="err_date">Tanggal "To" tidak boleh lebih awal dari "From".</div>
                </div>
            </div>

            <!-- Port of Loading -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    Port of Loading<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <input type="text"
                           name="loading_port"
                           id="loading_port"
                           class="form-control form-control-sm endis"
                           list="list_loading_port"
                           placeholder="Pilih atau ketik nama pelabuhan..."
                           autocomplete="off"
                           data-label="Port of Loading"
                           disabled>
                    <datalist id="list_loading_port"></datalist>
                    <span class="popup-text">Pilih dari list atau ketik manual jika tidak ada.</span>
                    <div class="warning-feedback-custom" id="warn_loading"></div>
                </div>
            </div>

            <!-- Port of Discharge -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    Port of Discharge<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <input type="text"
                           name="discharge_port"
                           id="discharge_port"
                           class="form-control form-control-sm endis"
                           list="list_discharge_port"
                           placeholder="Pilih atau ketik nama pelabuhan..."
                           autocomplete="off"
                           data-label="Port of Discharge"
                           disabled>
                    <datalist id="list_discharge_port"></datalist>
                    <span class="popup-text">Pilih dari list atau ketik manual jika tidak ada.</span>
                    <div class="warning-feedback-custom" id="warn_discharge"></div>
                </div>
            </div>

            <!-- File -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">File<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <div class="custom-file custom-file-sm">
                            <input type="file" class="custom-file-input endis" id="file_upload" name="file_upload" data-label="File" disabled>
                            <label class="custom-file-label" for="file_upload">Choose file...</label>
                        </div>
                    </div>
                    <div>
                        <a id="file_url" target="_blank">
                            <span>Click here to open File.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Action -->
<!-- <hr>
<div class="text-right">
    <button type="button" class="btn btn-outline-secondary btn-sm mr-2" id="btn_reset">
        <i class="fas fa-undo"></i> Reset
    </button>
    <button type="button" class="btn btn-outline-primary btn-sm mr-2" id="btn_draft">
        <i class="fas fa-file-alt"></i> Save as Draft
    </button>
    <button type="button" class="btn btn-primary btn-sm" id="btn_submit">
        <i class="fas fa-paper-plane"></i> Simpan & Submit
    </button>
</div> -->

<!-- Preview payload -->
<!-- <div class="mt-3">
    <strong><i class="fas fa-code mr-1"></i>Preview payload saat submit:</strong>
    <pre id="preview_payload" class="p-3 mt-2" style="max-height:220px;overflow:auto;">-</pre>
</div> -->