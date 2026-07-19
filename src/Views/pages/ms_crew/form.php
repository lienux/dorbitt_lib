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
        color: #495057;
        background-color: #e9ecef;
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

<div class="mt-2">
    <div class="alert text-light collapse" id="alert_input"></div>

    <!-- SB Button -->
    <?=$this->include(config('Ummu')->Views('partials/sb_button'))?>

    <!-- Form -->
    <div id="form_input"> 
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <!-- BLOCK 1: PERSONAL -->
                    <div class="section-title mb-3"><i class="fas fa-user mr-1"></i> Data Personal</div>
                    <div class="form-group">
                        <label class="font-weight-bold small">Nama Lengkap (Sesuai Buku Pelaut) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="full_name" placeholder="Contoh: Capt. Ahmad Subarjo" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm" name="birth_place">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="birth_date" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label class="font-weight-bold small">No. Handphone (WhatsApp) <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-sm" name="phone_number" placeholder="0812xxxxxxxx" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="font-weight-bold small">Golongan Darah</label>
                            <select class="form-control form-control-sm" name="blood_type">
                                <option value="">- Pilih -</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>

                    <!-- BLOCK 2: KEPEGAWAIAN MARITIM -->
                    <div class="section-title mb-3 mt-4"><i class="fas fa-anchor mr-1"></i> Kompetensi & Jabatan</div>
                    <div class="form-group">
                        <label class="font-weight-bold small">Jabatan Utama (Base Rank) <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm font-weight-bold border-info text-info" name="base_rank_id" required>
                            <option value="">-- Pilih Jabatan Master --</option>
                            <option value="1">Master / Captain (Nakhoda)</option>
                            <option value="2">Chief Officer (Mualim I)</option>
                            <option value="3">Second Officer (Mualim II)</option>
                            <option value="9">Chief Engineer (KKM)</option>
                            <option value="10">Masinis I (First Engineer)</option>
                            <option value="6">Able Bodied Seaman (Juru Mudi)</option>
                            <option value="14">Oiler (Juru Minyak)</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Kualifikasi Ijazah (COC)</label>
                            <select class="form-control form-control-sm" name="highest_coc_certificate">
                                <option value="">- Pilih Kualifikasi -</option>
                                <option value="ANT-III">ANT-III</option>
                                <option value="ANT-IV">ANT-IV</option>
                                <option value="ANT-V">ANT-V</option>
                                <option value="ATT-III">ATT-III</option>
                                <option value="ATT-IV">ATT-IV</option>
                                <option value="RATING">RATING (Asisten)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Status Hubungan Kerja</label>
                            <select class="form-control form-control-sm" name="employment_status">
                                <option value="CONTRACT">Kontrak (PKL)</option>
                                <option value="PERMANENT">Karyawan Tetap</option>
                                <option value="DAILY">Harian Lepas</option>
                            </select>
                        </div>
                    </div>

                    
                </form>
            </div>

            <div class="col-lg-6 col-sm-12">
                <!-- BLOCK 3: LEGALITAS DOKUMEN -->
                <div class="section-title mb-3 mt-4z"><i class="fas fa-file-contract mr-1"></i> Dokumen & Masa Berlaku</div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold small">No. Buku Pelaut <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="seaman_book_number" placeholder="E-XXXXXX" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold small text-danger">Expired Buku Pelaut <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm border-danger" name="seaman_book_expiry" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold small">No. MCU Maritim</label>
                        <input type="text" class="form-control form-control-sm" name="mcu_maritime_number">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold small">Expired MCU Maritim</label>
                        <input type="date" class="form-control form-control-sm" name="mcu_maritime_expiry">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Upload Berkas Gabungan (CV & Dokumen) <span class="text-muted">(PDF Max 5MB)</span></label>
                    <div class="custom-file custom-file-sm">
                        <input type="file" class="custom-file-input" id="customFile" name="crew_document_pdf" accept=".pdf">
                        <label class="custom-file-label" for="customFile">Pilih Berkas PDF...</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
