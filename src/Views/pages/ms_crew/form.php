<style>
    /*.card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .card-header {
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
        font-weight: 600;
    }*/
    .bg-maritime {
        background-color: #1a2e40 !important;
        color: #ffffff;
    }
    .section-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: #ffffff;
        background-color: #7A29FF;
        padding: 6px 12px;
        border-radius: 5px;
    }
    /*.table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    .table td {
        vertical-align: middle;
        font-size: 0.87rem;
    }*/
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .btn-action {
        padding: 2px 6px;
        font-size: 0.8rem;
        border-radius: 4px;
    }
    .custom-file-label::after {
        background-color: #1a2e40;
        color: white;
    }
</style>

<!-- Form -->
<div id="form_input"> 
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <!-- BLOCK 1: PERSONAL -->
            <div class="section-title mb-3"><i class="fas fa-user mr-1"></i> Data Personal</div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="full_name">
                    Nama Lengkap<span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm endis" id="full_name" title="Nama Lengkap" required disabled>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="birth_place">
                    Tempat Lahir
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm endis" id="birth_place" title="Tempat Lahir" required disabled>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="birth_date">
                    Tanggal Lahir
                    <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-birth-datepicker" id="birth_date" title="Tanggal Lahir" placeholder="Pilih tanggal" readonly disabled required>
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
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="phone_number">
                    No. Handphone
                    <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm endis" id="phone_number" placeholder="0812xxxxxxxx" title="No. Handphone" required disabled>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="blood_type">
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

            <!-- BLOCK 2: KEPEGAWAIAN MARITIM -->
            <div class="section-title mb-3 mt-4"><i class="fas fa-anchor mr-1"></i> Kompetensi & Jabatan</div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="crew_ranks">
                    Base Rank
                    <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm font-weight-bold border-info text-info" id="crew_ranks" placeholder="Pilih Rank" data-label="Rank" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_ranks" type="button" disabled data-inputid="crew_ranks" data-modaltitle="Master Rank">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="highest_coc_certificate">
                    Kualifikasi Ijazah (COC)
                    <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-sm endis" id="highest_coc_certificate" disabled>
                            <option value="">- Pilih Kualifikasi -</option>
                            <option value="ANT-III">ANT-III</option>
                            <option value="ANT-IV">ANT-IV</option>
                            <option value="ANT-V">ANT-V</option>
                            <option value="ATT-III">ATT-III</option>
                            <option value="ATT-IV">ATT-IV</option>
                            <option value="RATING">RATING (Asisten)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 mb-0 pb-0 font-weight-bold small" for="phone_number">
                    Status Hubungan Kerja
                    <span class="text-danger"> *</span>
                </label>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-sm endis" id="employment_status" disabled>
                            <option value="">- Pilih Hubungan Kerja-</option>
                            <option value="1">Karyawan Tetap</option>
                            <option value="2">Kontrak (PKL)</option>
                            <option value="4">Harian Lepas</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <!-- BLOCK 3: LEGALITAS DOKUMEN -->
            <div class="section-title mb-3 mt-4z"><i class="fas fa-file-contract mr-1"></i> Dokumen & Masa Berlaku</div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold small">No. Buku Pelaut <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-sm endis" id="seaman_book_number" placeholder="E-XXXXXX" required disabled>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold small text-danger">Expired Buku Pelaut <span class="text-danger">*</span></label>
                    <!-- <input type="text" class="form-control form-control-sm border-danger endis" id="seaman_book_expiry" required disabled> -->
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker border-danger" id="seaman_book_expiry" title="Expired Buku Pelaut" placeholder="Pilih tanggal" readonly disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="seaman_book_expiry" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold small">No. MCU Maritim</label>
                    <input type="text" class="form-control form-control-sm endis" id="mcu_maritime_number" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold small">Expired MCU Maritim</label>
                    <!-- <input type="date" class="form-control form-control-sm endis" id="mcu_maritime_expiry" disabled> -->
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="mcu_maritime_expiry" title="Expired Buku Pelaut" placeholder="Pilih tanggal" readonly disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="mcu_maritime_expiry" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold small" for="crew_document_pdf">Upload Berkas Gabungan (CV & Dokumen) <span class="text-muted">(PDF Max 5MB)</span></label>
                <div class="custom-file custom-file-sm">
                    <input type="file" class="custom-file-input endis" id="crew_document_pdf" accept=".pdf" disabled>
                    <label class="custom-file-label" for="crew_document_pdf" id="crew_document_pdf_text">Pilih Berkas PDF...</label>
                </div>
                <a href="" class="click-to-open-file" id="click_to_open_file" target="_blank">Click here to open file</a>
            </div>
        </div>
    </div>
</div>
