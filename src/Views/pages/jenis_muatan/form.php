<!-- <h5 class="card-title font-weight-bold text-primary mb-2">
    <i class="fas fa-edit mr-1"></i> Form Input Jenis Muatan
</h5> -->

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="kodeMuatan" class="font-weight-bold">Kode Muatan <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="kodeMuatan" placeholder="Contoh: CTG-DRY-01" required>
    </div>
    <div class="form-group col-md-5">
        <label for="namaMuatan" class="font-weight-bold">Nama Jenis Muatan <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="namaMuatan" placeholder="Contoh: Batubara / CPO / Container 20ft" required>
    </div>
    <div class="form-group col-md-4">
        <label for="kategoriStandar" class="font-weight-bold">Kategori Standar <span class="text-danger">*</span></label>
        <select class="form-control" id="kategoriStandar" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Dry Bulk">Dry Bulk (Curah Kering)</option>
            <option value="Liquid Bulk">Liquid Bulk (Curah Cair)</option>
            <option value="Containerized">Containerized Cargo</option>
            <option value="General Cargo">General / Breakbulk Cargo</option>
            <option value="Dangerous Goods">Dangerous Goods (DG)</option>
            <option value="Ro-Ro">Ro-Ro Cargo</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="satuanKapasitas" class="font-weight-bold">Satuan Ukur Default</label>
        <select class="form-control" id="satuanKapasitas">
            <option value="Ton">Ton (MT)</option>
            <option value="KG">Kilogram (KG)</option>
            <option value="Liter">Liter (L) / KL</option>
            <option value="TEU">TEU (Container)</option>
            <option value="Unit">Unit (Vehicles)</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="sifatKargo" class="font-weight-bold">Sifat Kargo</label>
        <select class="form-control" id="sifatKargo">
            <option value="Non-Hazardous">Non-Hazardous (Aman)</option>
            <option value="Hazardous">Hazardous / Berbahaya (IMO)</option>
            <option value="Perishable">Perishable (Mudah Rusak/Dingin)</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="stowageFactor" class="font-weight-bold">Stowage Factor (m³/MT)</label>
        <input type="number" step="0.01" class="form-control" id="stowageFactor" placeholder="Opsional">
    </div>
    <div class="form-group col-md-3">
        <label for="statusData" class="font-weight-bold">Status</label>
        <select class="form-control" id="statusData">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="keterangan" class="font-weight-bold">Keterangan / Penanganan Khusus</label>
    <textarea class="form-control" id="keterangan" rows="2" placeholder="Catatan instruksi penanganan atau deskripsi muatan..."></textarea>
</div>

<!-- Modal Hapus Data -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-1"></i> Konfirmasi Hapus</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data jenis muatan ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>