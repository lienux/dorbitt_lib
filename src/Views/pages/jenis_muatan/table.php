<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <h6 class="font-weight-bold text-dark mb-0">Daftar Jenis Muatan</h6>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari kode atau nama muatan...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
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
                        <th scope="col" width="5%">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Muatan</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Sifat Kargo</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="12%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td>1</td>
                        <td><b class="text-primary">CTG-DRY-01</b></td>
                        <td>Batubara (Coal Bulk)</td>
                        <td>Dry Bulk</td>
                        <td>Ton</td>
                        <td><span class="badge badge-light border">Non-Hazardous</span></td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr>
                        <td>2</td>
                        <td><b class="text-primary">CTG-LIQ-02</b></td>
                        <td>CPO (Crude Palm Oil)</td>
                        <td>Liquid Bulk</td>
                        <td>Ton</td>
                        <td><span class="badge badge-light border">Non-Hazardous</span></td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr>
                        <td>3</td>
                        <td><b class="text-primary">CTG-DG-01</b></td>
                        <td>BBM Premium / Solar</td>
                        <td>Dangerous Goods</td>
                        <td>Liter</td>
                        <td><span class="badge badge-warning text-dark"><i class="fas fa-exclamation-triangle mr-1"></i>Hazardous Class 3</span></td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr>
                        <td>4</td>
                        <td><b class="text-primary">CTG-CNT-20</b></td>
                        <td>Container 20ft (Dry Box)</td>
                        <td>Containerized</td>
                        <td>TEU</td>
                        <td><span class="badge badge-light border">Non-Hazardous</span></td>
                        <td><span class="badge badge-secondary">Nonaktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="card-footer bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-6 text-muted small">
                Menampilkan 1 - 4 dari 4 data
            </div>
            <div class="col-md-6">
                <ul class="pagination pagination-sm justify-content-md-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Selanjutnya</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>