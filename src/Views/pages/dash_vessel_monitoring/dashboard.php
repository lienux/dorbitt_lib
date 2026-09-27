<link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">

<style>
    :root {
        --primary-navy: #0a2647;
        --primary-blue: #144272;
        --accent-cyan: #2c74b3;
        --accent-light: #205295;
    }
    
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, sans-serif;
        font-size: 0.9rem;
    }
    
    .navbar-erp {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    
    .navbar-erp .navbar-brand {
        font-weight: 700;
        color: #fff;
        letter-spacing: 0.5px;
    }
    
    .sidebar {
        background: #fff;
        min-height: calc(100vh - 56px);
        box-shadow: 2px 0 8px rgba(0,0,0,0.05);
        padding-top: 1rem;
    }
    
    .sidebar .nav-link {
        color: #495057;
        padding: 0.65rem 1rem;
        border-radius: 6px;
        margin: 0 0.5rem 0.25rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s;
    }
    
    .sidebar .nav-link:hover {
        background-color: #eef4fb;
        color: var(--primary-blue);
    }
    
    .sidebar .nav-link.active {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-cyan));
        color: #fff;
        box-shadow: 0 3px 8px rgba(20,66,114,0.3);
    }
    
    .page-header {
        background: #fff;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        margin-bottom: 1.25rem;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        border-left: 4px solid var(--accent-cyan);
        transition: transform 0.2s;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    }
    
    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
    }
    
    .stat-card .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-navy);
        line-height: 1.1;
    }
    
    .stat-card .stat-label {
        font-size: 0.78rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .card-modern {
        background: #fff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }
    
    .card-modern .card-header {
        background: #fff;
        border-bottom: 1px solid #eef0f3;
        padding: 0.9rem 1.25rem;
        font-weight: 600;
        color: var(--primary-navy);
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 10px 10px 0 0 !important;
    }
    
    #map {
        height: 480px;
        border-radius: 0 0 10px 10px;
    }
    
    .vessel-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f3f6;
        cursor: pointer;
        transition: background 0.15s;
    }
    
    .vessel-item:hover {
        background-color: #f8fafc;
    }
    
    .vessel-item.active {
        background-color: #eef4fb;
        border-left: 3px solid var(--accent-cyan);
    }
    
    .vessel-avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
    
    .status-sailing { background-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.2); }
    .status-anchored { background-color: #ffc107; box-shadow: 0 0 0 3px rgba(255,193,7,0.2); }
    .status-offline { background-color: #dc3545; box-shadow: 0 0 0 3px rgba(220,53,69,0.2); }
    .status-idle { background-color: #6c757d; box-shadow: 0 0 0 3px rgba(108,117,125,0.2); }
    
    .table-modern th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        font-weight: 600;
        border-bottom: 2px solid #eef0f3;
        background-color: #f8fafc;
    }
    
    .table-modern td {
        vertical-align: middle;
        font-size: 0.85rem;
        border-color: #f1f3f6;
    }
    
    .badge-soft-success { background-color: #d4edda; color: #155724; }
    .badge-soft-warning { background-color: #fff3cd; color: #856404; }
    .badge-soft-danger  { background-color: #f8d7da; color: #721c24; }
    .badge-soft-secondary { background-color: #e2e3e5; color: #383d41; }
    .badge-soft-info { background-color: #d1ecf1; color: #0c5460; }
    
    .filter-bar {
        background: #fff;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        margin-bottom: 1.25rem;
    }
    
    .timeline {
        position: relative;
        padding-left: 20px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 6px;
        top: 5px;
        bottom: 5px;
        width: 2px;
        background: #e2e8f0;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1rem;
        font-size: 0.82rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--accent-cyan);
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px var(--accent-cyan);
    }
    
    /* Badge notif untuk BS4 (pengganti .position-absolute .translate-middle) */
    .notif-badge {
        position: absolute;
        top: -4px;
        right: -8px;
        font-size: 0.6rem;
        padding: 2px 5px;
    }
    
    /* View toggle button untuk BS4 (pengganti btn-check) */
    .view-toggle .btn.active {
        background-color: var(--primary-blue);
        color: #fff;
        border-color: var(--primary-blue);
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div class="mb-2 mb-md-0">
        <h5 class="mb-1 font-weight-bold" style="color:var(--primary-navy);">
            <i class="bi bi-geo-alt mr-2"></i>Real-Time Vessel Monitoring
        </h5>
        <small class="text-muted">Pelacakan posisi, status, dan aktivitas kapal secara langsung</small>
    </div>
    <div class="d-flex">
        <button class="btn btn-sm btn-outline-secondary mr-2">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        <button class="btn btn-sm btn-primary" style="background:var(--primary-blue);border:none;">
            <i class="bi bi-download"></i> Export
        </button>
    </div>
</div>

<!-- STAT CARDS -->
<div class="row mb-3">
    <div class="col-6 col-md-3 mb-3 mb-md-0">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label mb-1">Total Kapal</div>
                    <div class="stat-value">48</div>
                </div>
                <div class="stat-icon" style="background:linear-gradient(135deg,#144272,#2c74b3);">
                    <i class="bi bi-ship"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3 mb-md-0">
        <div class="stat-card" style="border-left-color:#28a745;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label mb-1">Sedang Berlayar</div>
                    <div class="stat-value text-success">32</div>
                </div>
                <div class="stat-icon" style="background:linear-gradient(135deg,#1e7e34,#28a745);">
                    <i class="bi bi-arrow-right-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3 mb-md-0">
        <div class="stat-card" style="border-left-color:#ffc107;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label mb-1">Berlabuh</div>
                    <div class="stat-value text-warning">11</div>
                </div>
                <div class="stat-icon" style="background:linear-gradient(135deg,#d39e00,#ffc107);">
                    <i class="bi bi-anchor"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="border-left-color:#dc3545;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label mb-1">Offline / Alarm</div>
                    <div class="stat-value text-danger">5</div>
                </div>
                <div class="stat-icon" style="background:linear-gradient(135deg,#bd2130,#dc3545);">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
    <div class="row align-items-center">
        <div class="col-md-3 mb-2 mb-md-0">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="bi bi-search"></i></span>
                </div>
                <input type="text" class="form-control border-left-0" placeholder="Cari nama / IMO kapal...">
            </div>
        </div>
        <div class="col-md-2 mb-2 mb-md-0">
            <select class="form-control form-control-sm">
                <option value="">Semua Status</option>
                <option>Berlayar</option>
                <option>Berlabuh</option>
                <option>Idle</option>
                <option>Offline</option>
            </select>
        </div>
        <div class="col-md-2 mb-2 mb-md-0">
            <select class="form-control form-control-sm">
                <option value="">Semua Tipe</option>
                <option>Tug Boat</option>
                <option>Barge</option>
                <option>Cargo Ship</option>
                <option>Ferry</option>
            </select>
        </div>
        <div class="col-md-2 mb-2 mb-md-0">
            <select class="form-control form-control-sm">
                <option value="">Semua Area</option>
                <option>Perairan Jawa</option>
                <option>Perairan Sumatera</option>
                <option>Perairan Kalimantan</option>
            </select>
        </div>
        <div class="col-md-3 text-md-right">
            <div class="btn-group btn-group-sm view-toggle" role="group">
                <button type="button" class="btn btn-outline-primary active" data-view="map">
                    <i class="bi bi-map"></i> Peta
                </button>
                <button type="button" class="btn btn-outline-primary" data-view="list">
                    <i class="bi bi-list-ul"></i> Tabel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MAIN ROW: MAP + VESSEL LIST -->
<div class="row mb-3">
    <div class="col-lg-8 mb-3 mb-lg-0">
        <div class="card card-modern h-100">
            <div class="card-header">
                <span><i class="bi bi-map mr-2"></i>Peta Pelacakan</span>
                <div class="d-flex" style="font-size:0.75rem;font-weight:500;">
                    <span class="mr-3"><span class="status-dot status-sailing"></span>Berlayar</span>
                    <span class="mr-3"><span class="status-dot status-anchored"></span>Berlabuh</span>
                    <span class="mr-3"><span class="status-dot status-idle"></span>Idle</span>
                    <span><span class="status-dot status-offline"></span>Offline</span>
                </div>
            </div>
            <div id="map"></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-modern h-100">
            <div class="card-header">
                <span><i class="bi bi-list-ul mr-2"></i>Daftar Kapal</span>
                <span class="badge badge-primary badge-pill">48</span>
            </div>
            <div style="max-height:480px;overflow-y:auto;">
                
                <!-- Vessel Item 1 -->
                <div class="vessel-item active">
                    <div class="vessel-avatar"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Samudra Jaya</div>
                            <span class="badge badge-soft-success" style="font-size:0.65rem;"><span class="status-dot status-sailing"></span>Berlayar</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9234567 • Tug Boat
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 6.12°S, 106.85°E
                            • <i class="bi bi-speedometer"></i> 8.5 kn
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 2 -->
                <div class="vessel-item">
                    <div class="vessel-avatar" style="background:linear-gradient(135deg,#d39e00,#ffc107);"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Bahari Nusantara</div>
                            <span class="badge badge-soft-warning" style="font-size:0.65rem;"><span class="status-dot status-anchored"></span>Berlabuh</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9345678 • Barge
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 7.20°S, 112.73°E
                            • <i class="bi bi-speedometer"></i> 0.0 kn
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 3 -->
                <div class="vessel-item">
                    <div class="vessel-avatar"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Pelangi Laut</div>
                            <span class="badge badge-soft-success" style="font-size:0.65rem;"><span class="status-dot status-sailing"></span>Berlayar</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9456789 • Cargo Ship
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 3.45°S, 114.60°E
                            • <i class="bi bi-speedometer"></i> 12.3 kn
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 4 -->
                <div class="vessel-item">
                    <div class="vessel-avatar" style="background:linear-gradient(135deg,#6c757d,#adb5bd);"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Marina Indah</div>
                            <span class="badge badge-soft-secondary" style="font-size:0.65rem;"><span class="status-dot status-idle"></span>Idle</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9567890 • Ferry
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 8.65°S, 115.21°E
                            • <i class="bi bi-speedometer"></i> 0.0 kn
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 5 -->
                <div class="vessel-item">
                    <div class="vessel-avatar" style="background:linear-gradient(135deg,#bd2130,#dc3545);"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Sinar Abadi</div>
                            <span class="badge badge-soft-danger" style="font-size:0.65rem;"><span class="status-dot status-offline"></span>Offline</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9678901 • Tug Boat
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-secondary"></i> Last: 5.10°S, 119.42°E
                            • <i class="bi bi-clock"></i> 2 jam lalu
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 6 -->
                <div class="vessel-item">
                    <div class="vessel-avatar"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Nusa Bhakti</div>
                            <span class="badge badge-soft-success" style="font-size:0.65rem;"><span class="status-dot status-sailing"></span>Berlayar</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9789012 • Cargo Ship
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 1.85°N, 101.30°E
                            • <i class="bi bi-speedometer"></i> 10.7 kn
                        </div>
                    </div>
                </div>
                
                <!-- Vessel Item 7 -->
                <div class="vessel-item">
                    <div class="vessel-avatar"><i class="bi bi-ship"></i></div>
                    <div class="ml-3 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-weight-bold" style="font-size:0.85rem;">KM Khatulistiwa</div>
                            <span class="badge badge-soft-success" style="font-size:0.65rem;"><span class="status-dot status-sailing"></span>Berlayar</span>
                        </div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            IMO: 9890123 • Barge
                        </div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            <i class="bi bi-geo-alt-fill text-primary"></i> 0.52°S, 117.15°E
                            • <i class="bi bi-speedometer"></i> 6.2 kn
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM ROW: DETAIL TABLE + TIMELINE -->
<div class="row">
    <div class="col-lg-8 mb-3 mb-lg-0">
        <div class="card card-modern">
            <div class="card-header">
                <span><i class="bi bi-table mr-2"></i>Detail Monitoring Kapal</span>
                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-funnel"></i> Filter Lanjutan</button>
            </div>
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Nama Kapal</th>
                            <th>IMO</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Kecepatan</th>
                            <th>Posisi</th>
                            <th>ETA</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">KM Samudra Jaya</td>
                            <td>9234567</td>
                            <td>Tug Boat</td>
                            <td><span class="badge badge-soft-success"><span class="status-dot status-sailing"></span>Berlayar</span></td>
                            <td>8.5 kn</td>
                            <td>6.12°S, 106.85°E</td>
                            <td>14:30 WIB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2" title="Lihat"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary py-0 px-2" title="Riwayat"><i class="bi bi-clock-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">KM Bahari Nusantara</td>
                            <td>9345678</td>
                            <td>Barge</td>
                            <td><span class="badge badge-soft-warning"><span class="status-dot status-anchored"></span>Berlabuh</span></td>
                            <td>0.0 kn</td>
                            <td>7.20°S, 112.73°E</td>
                            <td>—</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary py-0 px-2"><i class="bi bi-clock-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">KM Pelangi Laut</td>
                            <td>9456789</td>
                            <td>Cargo Ship</td>
                            <td><span class="badge badge-soft-success"><span class="status-dot status-sailing"></span>Berlayar</span></td>
                            <td>12.3 kn</td>
                            <td>3.45°S, 114.60°E</td>
                            <td>16:45 WIB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary py-0 px-2"><i class="bi bi-clock-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">KM Marina Indah</td>
                            <td>9567890</td>
                            <td>Ferry</td>
                            <td><span class="badge badge-soft-secondary"><span class="status-dot status-idle"></span>Idle</span></td>
                            <td>0.0 kn</td>
                            <td>8.65°S, 115.21°E</td>
                            <td>—</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary py-0 px-2"><i class="bi bi-clock-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">KM Sinar Abadi</td>
                            <td>9678901</td>
                            <td>Tug Boat</td>
                            <td><span class="badge badge-soft-danger"><span class="status-dot status-offline"></span>Offline</span></td>
                            <td>—</td>
                            <td>Last: 5.10°S, 119.42°E</td>
                            <td>—</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary py-0 px-2"><i class="bi bi-clock-history"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- TIMELINE AKTIVITAS -->
    <div class="col-lg-4">
        <div class="card card-modern h-100">
            <div class="card-header">
                <span><i class="bi bi-activity mr-2"></i>Aktivitas Terbaru</span>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="font-weight-bold">KM Samudra Jaya berlayar</div>
                        <div class="text-muted">Mulai perjalanan dari Pelabuhan Tanjung Priok</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 5 menit lalu</div>
                    </div>
                    <div class="timeline-item">
                        <div class="font-weight-bold">KM Bahari Nusantara berlabuh</div>
                        <div class="text-muted">Berlabuh di Pelabuhan Tanjung Perak</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 22 menit lalu</div>
                    </div>
                    <div class="timeline-item">
                        <div class="font-weight-bold text-danger">Alarm: KM Sinar Abadi</div>
                        <div class="text-muted">Kehilangan sinyal GPS &gt; 2 jam</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 1 jam lalu</div>
                    </div>
                    <div class="timeline-item">
                        <div class="font-weight-bold">KM Pelangi Laut update posisi</div>
                        <div class="text-muted">Posisi terbaru: 3.45°S, 114.60°E</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 1 jam lalu</div>
                    </div>
                    <div class="timeline-item">
                        <div class="font-weight-bold">KM Nusa Bhakti berlayar</div>
                        <div class="text-muted">Menuju Pelabuhan Belawan</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 2 jam lalu</div>
                    </div>
                    <div class="timeline-item">
                        <div class="font-weight-bold">KM Khatulistiwa update posisi</div>
                        <div class="text-muted">Posisi terbaru: 0.52°S, 117.15°E</div>
                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-clock"></i> 3 jam lalu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

<!-- Bootstrap 4 JS (butuh jQuery + Popper) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Leaflet Map JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // ==========================
    // PETA LEAFLET
    // ==========================
    const map = L.map('map').setView([-2.5, 118.0], 5);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);
    
    function createIcon(color) {
        return L.divIcon({
            className: 'custom-marker',
            html: `<div style="
                width: 24px; height: 24px;
                background: ${color};
                border-radius: 50%;
                border: 3px solid #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.35);
                display: flex; align-items: center; justify-content: center;
                color: #fff; font-size: 11px;
            "><i class="bi bi-ship"></i></div>`,
            iconSize: [24, 24],
            iconAnchor: [12, 12],
            popupAnchor: [0, -12]
        });
    }
    
    const icons = {
        sailing: createIcon('#28a745'),
        anchored: createIcon('#ffc107'),
        idle: createIcon('#6c757d'),
        offline: createIcon('#dc3545')
    };
    
    const vessels = [
        { name: 'KM Samudra Jaya', imo: '9234567', type: 'Tug Boat', status: 'sailing', statusText: 'Berlayar', lat: -6.12, lng: 106.85, speed: '8.5 kn', dest: 'Pelabuhan Tanjung Priok' },
        { name: 'KM Bahari Nusantara', imo: '9345678', type: 'Barge', status: 'anchored', statusText: 'Berlabuh', lat: -7.20, lng: 112.73, speed: '0.0 kn', dest: 'Tanjung Perak' },
        { name: 'KM Pelangi Laut', imo: '9456789', type: 'Cargo Ship', status: 'sailing', statusText: 'Berlayar', lat: -3.45, lng: 114.60, speed: '12.3 kn', dest: 'Pelabuhan Banjarmasin' },
        { name: 'KM Marina Indah', imo: '9567890', type: 'Ferry', status: 'idle', statusText: 'Idle', lat: -8.65, lng: 115.21, speed: '0.0 kn', dest: 'Pelabuhan Benoa' },
        { name: 'KM Sinar Abadi', imo: '9678901', type: 'Tug Boat', status: 'offline', statusText: 'Offline', lat: -5.10, lng: 119.42, speed: '—', dest: 'Tidak diketahui' },
        { name: 'KM Nusa Bhakti', imo: '9789012', type: 'Cargo Ship', status: 'sailing', statusText: 'Berlayar', lat: 1.85, lng: 101.30, speed: '10.7 kn', dest: 'Pelabuhan Belawan' },
        { name: 'KM Khatulistiwa', imo: '9890123', type: 'Barge', status: 'sailing', statusText: 'Berlayar', lat: -0.52, lng: 117.15, speed: '6.2 kn', dest: 'Pelabuhan Samarinda' }
    ];
    
    vessels.forEach(v => {
        const marker = L.marker([v.lat, v.lng], { icon: icons[v.status] }).addTo(map);
        marker.bindPopup(`
            <div style="min-width:200px;">
                <div style="font-weight:700;color:#0a2647;margin-bottom:4px;">${v.name}</div>
                <div style="font-size:0.8rem;color:#6c757d;">IMO: ${v.imo} • ${v.type}</div>
                <hr style="margin:6px 0;">
                <div style="font-size:0.8rem;">
                    <div><strong>Status:</strong> ${v.statusText}</div>
                    <div><strong>Kecepatan:</strong> ${v.speed}</div>
                    <div><strong>Tujuan:</strong> ${v.dest}</div>
                    <div><strong>Koordinat:</strong> ${v.lat}°, ${v.lng}°</div>
                </div>
            </div>
        `);
    });
    
    // ==========================
    // Klik item vessel -> fokus ke peta
    // ==========================
    document.querySelectorAll('.vessel-item').forEach((item, index) => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.vessel-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');
            
            const v = vessels[index];
            if (v) {
                map.setView([v.lat, v.lng], 8);
                map.eachLayer(layer => {
                    if (layer instanceof L.Marker) {
                        const latlng = layer.getLatLng();
                        if (Math.abs(latlng.lat - v.lat) < 0.001 && Math.abs(latlng.lng - v.lng) < 0.001) {
                            layer.openPopup();
                        }
                    }
                });
            }
        });
    });
    
    // ==========================
    // View toggle (Peta / Tabel) - pengganti btn-check BS5
    // ==========================
    document.querySelectorAll('.view-toggle .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-toggle .btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const view = this.dataset.view;
            console.log('View mode:', view);
            // Implementasi toggle view (sembunyikan map / tampilkan tabel dsb)
        });
    });
</script>