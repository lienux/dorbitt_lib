<?= $headerPage; ?>
<div class="form-row">
<div class="form-group col-md-4">
  <label class="font-weight-bold">Kode Owner <span class="text-danger">*</span></label>
  <input type="text" class="form-control" placeholder="Contoh: OWN-001" required>
</div>
<div class="form-group col-md-8">
  <label class="font-weight-bold">Nama Perusahaan / Owner <span class="text-danger">*</span></label>
  <input type="text" class="form-control" placeholder="Masukkan nama resmi perusahaan" required>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
  <label class="font-weight-bold">Nama Person In Charge (PIC)</label>
  <input type="text" class="form-control" placeholder="Nama penanggung jawab">
</div>
<div class="form-group col-md-6">
  <label class="font-weight-bold">Status Kontak</label>
  <select class="form-control">
    <option value="Aktif">Aktif</option>
    <option value="Non-Aktif">Non-Aktif</option>
  </select>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
  <label class="font-weight-bold">No. Telepon <span class="text-danger">*</span></label>
  <input type="tel" class="form-control" placeholder="Nomor telepon kantor / HP" required>
</div>
<div class="form-group col-md-6">
  <label class="font-weight-bold">Email</label>
  <input type="email" class="form-control" placeholder="email@perusahaan.com">
</div>
</div>

<div class="form-group">
<label class="font-weight-bold">Alamat Perusahaan</label>
<textarea class="form-control" rows="3" placeholder="Alamat lengkap lokasi kantor..."></textarea>
</div>

