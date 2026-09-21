<!-- Form -->
            
<!-- Judul Modul & Tombol Toggle -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4z">
    <div>
        <h2 class="h4 font-weight-bold text-dark">Modul Timesheet (Daily Noon Report)</h2>
        <p class="text-muted small mb-0">Kelola dan pantau catatan waktu, bahan bakar, dan aktivitas harian kapal.</p>
    </div>
    <!-- <button class="btn btn-primary mt-3 mt-md-0 shadow-sm" type="button" data-toggle="collapse" data-target="#formTimesheetCard" aria-expanded="true" aria-controls="formTimesheetCard">
        <i class="fa-solid fa-plus mr-1"></i> Toggle Form Input
    </button> -->
</div>

<!-- SECTION: Form Input Timesheet (Collapsible) -->
<!-- <div class="collapse show mb-5" id="formTimesheetCard"> -->
    <!-- <div class="card shadow-sm border-0"> -->
        <div class="card-header bg-secondaryz d-flex justify-content-between align-items-center py-3z">
            <h5 class="mb-0 text-dark font-weight-bold">
                <i class="fa-solid fa-file-pen text-primary mr-2"></i> Form Input Data Timesheet
            </h5>
            <span class="badge badge-warning p-2">Voyage: VYG-2026-09A (MV Nusantara Indah)</span>
        </div>
        <div class="card-body">
            <form>
                <!-- Row 1 -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Tanggal & Jam (UTC)</label>
                        <input type="datetime-local" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Status Aktivitas Kapal</label>
                        <select class="form-control form-control-sm">
                            <option>Steaming (Berlayar)</option>
                            <option>At Anchor (Berlabuh Jangkar)</option>
                            <option>Loading (Muat Barang)</option>
                            <option>Discharging (Bongkar Muat)</option>
                            <option>Bunkering (Pengisian Bahan Bakar)</option>
                            <option>Waiting / Drift</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Posisi (Lat / Long)</label>
                        <input type="text" placeholder="Contoh: 05°12'S 106°45'E" class="form-control form-control-sm">
                    </div>
                </div>

                <!-- Blok Konsumsi Bahan Bakar (Bunker) -->
                <div class="card bg-light border mb-3 p-3">
                    <h6 class="font-weight-bold text-dark small mb-3">
                        <i class="fa-solid fa-gas-pump text-primary mr-1"></i> Konsumsi Bahan Bakar (MT)
                    </h6>
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-2">
                            <label class="small text-muted">FO (Fuel Oil) Consumed</label>
                            <input type="number" step="0.1" placeholder="0.0" class="form-control form-control-sm bg-white">
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label class="small text-muted">MGO (Marine Gas Oil) Consumed</label>
                            <input type="number" step="0.1" placeholder="0.0" class="form-control form-control-sm bg-white">
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label class="small text-muted">Fresh Water Remaining (MT)</label>
                            <input type="number" step="0.1" placeholder="0.0" class="form-control form-control-sm bg-white">
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Kondisi Cuaca / Angin</label>
                        <input type="text" placeholder="Contoh: Beaufort Scale 4, Berawan" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Kecepatan Rata-rata (Knots)</label>
                        <input type="number" step="0.1" placeholder="12.5" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small text-secondary">Jarak Tempuh Harian (NM)</label>
                        <input type="number" step="0.1" placeholder="280.5" class="form-control form-control-sm">
                    </div>
                </div>

                <!-- Keterangan / Remarks -->
                <div class="form-group">
                    <label class="font-weight-bold small text-secondary">Catatan / Remarks</label>
                    <textarea rows="2" placeholder="Tambahkan catatan pelayaran atau kendala mesin jika ada..." class="form-control form-control-sm"></textarea>
                </div>

                <!-- Tombol Aksi Form -->
                <!-- <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline-secondary btn-sm mr-2 px-3">Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Laporan</button>
                </div> -->
            </form>
        </div>
    <!-- </div> -->
<!-- </div> -->

<!-- SECTION: List Data Timesheet (Tabel) -->



<div id="form_input"> 
    <div class="row">
        
    </div>
</div>