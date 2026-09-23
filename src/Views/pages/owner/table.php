<?= $headerPage; ?>

<!-- Cards List Data -->
<div class="card shadow-sm">
  <div class="card-header bg-white py-3">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h5 class="mb-0 font-weight-bold">Daftar Owner</h5>
      </div>
      <div class="col-md-6">
        <!-- Input Pencarian -->
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Cari nama owner atau kode...">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-striped mb-0">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="pl-4">Kode Owner</th>
            <th scope="col">Nama Perusahaan / Owner</th>
            <th scope="col">Kontak (PIC)</th>
            <th scope="col">Telepon / Email</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="pl-4 font-weight-bold text-secondary">OWN-001</td>
            <td>PT Samudera Bahari Utama</td>
            <td>Budi Santoso</td>
            <td>
              <div><i class="fas fa-phone-alt fa-xs mr-1 text-muted"></i> 021-5550192</div>
              <small class="text-muted"><i class="fas fa-envelope fa-xs mr-1"></i> info@samudera.co.id</small>
            </td>
            <td><span class="badge badge-success">Aktif</span></td>
            <td class="text-center">
              <button class="btn btn-sm btn-info mr-1" title="Edit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <td class="pl-4 font-weight-bold text-secondary">OWN-002</td>
            <td>Oceanic Trans Maritime Ltd</td>
            <td>John Doe</td>
            <td>
              <div><i class="fas fa-phone-alt fa-xs mr-1 text-muted"></i> +65 6789 0123</div>
              <small class="text-muted"><i class="fas fa-envelope fa-xs mr-1"></i> contact@oceanic.sg</small>
            </td>
            <td><span class="badge badge-success">Aktif</span></td>
            <td class="text-center">
              <button class="btn btn-sm btn-info mr-1" title="Edit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <td class="pl-4 font-weight-bold text-secondary">OWN-003</td>
            <td>CV Jaya Armada Laut</td>
            <td>Siti Rahma</td>
            <td>
              <div><i class="fas fa-phone-alt fa-xs mr-1 text-muted"></i> 031-8884321</div>
              <small class="text-muted"><i class="fas fa-envelope fa-xs mr-1"></i> siti@jayaarmada.com</small>
            </td>
            <td><span class="badge badge-secondary">Non-Aktif</span></td>
            <td class="text-center">
              <button class="btn btn-sm btn-info mr-1" title="Edit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  <!-- Footer Table / Pagination -->
  <div class="card-footer bg-white d-flex justify-content-between align-items-center">
    <small class="text-muted">Menampilkan 1 - 3 dari 3 data</small>
    <nav>
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
      </ul>
    </nav>
  </div>
</div>