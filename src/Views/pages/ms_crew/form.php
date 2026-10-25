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
    <!-- Sub-Tabs Form Crew -->
    <ul class="nav nav-tabs mb-3" id="crewFormTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab-personal" data-toggle="tab" href="#pane-personal" role="tab">
                <i class="fas fa-user mr-1"></i> Personal
                <span class="badge badge-danger ml-1 d-none" data-tab-badge="pane-personal">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-legalitas" data-toggle="tab" href="#pane-legalitas" role="tab">
                <i class="fas fa-id-card mr-1"></i> Legalitas
                <span class="badge badge-danger ml-1 d-none" data-tab-badge="pane-legalitas">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-kompetensi" data-toggle="tab" href="#pane-kompetensi" role="tab">
                <i class="fas fa-anchor mr-1"></i> Kompetensi
                <span class="badge badge-danger ml-1 d-none" data-tab-badge="pane-kompetensi">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-dokumen" data-toggle="tab" href="#pane-dokumen" role="tab">
                <i class="fas fa-file-contract mr-1"></i> Dokumen
                <span class="badge badge-danger ml-1 d-none" data-tab-badge="pane-dokumen">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-status" data-toggle="tab" href="#pane-status" role="tab">
                <i class="fas fa-ship mr-1"></i> Status & Lain
                <span class="badge badge-danger ml-1 d-none" data-tab-badge="pane-status">0</span>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="crewFormTabContent">

        <!-- ============================================================ -->
        <!-- TAB 1: PERSONAL                                              -->
        <!-- ============================================================ -->
        <div class="tab-pane fade show active" id="pane-personal" role="tabpanel">
            <div class="row">
                <!-- Data Personal -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-user mr-1"></i> Data Personal</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="full_name">
                            Nama Lengkap<span class="text-danger"> *</span>
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="full_name" title="Nama Lengkap" required disabled>
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

                <!-- Kontak & Alamat -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-address-book mr-1"></i> Kontak & Alamat</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="phone_number">
                            No. Handphone<!-- <span class="text-danger"> *</span> -->
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="phone_number" placeholder="0812xxxxxxxx" title="No. Handphone" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="email">
                            Email
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="email" class="form-control form-control-sm endis" id="email" placeholder="nama@email.com" title="Email" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="address">
                            Alamat
                        </label>
                        <div class="col">
                            <textarea class="form-control form-control-sm endis" id="address" rows="3" placeholder="Alamat lengkap" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- TAB 2: LEGALITAS                                             -->
        <!-- ============================================================ -->
        <div class="tab-pane fade" id="pane-legalitas" role="tabpanel">
            <div class="row">
                <!-- Identitas Resmi -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-id-card mr-1"></i> Identitas Resmi</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="national_id_number">
                            No. KTP
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="national_id_number" placeholder="16 digit NIK" title="No. KTP" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="family_card_number">
                            No. KK
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="family_card_number" placeholder="16 digit No. KK" title="No. KK" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="tax_id_number">
                            NPWP
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="tax_id_number" placeholder="00.000.000.0-000.000" title="NPWP" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kesehatan & Komersial -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-syringe mr-1"></i> Kesehatan & Komersial</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="vaccination_info">
                            Vaksin
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="vaccination_info" placeholder="cth: BOOSTER 1" title="Vaksin" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="basic_salary">
                            Gaji Pokok
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" inputmode="numeric" step="0.01" min="0" class="form-control form-control-sm endis text-right" id="basic_salary" placeholder="0" title="Gaji Pokok" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- TAB 3: KOMPETENSI                                            -->
        <!-- ============================================================ -->
        <div class="tab-pane fade" id="pane-kompetensi" role="tabpanel">
            <div class="row">
                <!-- Jabatan & Penempatan -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-anchor mr-1"></i> Jabatan & Penempatan</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="tugboat">
                            Vessel<span class="text-danger"> *</span>
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm font-weight-bold border-info text-info is-data-id" id="tugboat" placeholder="Pilih Vessel" data-label="Vessel" required disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_vessel" type="button" disabled data-inputid="tugboat" data-modaltitle="Master Vessel">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="crew_ranks">
                            Base Rank<span class="text-danger"> *</span>
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm font-weight-bold border-info text-info is-data-id" id="crew_ranks" placeholder="Pilih Rank" data-label="Rank" required disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_ranks" type="button" disabled data-inputid="crew_ranks" data-modaltitle="Master Rank">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="employment_status">
                            Status Hubungan Kerja<span class="text-danger"> *</span>
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <select class="form-control form-control-sm endis" id="employment_status" disabled required>
                                    <option value="">- Pilih Hubungan Kerja -</option>
                                    <option value="1">Karyawan Tetap</option>
                                    <option value="2">Kontrak (PKL)</option>
                                    <option value="4">Harian Lepas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikat COC -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-certificate mr-1"></i> Sertifikat COC</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="highest_coc_certificate">
                            Kualifikasi Ijazah (COC)<!-- <span class="text-danger"> *</span> -->
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
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="coc_certificate_number">
                            No. Sertifikat COC
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="coc_certificate_number" title="No. Sertifikat COC" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="coc_expiry_date">
                            Expired COC
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker" id="coc_expiry_date" title="Expired COC" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="coc_expiry_date" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- TAB 4: DOKUMEN                                               -->
        <!-- ============================================================ -->
        <div class="tab-pane fade" id="pane-dokumen" role="tabpanel">
            <div class="row">
                <!-- Buku Pelaut & MCU -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-book mr-1"></i> Buku Pelaut & MCU</div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">No. Buku Pelaut <!-- <span class="text-danger">*</span> --></label>
                            <input type="text" class="form-control form-control-sm endis" id="seaman_book_number" placeholder="E-XXXXXX" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small text-danger">Expired Buku Pelaut <!-- <span class="text-danger">*</span> --></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker border-danger" id="seaman_book_expiry" title="Expired Buku Pelaut" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="seaman_book_expiry" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">No. MCU Maritim</label>
                            <input type="text" class="form-control form-control-sm endis" id="mcu_maritime_number" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Expired MCU Maritim</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker" id="mcu_maritime_expiry" title="Expired MCU Maritim" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="mcu_maritime_expiry" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paspor & Berkas -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-passport mr-1"></i> Paspor & Berkas</div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">No. Paspor</label>
                            <input type="text" class="form-control form-control-sm endis" id="passport_number" placeholder="C XXXX XXXX" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Expired Paspor</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker" id="passport_expiry" title="Expired Paspor" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="passport_expiry" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
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

        <!-- ============================================================ -->
        <!-- TAB 5: STATUS & LAIN                                         -->
        <!-- ============================================================ -->
        <div class="tab-pane fade" id="pane-status" role="tabpanel">
            <div class="row">
                <!-- Status & Penempatan -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-ship mr-1"></i> Status & Penempatan</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="current_crew_status">
                            Status Crew
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <select class="form-control form-control-sm endis" id="current_crew_status" disabled>
                                    <option value="STANDBY">STANDBY</option>
                                    <option value="ON_BOARD">ON BOARD</option>
                                    <option value="OFF_SIGN">OFF SIGN</option>
                                    <option value="MEDICAL_LEAVE">MEDICAL LEAVE</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="sign_on_place">
                            Tempat Sign On
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="sign_on_place" title="Tempat Sign On" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="sign_on_date">
                            Tanggal Sign On
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker" id="sign_on_date" title="Tanggal Sign On" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="sign_on_date" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="sign_off_place">
                            Tempat Sign Off
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm endis" id="sign_off_place" title="Tempat Sign Off" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="sign_off_date">
                            Tanggal Sign Off
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control ummu-datepicker" id="sign_off_date" title="Tanggal Sign Off" placeholder="Pilih tanggal" readonly disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                        data-inputid="sign_off_date" disabled>
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perlengkapan & Catatan -->
                <div class="col-lg-6 col-sm-12">
                    <div class="section-title mb-3"><i class="fas fa-tshirt mr-1"></i> Perlengkapan & Catatan</div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="wearpack_size">
                            Ukuran Wearpack
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <select class="form-control form-control-sm endis" id="wearpack_size" disabled>
                                    <option value="">- Pilih -</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="XXXL">XXXL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="safety_shoes_size">
                            Ukuran Safety Shoes
                        </label>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <input type="number" min="30" max="50" class="form-control form-control-sm endis" id="safety_shoes_size" placeholder="cth: 42" title="Ukuran Safety Shoes" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 mb-0 pb-0 font-weight-bold small" for="remarks">
                            Catatan / Keterangan
                        </label>
                        <div class="col">
                            <textarea class="form-control form-control-sm endis" id="remarks" rows="3" placeholder="Catatan tambahan, mis. dokumen sedang proses perpanjangan..." disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /tab-content -->
</div>
<!-- /Form -->