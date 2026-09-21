<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <h5 class="mb-3 mb-md-0 text-dark font-weight-bold">
            <i class="fa-solid fa-table-list text-primary mr-2"></i> Riwayat Timesheet Voyage
        </h5>
        
        <!-- Search & Filter Bar -->
        <div class="d-flex align-items-center w-100 w-md-auto">
            <div class="input-group input-group-sm mr-2" style="width: 220px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-search text-muted"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari tanggal/status...">
            </div>
            <button class="btn btn-outline-secondary btn-sm text-nowrap">
                <i class="fa-solid fa-filter mr-1"></i> Filter
            </button>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive mb-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="thead-light text-uppercase small">
                <tr>
                    <th class="py-3">No</th>
                    <th class="py-3">Tanggal (UTC)</th>
                    <th class="py-3">Aktivitas</th>
                    <th class="py-3">Posisi</th>
                    <th class="py-3">Speed / Dist</th>
                    <th class="py-3">FO / MGO (MT)</th>
                    <th class="py-3">Cuaca</th>
                    <th class="py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                <!-- Baris 1 -->
                <tr>
                    <td class="align-middle">1</td>
                    <td class="align-middle font-weight-bold text-dark">22 Sep 2026 - 12:00</td>
                    <td class="align-middle">
                        <span class="badge badge-success px-2 py-1">Steaming</span>
                        <small class="d-text text-muted d-block">En route to Singapore</small>
                    </td>
                    <td class="align-middle font-monospace">03°45'N 105°20'E</td>
                    <td class="align-middle">13.2 Kn / 295 NM</td>
                    <td class="align-middle">8.5 / 0.8</td>
                    <td class="align-middle">Moderate (SE 3)</td>
                    <td class="align-middle text-center">
                        <button class="btn btn-link btn-sm text-primary p-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-link btn-sm text-danger p-1" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <!-- Baris 2 -->
                <tr>
                    <td class="align-middle">2</td>
                    <td class="align-middle font-weight-bold text-dark">21 Sep 2026 - 12:00</td>
                    <td class="align-middle">
                        <span class="badge badge-success px-2 py-1">Steaming</span>
                        <small class="d-text text-muted d-block">Clear passage</small>
                    </td>
                    <td class="align-middle font-monospace">01°10'N 104°05'E</td>
                    <td class="align-middle">12.8 Kn / 310 NM</td>
                    <td class="align-middle">9.0 / 0.9</td>
                    <td class="align-middle">Good (Calm)</td>
                    <td class="align-middle text-center">
                        <button class="btn btn-link btn-sm text-primary p-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-link btn-sm text-danger p-1" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <!-- Baris 3 -->
                <tr>
                    <td class="align-middle">3</td>
                    <td class="align-middle font-weight-bold text-dark">20 Sep 2026 - 12:00</td>
                    <td class="align-middle">
                        <span class="badge badge-primary px-2 py-1">Loading</span>
                        <small class="d-text text-muted d-block">Tanjung Priok Port</small>
                    </td>
                    <td class="align-middle font-monospace">06°06'S 106°52'E</td>
                    <td class="align-middle">0.0 Kn / 0 NM</td>
                    <td class="align-middle">1.2 / 0.5</td>
                    <td class="align-middle">Sunny</td>
                    <td class="align-middle text-center">
                        <button class="btn btn-link btn-sm text-primary p-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-link btn-sm text-danger p-1" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <div class="card-footer bg-light d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
        <div class="mb-2 mb-md-0">Menampilkan <strong>1-3</strong> dari total <strong>14</strong> data</div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="tbSpal"
        width="100%" cellspacing="0">
        <thead class="bg-success text-light">
            <tr>
                <th rowspan="2"></th>
                <th rowspan="2">ID</th>
                <th rowspan="2">Shipment (SI)</th>
                <th rowspan="2">Tgl Surat</th>
                <th rowspan="2">Nomor Surat</th>
                <th rowspan="2">Biaya Angkut</th>
                <th rowspan="2">Kondisi Perjanjian</th>
                <th rowspan="2">Penyewa</th>
                <th rowspan="2">Tugboat</th>
                <th rowspan="2">Barge</th>
                <th rowspan="2">Jenis Muatan</th>
                <th rowspan="2">Volume Muatan</th>
                <th colspan="2">Date of Loading</th>
                <th colspan="2">Port of</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Loading</th>
                <th>Discharge</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>