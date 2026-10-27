<?php
    $pic_name  = $crew->pic_name ?? '';
    $pic_phone = $crew->pic_phone ?? '';
    $pic_email = $crew->pic_email ?? '';
    $client_name = $crew->client_name ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet Kapal - PIC / Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <style>
        body { background:#f4f6f9; font-size:14px; }
        .card { border-radius:.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08); }
        .card-header { background:#fff; border-bottom:2px solid #e9ecef; font-weight:600; }
        .ijo-badge {
            background: linear-gradient(135deg,#007bff,#0056b3);
            color:#fff; padding:.6rem 1rem; border-radius:.4rem;
            display:flex; align-items:center; justify-content:space-between;
            flex-wrap:wrap; gap:.75rem;
        }
        .ijo-badge .label { font-size:.75rem; opacity:.85; text-transform:uppercase; letter-spacing:.5px; }
        .ijo-badge .value { font-size:1.05rem; font-weight:700; }
        .vessel-info {
            background:#f8f9fa; border:1px solid #e9ecef; border-radius:.4rem;
            padding:.75rem 1rem; display:flex; gap:1.5rem; flex-wrap:wrap;
        }
        .vessel-info .item { display:flex; flex-direction:column; }
        .vessel-info .item .lbl { font-size:.7rem; color:#6c757d; text-transform:uppercase; letter-spacing:.4px; }
        .vessel-info .item .val { font-weight:600; color:#212529; font-size:.95rem; }
        .vessel-info .item .val i { color:#007bff; margin-right:.35rem; }
        .status-badge { font-size:.72rem; padding:.3rem .6rem; border-radius:.25rem; }
        .table thead th { background:#f8f9fa; font-size:.78rem; text-transform:uppercase; letter-spacing:.4px; color:#6c757d; border-top:none; }
        .required::after { content:" *"; color:#dc3545; }
        .form-section-title {
            font-size:.85rem; font-weight:600; color:#495057;
            text-transform:uppercase; letter-spacing:.5px;
            margin:1rem 0 .75rem; padding-bottom:.4rem; border-bottom:1px dashed #dee2e6;
        }
        .btn-xs { padding:.15rem .5rem; font-size:.72rem; line-height:1.3; border-radius:.2rem; }
        #coordStatus { display:block; margin-top:.25rem; }
        #coordStatus.success { color:#28a745 !important; }
        #coordStatus.error { color:#dc3545 !important; }
        .coord-box { background:#f8f9fa; border:1px dashed #ced4da; border-radius:.35rem; padding:.6rem .75rem; }
        .format-switch { display:inline-flex; background:#e9ecef; border-radius:.35rem; padding:2px; font-size:.72rem; }
        .format-switch button { border:none; background:transparent; color:#495057; padding:.2rem .55rem; border-radius:.25rem; font-weight:600; cursor:pointer; transition:all .15s; }
        .format-switch button.active { background:#007bff; color:#fff; box-shadow:0 1px 2px rgba(0,0,0,.15); }
        .coord-format-section { display:none; }
        .coord-format-section.active { display:block; }
        .dms-input { text-align:center; padding:.25rem .3rem; font-size:.8rem; }
        .dms-suffix { background:#e9ecef; font-size:.72rem; }
        .pic-info {
            display:inline-flex; align-items:center;
            background:#eaf7ee; color:#155724;
            font-size:.72rem; padding:.15rem .5rem;
            border-radius:.25rem; border:1px solid #c3e6cb;
        }
        .pic-info i { margin-right:.3rem; color:#28a745; }
        .pic-info strong { color:#155724; margin-left:.15rem; }
        #waPreview { font-family:'Segoe UI',Tahoma,sans-serif; line-height:1.6; color:#1a1a1a; resize:none; }
        .btn-wa { background:#25D366; border-color:#25D366; color:#fff; }
        .btn-wa:hover { background:#1da851; border-color:#1da851; color:#fff; }
        .eta-box { background:#fff8e1; border:1px dashed #ffc107; border-radius:.35rem; padding:.5rem .75rem; }
        .eta-box .eta-label { font-size:.72rem; color:#856404; text-transform:uppercase; letter-spacing:.4px; font-weight:600; }
        #timesheetList td { vertical-align: middle; word-wrap: break-word; min-width: 80px; }

        /* SIDE PANEL MODAL */
        .modal.right .modal-dialog {
            position: fixed; margin: auto; width: 520px; max-width: 100%;
            height: 100%; right: 0; top: 0; bottom: 0;
            transform: translate3d(100%, 0, 0);
            transition: transform 0.3s ease-out;
            display: flex; flex-direction: column;
        }
        .modal.right.show .modal-dialog { transform: translate3d(0, 0, 0); }
        .modal.right .modal-content { height: 100%; border-radius: 0; border: none; overflow-y: hidden; }
        .modal.right .modal-body { overflow-y: auto; }
        .modal.right.fade .modal-dialog { transition: transform 0.3s ease-out; }
        .modal.right.fade.show .modal-dialog { transform: translate3d(0, 0, 0); }
        @media (max-width: 576px) { .modal.right .modal-dialog { width: 100%; } }

        /* Select2 */
        .select2-container--default .select2-selection--single {
            height: calc(1.5em + .5rem + 2px) !important;
            padding: .25rem .5rem !important;
            border: 1px solid #ced4da !important;
            border-radius: .2rem !important;
            background-color: #fff;
            display: flex; align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057 !important; padding-left: 0 !important; line-height: normal !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important; top: 0 !important; right: 5px !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #80bdff !important;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25) !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important; color: white !important;
        }

        /* IJO Selector */
        .ijo-selector-card {
            background: #fff; border: 2px solid #007bff;
            border-radius: .5rem; padding: 1rem;
            box-shadow: 0 2px 8px rgba(0,123,255,.15);
        }
        .ijo-selector-card label { font-weight: 700; color: #007bff; font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; }

        .filter-toolbar {
            background:#f8f9fa; border-radius:.35rem;
            padding:.5rem .75rem; display:flex; flex-wrap:wrap; gap:.5rem; align-items:center;
        }
        .filter-toolbar .form-control-sm { max-width: 200px; }

        /* Pagination */
        .pagination { margin-bottom: 0; display: flex; padding-left: 0; list-style: none; border-radius: .25rem; }
        .pagination li { display: inline-block; margin: 0 2px; }
        .pagination li a, .pagination li span {
            position: relative; display: block; padding: .35rem .65rem; margin-left: -1px;
            line-height: 1.25; color: #007bff !important; background-color: #fff !important;
            border: 1px solid #dee2e6 !important; border-radius: .2rem;
            font-size: 0.85rem; text-decoration: none;
        }
        .pagination li a:hover { z-index:2; color:#0056b3!important; background-color:#e9ecef!important; border-color:#dee2e6!important; }
        .pagination li.active a, .pagination li.active span { z-index:3; color:#fff!important; background-color:#007bff!important; border-color:#007bff!important; }
        .pagination li.disabled a, .pagination li.disabled span { color:#6c757d!important; pointer-events:none; background-color:#fff!important; border-color:#dee2e6!important; }

        /* IJO search hint */
        .ijo-meta-badges { display:flex; gap:.35rem; flex-wrap:wrap; margin-top:.35rem; }
        .ijo-meta-badges .badge { font-size:.68rem; padding:.25rem .5rem; font-weight:500; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h4 class="mb-0"><i class="fas fa-user-shield text-primary mr-2"></i>Timesheet Kapal — PIC / Admin</h4>
                <small class="text-muted">Kelola timesheet crew kapal per IJO / Shipping</small>
            </div>
            <div class="text-right">
                <div class="font-weight-bold"><?= esc(session()->get('name')) ?></div>
                <small class="text-muted">
                    <i class="fas fa-user-shield mr-1"></i><?= esc(session()->get('role') ?? 'PIC/Admin') ?>
                    • NIK: <?= esc(session()->get('nika')) ?>
                </small>
                <?php if (!empty($pic_name)): ?>
                    <div class="mt-1">
                        <span class="pic-info">
                            <i class="fas fa-user-tie"></i>
                            PIC: <strong><?= esc($pic_name) ?></strong>
                            <?php if (!empty($pic_phone)): ?>
                                <span class="ml-2"><i class="fas fa-phone-alt"></i> <?= esc($pic_phone) ?></span>
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ALERT FLASH -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- PILIH IJO -->
        <div class="ijo-selector-card mb-4">
            <div class="form-row align-items-end">
                <div class="col-md-9">
                    <label for="ijoSelect"><i class="fas fa-file-contract mr-1"></i>Pilih Shipping / IJO</label>
                    <select id="ijoSelect" class="form-control"></select>
                    <small class="text-muted" id="ijoHint">Pilih IJO untuk menampilkan Tugboat, Barge, dan daftar timesheet.</small>
                    <div class="ijo-meta-badges" id="ijoMetaBadges"></div>
                </div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnReloadIjo">
                        <i class="fas fa-sync-alt mr-1"></i>Reload IJO
                    </button>
                </div>
            </div>
        </div>

        <!-- STATUS IJO -->
        <div class="card mb-4" id="ijoInfoCard" style="display:none;">
            <div class="card-body p-3">
                <div class="ijo-badge mb-3">
                    <div>
                        <div class="label">Internal Job Order (IJO)</div>
                        <div class="value">
                            <span id="ijoIdLabel" style="opacity:.7;"></span>
                            <i class="fas fa-file-contract mr-2"></i><span id="ijoNumberLabel">-</span>
                        </div>
                    </div>
                    <div>
                        <span class="badge badge-light px-3 py-2 text-primary font-weight-bold" id="ijoStatusBadge">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                    </div>
                </div>
                <div class="vessel-info">
                    <div class="item">
                        <span class="lbl">Tugboat</span>
                        <span class="val"><i class="fas fa-anchor"></i><span id="tugboatLabel">-</span></span>
                    </div>
                    <div class="item">
                        <span class="lbl">Barge</span>
                        <span class="val"><i class="fas fa-ship"></i><span id="bargeLabel">-</span></span>
                    </div>
                    <div class="item">
                        <span class="lbl">Rute Pelayaran</span>
                        <span class="val"><i class="fas fa-route"></i><span id="routeLabel">-</span></span>
                    </div>
                    <div class="item">
                        <span class="lbl">Client</span>
                        <span class="val"><i class="fas fa-building"></i><span id="clientLabel">-</span></span>
                    </div>
                    <div class="item">
                        <span class="lbl">SPAL</span>
                        <span class="val"><i class="fas fa-file-alt"></i><span id="spalLabel">-</span></span>
                    </div>
                    <div class="item">
                        <span class="lbl">ETA Loading</span>
                        <span class="val"><i class="fas fa-calendar-check"></i><span id="etaLoadingLabel">-</span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- LIST DATA -->
        <div class="card" id="listCard" style="display:none;">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <span class="mb-2 mb-sm-0"><i class="fas fa-list text-primary mr-1"></i> Daftar Timesheet</span>
                <div class="d-flex flex-wrap align-items-center" style="gap:.5rem;">
                    <div class="input-group input-group-sm" style="width:auto;">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                        <input type="date" class="form-control form-control-sm" id="waDateFrom" title="Dari tanggal" style="width:130px;">
                        <div class="input-group-prepend input-group-append"><span class="input-group-text">s/d</span></div>
                        <input type="date" class="form-control form-control-sm" id="waDateTo" title="Sampai tanggal" style="width:130px;">
                    </div>
                    <button type="button" class="btn btn-sm btn-wa" id="btnCopyWA">
                        <i class="fab fa-whatsapp mr-1"></i>Copy ke WA
                    </button>
                    <button type="button" class="btn btn-sm btn-primary font-weight-bold" id="btnTambahData">
                        <i class="fas fa-plus mr-1"></i> Tambah Timesheet
                    </button>
                </div>
            </div>

            <div class="card-body pb-0 pt-2">
                <div class="filter-toolbar mb-2">
                    <label class="mb-0 font-weight-bold" style="font-size:.8rem;">Filter:</label>
                    <select class="form-control form-control-sm" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="draft">Draft</option>
                        <option value="submitted">Submitted</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <input type="date" class="form-control form-control-sm" id="filterDateFrom" title="Dari tanggal">
                    <input type="date" class="form-control form-control-sm" id="filterDateTo" title="Sampai tanggal">
                    <button class="btn btn-sm btn-outline-primary" id="btnFilter"><i class="fas fa-filter mr-1"></i>Terapkan</button>
                    <button class="btn btn-sm btn-outline-secondary" id="btnResetFilter"><i class="fas fa-undo mr-1"></i>Reset</button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Crew / NIK</th>
                                <th>Activity</th>
                                <th>Lokasi / Posisi</th>
                                <th>Speed</th>
                                <th>Jarak</th>
                                <th>ETA</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="timesheetList">
                            <tr><td colspan="11" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x d-block mb-2"></i>Pilih IJO terlebih dahulu
                            </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center" style="gap:10px;">
                <small class="text-muted">Menampilkan <strong id="countDisplay">0</strong> data</small>
                <div class="pagination-wrapper">
                    <?= ($pager) ? $pager->only(['status'])->links() : '' ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM TIMESHEET -->
    <div class="modal right fade" id="timesheetModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="fas fa-edit text-primary mr-2"></i><span id="formTitle">Form Input Timesheet</span></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formTimesheet">
                        <input type="hidden" name="id" id="timesheetId" value="">
                        <input type="hidden" name="ijo_id" id="formIjoId" value="">
                        <input type="hidden" name="ijo_number" id="formIjoNumber" value="">
                        <input type="hidden" name="vessel_id" id="formVesselId" value="">
                        <input type="hidden" name="vessel_name" id="formVesselName" value="">
                        <input type="hidden" name="barge_id" id="formBargeId" value="">
                        <input type="hidden" name="barge_name" id="formBargeName" value="">

                        <div class="form-section-title mt-0">Detail Aktivitas</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" name="activity_date" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required">Jam (24 Jam)</label>
                                <div class="d-flex align-items-center" style="gap:.25rem;">
                                    <select class="form-control form-control-sm" name="activity_hour" id="activityHour" required>
                                        <?php for ($h = 0; $h < 24; $h++): ?>
                                            <option value="<?= str_pad($h,2,'0',STR_PAD_LEFT) ?>" <?= (int)date('H')===$h?'selected':'' ?>><?= str_pad($h,2,'0',STR_PAD_LEFT) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <span class="font-weight-bold">:</span>
                                    <select class="form-control form-control-sm" name="activity_minute" id="activityMinute" required>
                                        <?php $curMin=(int)date('i'); $rMin=floor($curMin/5)*5;
                                        for ($m = 0; $m < 60; $m += 1): ?>
                                            <option value="<?= str_pad($m,2,'0',STR_PAD_LEFT) ?>" <?= $m===$rMin?'selected':'' ?>><?= str_pad($m,2,'0',STR_PAD_LEFT) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="activity_time" id="activityTime" value="">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="required">Activity</label>
                                <select class="form-control form-control-sm" name="activity_id" id="activitySelect" required>
                                    <option value="">-- Memuat activity... --</option>
                                </select>
                                <small class="text-muted" id="activityCount"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Lokasi / Posisi</label>
                            <input type="text" class="form-control form-control-sm" name="location" placeholder="Contoh: Pelabuhan Tanjung Priok">
                        </div>

                        <div class="form-group mb-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="mb-0">Koordinat Lokasi</label>
                                <div class="d-flex align-items-center" style="gap:.5rem;">
                                    <div class="format-switch" id="formatSwitch">
                                        <button type="button" data-format="DMS" class="active">DMS</button>
                                        <button type="button" data-format="DD">Decimal (DD)</button>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-xs" id="btnGetLocation">
                                        <i class="fas fa-crosshairs mr-1"></i>GPS
                                    </button>
                                </div>
                            </div>
                            <div class="coord-box">
                                <input type="hidden" name="latitude" id="latitude" value="">
                                <input type="hidden" name="longitude" id="longitude" value="">
                                <input type="hidden" name="coord_format" id="coord_format" value="DMS">
                                <input type="hidden" name="coord_source" id="coord_source" value="manual">

                                <div class="coord-format-section active" data-format="DMS">
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Latitude</small>
                                        <div class="form-row">
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" class="form-control dms-input" id="lat_deg" min="0" max="90" placeholder="6">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">°</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" class="form-control dms-input" id="lat_min" min="0" max="59" placeholder="6">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">'</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" step="0.01" class="form-control dms-input" id="lat_sec" min="0" max="59.99" placeholder="0">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">"</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1">
                                                <select class="form-control form-control-sm" id="lat_dir"><option value="N">N</option><option value="S">S</option></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted d-block mb-1">Longitude</small>
                                        <div class="form-row">
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" class="form-control dms-input" id="lng_deg" min="0" max="180" placeholder="106">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">°</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" class="form-control dms-input" id="lng_min" min="0" max="59" placeholder="52">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">'</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1"><div class="input-group input-group-sm">
                                                <input type="number" step="0.01" class="form-control dms-input" id="lng_sec" min="0" max="59.99" placeholder="48">
                                                <div class="input-group-append"><span class="input-group-text dms-suffix">"</span></div>
                                            </div></div>
                                            <div class="form-group col-3 mb-1">
                                                <select class="form-control form-control-sm" id="lng_dir"><option value="E">E</option><option value="W">W</option></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="coord-format-section" data-format="DD">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-2"><div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">Lat</span></div>
                                            <input type="number" step="0.000001" class="form-control" id="latitude_dd" placeholder="-6.100000">
                                        </div></div>
                                        <div class="form-group col-md-6 mb-2"><div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">Lng</span></div>
                                            <input type="number" step="0.000001" class="form-control" id="longitude_dd" placeholder="106.880000">
                                        </div></div>
                                    </div>
                                </div>

                                <small class="text-muted" id="coordStatus">
                                    <i class="fas fa-info-circle mr-1"></i>Klik "GPS" untuk mengambil titik otomatis, atau ketik manual.
                                </small>
                            </div>
                        </div>

                        <div class="form-section-title">Data Operasional</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jarak Tempuh (NM)</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" name="distance_nm" placeholder="0.00">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Speed Kapal (Knot)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step="0.01" class="form-control" name="speed_knot" placeholder="0.00">
                                    <div class="input-group-append"><span class="input-group-text">knot</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label><i class="fas fa-clock text-warning mr-1"></i>ETA (Estimasi Waktu Tiba)</label>
                            <div class="eta-box">
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-1">
                                        <small class="eta-label d-block mb-1">Tanggal ETA</small>
                                        <input type="date" class="form-control form-control-sm" name="eta_date" id="etaDate">
                                    </div>
                                    <div class="form-group col-md-6 mb-1">
                                        <small class="eta-label d-block mb-1">Jam ETA (24 Jam)</small>
                                        <div class="d-flex align-items-center" style="gap:.25rem;">
                                            <select class="form-control form-control-sm" name="eta_hour" id="etaHour">
                                                <option value="">--</option>
                                                <?php for ($h = 0; $h < 24; $h++): ?>
                                                    <option value="<?= str_pad($h,2,'0',STR_PAD_LEFT) ?>"><?= str_pad($h,2,'0',STR_PAD_LEFT) ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <span class="font-weight-bold">:</span>
                                            <select class="form-control form-control-sm" name="eta_minute" id="etaMinute">
                                                <option value="">--</option>
                                                <?php for ($m = 0; $m < 60; $m += 5): ?>
                                                    <option value="<?= str_pad($m,2,'0',STR_PAD_LEFT) ?>"><?= str_pad($m,2,'0',STR_PAD_LEFT) ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="eta_time" id="etaTime" value="">
                                <small class="text-muted"><i class="fas fa-info-circle mr-1"></i>Kosongkan jika tidak ada ETA.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cuaca</label>
                            <select class="form-control form-control-sm" name="weather_condition" id="weatherCondition">
                                <option value="">-- Pilih Kondisi Cuaca --</option>
                                <optgroup label="Cerah">
                                    <option value="Cerah">Cerah</option>
                                    <option value="Cerah Berawan">Cerah Berawan</option>
                                    <option value="Berawan">Berawan</option>
                                    <option value="Mendung">Mendung</option>
                                </optgroup>
                                <optgroup label="Hujan">
                                    <option value="Hujan Ringan">Hujan Ringan</option>
                                    <option value="Hujan Sedang">Hujan Sedang</option>
                                    <option value="Hujan Lebat">Hujan Lebat</option>
                                    <option value="Hujan Badai">Hujan Badai</option>
                                    <option value="Hujan Lokal">Hujan Lokal</option>
                                </optgroup>
                                <optgroup label="Berkabut">
                                    <option value="Berkabut">Berkabut</option>
                                    <option value="Kabut Tebal">Kabut Tebal</option>
                                    <option value="Asap">Asap</option>
                                </optgroup>
                                <optgroup label="Angin & Gelombang">
                                    <option value="Angin Kencang">Angin Kencang</option>
                                    <option value="Gelombang Tinggi">Gelombang Tinggi</option>
                                    <option value="Laut Tenang">Laut Tenang</option>
                                    <option value="Laut Sedang">Laut Sedang</option>
                                    <option value="Laut Berombak">Laut Berombak</option>
                                </optgroup>
                                <optgroup label="Lainnya">
                                    <option value="Badai Tropis">Badai Tropis</option>
                                    <option value="Cuaca Buruk">Cuaca Buruk</option>
                                    <option value="Lainnya">Lainnya</option>
                                </optgroup>
                            </select>
                            <input type="text" class="form-control form-control-sm mt-1" name="weather_other" id="weatherOther"
                                   placeholder="Sebutkan kondisi cuaca lainnya..." style="display:none;">
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control form-control-sm" name="remarks" rows="2" placeholder="Catatan tambahan..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnReset">
                        <i class="fas fa-undo mr-1"></i>Reset
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnSubmitForm">
                        <i class="fas fa-paper-plane mr-1"></i>Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview WhatsApp -->
    <div class="modal fade" id="waModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fab fa-whatsapp mr-2"></i>Preview Laporan WhatsApp</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-0">
                    <textarea id="waPreview" class="form-control border-0"
                              style="min-height:400px; font-family:monospace; font-size:13px; padding:1rem; background:#fffbe6;"
                              readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Tutup</button>
                    <button type="button" class="btn btn-outline-success btn-sm" id="btnOpenWA"><i class="fab fa-whatsapp mr-1"></i>Buka WhatsApp</button>
                    <button type="button" class="btn btn-success btn-sm" id="btnCopyClipboard"><i class="fas fa-copy mr-1"></i>Copy ke Clipboard</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // ==================== CONFIG ====================
        const BASE_URL         = '<?= base_url('admin/time_sheet') ?>';
        const API_IJO_URL      = '<?= base_url('admin/time_sheet/ijo') ?>';
        const API_ACTIVITY_URL = '<?= base_url('v1-alya/api/master-data/activity') ?>';
        const CSRF_NAME        = '<?= csrf_token() ?>';
        const CSRF_HASH        = '<?= csrf_hash() ?>';

        // ==================== STATE ====================
        let currentIjo   = null;
        let currentRows  = [];
        let waReportText = '';

        // ==================== UTIL ====================
        function ddToDms(dd, isLat) {
            if (dd === '' || dd === null || isNaN(dd)) return null;
            dd = parseFloat(dd);
            const abs = Math.abs(dd);
            const deg = Math.floor(abs);
            const minFloat = (abs - deg) * 60;
            const min = Math.floor(minFloat);
            const sec = ((minFloat - min) * 60).toFixed(2);
            const dir = isLat ? (dd >= 0 ? 'N' : 'S') : (dd >= 0 ? 'E' : 'W');
            return { deg, min, sec: parseFloat(sec), dir };
        }
        function dmsToDd(deg, min, sec, dir) {
            if (deg === '' || deg === null || isNaN(deg)) return '';
            deg = parseFloat(deg) || 0; min = parseFloat(min) || 0; sec = parseFloat(sec) || 0;
            let dd = deg + min / 60 + sec / 3600;
            if (dir === 'S' || dir === 'W') dd = -dd;
            return parseFloat(dd.toFixed(6));
        }
        function formatCoordForWA(lat, lng, format) {
            if (lat === null || lat === undefined || lat === '' ||
                lng === null || lng === undefined || lng === '') return '-';
            const latNum = parseFloat(lat), lngNum = parseFloat(lng);
            if (isNaN(latNum) || isNaN(lngNum)) return '-';
            if (format === 'DMS') {
                const latDms = ddToDms(latNum, true), lngDms = ddToDms(lngNum, false);
                return `${latDms.deg}°${latDms.min}'${latDms.sec}"${latDms.dir} ${lngDms.deg}°${lngDms.min}'${lngDms.sec}"${lngDms.dir}`;
            }
            return `${latNum.toFixed(6)}, ${lngNum.toFixed(6)}`;
        }
        function escapeHtml(s) {
            if (s === null || s === undefined) return '';
            return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[c]);
        }
        function ucfirst(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : ''; }
        function formatDateIndo(d) {
            if (!d) return '-';
            const dt = new Date(d);
            if (isNaN(dt.getTime())) return d;
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            return `${dt.getDate()} ${months[dt.getMonth()]} ${dt.getFullYear()}`;
        }
        function isValidDate(d) {
            return d && d !== '0000-00-00' && !d.startsWith('0000');
        }

        // ==================== LOAD IJO LIST ====================
        function loadIjoList() {
            const $sel = $('#ijoSelect');
            $sel.empty().append('<option value="">-- Memuat IJO... --</option>');
            $('#ijoMetaBadges').empty();

            $.ajax({
                url: API_IJO_URL,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status && Array.isArray(res.rows)) {
                        $sel.empty().append('<option value="">-- Pilih Shipping / IJO --</option>');

                        // Filter: buang yang deleted_at
                        const rows = res.rows.filter(r => !r.deleted_at);

                        // Urutkan: terbaru dulu (id desc)
                        rows.sort((a, b) => (parseInt(b.id) || 0) - (parseInt(a.id) || 0));

                        rows.forEach(r => {
                            // Label ringkas: nomor - Tug / Barge (loading → discharge)
                            const tug = r.tugboat_name || '-';
                            const barge = r.barge_name || '-';
                            const load = r.loading_port || '-';
                            const disc = r.discharge_port || '-';
                            const label = `${r.number || ('ID '+r.id)} — ${tug} / ${barge} (${load} → ${disc})`;
                            // $sel.append(
                            //     $('<option>').val(r.id).text(label).attr('data-ijo', JSON.stringify(r))
                            // );
                            const $option = $('<option>').val(r.id).text(label);
                            $option.data('ijo', r);        // ← simpan sebagai OBJECT, bukan string
                            $sel.append($option);
                        });
                        $sel.trigger('change.select2');

                        // Tampilkan hint
                        $('#ijoHint').html(
                            `<i class="fas fa-info-circle mr-1"></i>${rows.length} IJO tersedia — pilih untuk menampilkan timesheet.`
                        );
                    } else {
                        $sel.empty().append('<option value="">-- Gagal memuat IJO --</option>');
                        $('#ijoHint').text('Gagal memuat IJO. Coba reload.');
                    }
                },
                error: function() {
                    $sel.empty().append('<option value="">-- Error memuat IJO --</option>');
                    $('#ijoHint').text('Error memuat IJO. Cek koneksi / endpoint.');
                }
            });
        }

        // ==================== PILIH IJO (DEFENSIVE) ====================
        function handleIjoChange() {
            const $sel = $('#ijoSelect');
            const id = $sel.val();

            // DEBUG
            console.log('[IJO] change triggered. id =', id);

            if (!id) {
                currentIjo = null;
                $('#ijoInfoCard, #listCard').hide();
                $('#ijoMetaBadges').empty();
                $('#timesheetList').html('<tr><td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Pilih IJO terlebih dahulu</td></tr>');
                return;
            }

            // Ambil data-ijo — coba via attr, lalu fallback via .data()
            const $opt = $sel.find('option:selected');
            let dataIjo = $opt.attr('data-ijo');
            if (!dataIjo) {
                // Fallback: kadang Select2 men-clone option, cek via data()
                const raw = $opt.data('ijo');
                if (raw && typeof raw === 'object') {
                    currentIjo = raw;
                    console.log('[IJO] loaded via .data()', currentIjo);
                    finishIjoSelection();
                    return;
                }
                console.error('[IJO] data-ijo tidak ditemukan pada option. Cek apakah option punya attr data-ijo.');
                alert('Data IJO tidak ditemukan. Coba reload halaman.');
                return;
            }

            // Parse JSON dengan try/catch
            try {
                currentIjo = JSON.parse(dataIjo);
            } catch (e) {
                console.error('[IJO] Gagal parse JSON data-ijo:', e, '\nRaw:', dataIjo);
                alert('Data IJO rusak / tidak valid. Coba reload halaman.');
                return;
            }

            console.log('[IJO] loaded:', currentIjo);
            finishIjoSelection();
        }

        function finishIjoSelection() {
            if (!currentIjo) return;
            renderIjoInfo(currentIjo);
            $('#ijoInfoCard, #listCard').show();
            loadTimesheets();
        }

        // Bind ke event native change
        // $('#ijoSelect').on('change', handleIjoChange);
        $(document).on('change', '#ijoSelect', handleIjoChange);

        // Bind juga ke Select2 event (backup, karena Select2 kadang tidak trigger native change)
        $(document).on('select2:select', '#ijoSelect', function(e) {
            console.log('[IJO] select2:select event');
            handleIjoChange();
        });
        $(document).on('select2:unselect', '#ijoSelect', function(e) {
            console.log('[IJO] select2:unselect event');
            handleIjoChange();
        });

        // // ==================== PILIH IJO ====================
        // $('#ijoSelect').on('change', function() {
        //     const id = $(this).val();
        //     const $opt = $(this).find('option:selected');
        //     const dataIjo = $opt.attr('data-ijo');

        //     if (!id || !dataIjo) {
        //         currentIjo = null;
        //         $('#ijoInfoCard, #listCard').hide();
        //         $('#ijoMetaBadges').empty();
        //         $('#timesheetList').html('<tr><td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Pilih IJO terlebih dahulu</td></tr>');
        //         return;
        //     }

        //     currentIjo = JSON.parse(dataIjo);
        //     renderIjoInfo(currentIjo);
        //     $('#ijoInfoCard, #listCard').show();
        //     loadTimesheets();
        // });

        // ==================== RENDER INFO IJO ====================
        function renderIjoInfo(ijo) {
            // Header badge
            $('#ijoIdLabel').text('(ID ' + ijo.id + ')');
            $('#ijoNumberLabel').text(ijo.number || '-');
            $('#tugboatLabel').text(ijo.tugboat_name || '-');
            $('#bargeLabel').text(ijo.barge_name || '-');
            $('#routeLabel').text((ijo.loading_port || '-') + ' → ' + (ijo.discharge_port || '-'));
            $('#clientLabel').text(ijo.client_name || '-');
            $('#spalLabel').text(ijo.spal_number || '-');

            // ETA loading
            let etaLoad = '-';
            if (isValidDate(ijo.eta_loading_port)) {
                etaLoad = formatDateIndo(ijo.eta_loading_port);
                if (isValidDate(ijo.eta_loading_port_to) && ijo.eta_loading_port_to !== ijo.eta_loading_port) {
                    etaLoad += ' s/d ' + formatDateIndo(ijo.eta_loading_port_to);
                }
            }
            $('#etaLoadingLabel').text(etaLoad);

            // Status badge berdasarkan release_name
            const rel = (ijo.release_name || '').toLowerCase();
            let statusClass = 'text-primary', statusText = 'Release', statusIcon = 'check-circle';
            if (rel === 'done') { statusClass = 'text-success'; statusText = 'Done'; statusIcon = 'check-double'; }
            else if (rel === 'progress') { statusClass = 'text-warning'; statusText = 'Progress'; statusIcon = 'spinner'; }
            else if (rel === 'cancel' || rel === 'canceled') { statusClass = 'text-danger'; statusText = 'Cancel'; statusIcon = 'times-circle'; }
            $('#ijoStatusBadge')
                .removeClass('text-primary text-success text-warning text-danger')
                .addClass(statusClass)
                .html(`<i class="fas fa-${statusIcon} mr-1"></i>${statusText}`);

            // Meta badges di atas (client, spal, eta)
            const badges = [];
            if (ijo.client_name) badges.push(`<span class="badge badge-info"><i class="fas fa-building mr-1"></i>${escapeHtml(ijo.client_name)}</span>`);
            if (ijo.spal_number) badges.push(`<span class="badge badge-secondary"><i class="fas fa-file-alt mr-1"></i>SPAL ${escapeHtml(ijo.spal_number)}</span>`);
            if (ijo.is_testing == '1') badges.push(`<span class="badge badge-warning"><i class="fas fa-flask mr-1"></i>Testing</span>`);
            if (isValidDate(ijo.eta_loading_port)) badges.push(`<span class="badge badge-light border"><i class="fas fa-calendar-check mr-1"></i>ETA Load: ${formatDateIndo(ijo.eta_loading_port)}</span>`);
            $('#ijoMetaBadges').html(badges.join(''));

            // Sinkron ke hidden form
            $('#formIjoId').val(ijo.id);
            $('#formIjoNumber').val(ijo.number);
            $('#formVesselId').val(ijo.tugboat_id || '');
            $('#formVesselName').val(ijo.tugboat_name || '');
            $('#formBargeId').val(ijo.barge_id || '');
            $('#formBargeName').val(ijo.barge_name || '');
        }

        // ==================== LOAD TIMESHEET ====================
        function loadTimesheets() {
            if (!currentIjo) return;

            const status   = $('#filterStatus').val();
            const dateFrom = $('#filterDateFrom').val();
            const dateTo   = $('#filterDateTo').val();

            let qs = `ijo_id=${currentIjo.id}`;
            if (status)   qs += `&status=${status}`;
            if (dateFrom) qs += `&date_from=${dateFrom}`;
            if (dateTo)   qs += `&date_to=${dateTo}`;

            $('#timesheetList').html('<tr><td colspan="11" class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Memuat...</td></tr>');

            $.ajax({
                // url: `${BASE_URL}/show/${currentIjo.id}?${qs}`,
                url: `${BASE_URL}/show?${qs}`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (!res.status) {
                        $('#timesheetList').html('<tr><td colspan="11" class="text-center text-danger py-4">Gagal memuat data.</td></tr>');
                        return;
                    }
                    currentRows = res.rows || [];
                    renderTimesheetTable(currentRows);
                },
                error: function() {
                    $('#timesheetList').html('<tr><td colspan="11" class="text-center text-danger py-4">Gagal menghubungi server.</td></tr>');
                }
            });
        }

        function renderTimesheetTable(rows) {
            const $tbody = $('#timesheetList');
            $tbody.empty();
            $('#countDisplay').text(rows.length);

            if (rows.length === 0) {
                $tbody.html('<tr><td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Belum ada data timesheet untuk IJO ini</td></tr>');
                return;
            }

            const statusMap = { draft:'secondary', submitted:'primary', approved:'success', rejected:'danger' };

            rows.forEach(function(t) {
                const badge = statusMap[t.status] || 'secondary';
                let etaText = '-';
                if (t.eta_date) {
                    etaText = t.eta_date;
                    if (t.eta_time) etaText += ' ' + String(t.eta_time).slice(0, 5);
                }
                const tr = `
                    <tr data-id="${t.id}">
                        <td class="text-nowrap">${t.activity_date || '-'}</td>
                        <td>${t.activity_time ? String(t.activity_time).slice(0,5) : '-'}</td>
                        <td>
                            <div class="font-weight-bold" style="font-size:.8rem;">${escapeHtml(t.crew_name || '-')}</div>
                            <small class="text-muted">${escapeHtml(t.nika || '')}</small>
                        </td>
                        <td><span class="badge badge-info">${escapeHtml(t.activity_name || '-')}</span></td>
                        <td>${escapeHtml(t.location || '-')}</td>
                        <td>${t.speed_knot ? parseFloat(t.speed_knot).toFixed(2)+' kn' : '-'}</td>
                        <td>${t.distance_nm ? parseFloat(t.distance_nm).toFixed(2)+' NM' : '-'}</td>
                        <td class="text-nowrap">${etaText}</td>
                        <td><small>${escapeHtml(t.remarks || '-')}</small></td>
                        <td><span class="badge badge-${badge} status-badge">${ucfirst(t.status || 'draft')}</span></td>
                        <td class="text-center text-nowrap">
                            <button class="btn btn-sm btn-outline-info btn-detail" data-id="${t.id}" title="Detail"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-outline-warning btn-edit" data-id="${t.id}" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${t.id}" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>`;
                $tbody.append(tr);
            });
        }

        // ==================== FILTER ====================
        $('#btnFilter').on('click', loadTimesheets);
        $('#btnResetFilter').on('click', function() {
            $('#filterStatus').val('');
            $('#filterDateFrom').val('');
            $('#filterDateTo').val('');
            loadTimesheets();
        });
        $('#btnReloadIjo').on('click', loadIjoList);

        // ==================== SYNC JAM ====================
        function syncActivityTime() {
            const h = $('#activityHour').val() || '00';
            const m = $('#activityMinute').val() || '00';
            $('#activityTime').val(`${h}:${m}`);
        }
        $('#activityHour, #activityMinute').on('change', syncActivityTime);
        syncActivityTime();

        function syncEtaTime() {
            const h = $('#etaHour').val(), m = $('#etaMinute').val();
            $('#etaTime').val((h && m) ? `${h}:${m}` : '');
        }
        $('#etaHour, #etaMinute').on('change', syncEtaTime);
        syncEtaTime();

        // ==================== CUACA "LAINNYA" ====================
        $('#weatherCondition').on('change', function() {
            if ($(this).val() === 'Lainnya') $('#weatherOther').show().focus();
            else $('#weatherOther').hide().val('');
        });

        // ==================== LOAD ACTIVITY ====================
        function loadActivities() {
            const $sel = $('#activitySelect');
            $sel.empty().append('<option value="">-- Memuat activity... --</option>');
            $.ajax({
                url: API_ACTIVITY_URL, type: 'GET', dataType: 'json',
                success: function(res) {
                    $sel.empty().append('<option value="">-- Pilih Activity --</option>');
                    if (res.status && Array.isArray(res.rows)) {
                        const rows = res.rows.filter(r => r.deleted_at === null);
                        rows.sort((a, b) => (a.name || '').localeCompare(b.name || ''));
                        rows.forEach(r => {
                            const name = (r.name || '').trim();
                            const label = r.kode ? `${name} [${r.kode}]` : name;
                            $sel.append(`<option value="${r.id}" data-name="${name}" data-kode="${r.kode || ''}">${label}</option>`);
                        });
                        $('#activityCount').text(`${rows.length} activity tersedia`);
                    }
                    $sel.trigger('change.select2');
                },
                error: function() {
                    $sel.empty().append('<option value="">-- Error memuat activity --</option>');
                }
            });
        }

        // ==================== KOORDINAT ====================
        function syncFromDD() {
            const latDD = $('#latitude_dd').val(), lngDD = $('#longitude_dd').val();
            $('#latitude').val(latDD || ''); $('#longitude').val(lngDD || '');
            const latDms = ddToDms(latDD, true);
            if (latDms) {
                $('#lat_deg').val(latDms.deg); $('#lat_min').val(latDms.min);
                $('#lat_sec').val(latDms.sec); $('#lat_dir').val(latDms.dir);
            } else {
                $('#lat_deg, #lat_min, #lat_sec').val(''); $('#lat_dir').val('N');
            }
            const lngDms = ddToDms(lngDD, false);
            if (lngDms) {
                $('#lng_deg').val(lngDms.deg); $('#lng_min').val(lngDms.min);
                $('#lng_sec').val(lngDms.sec); $('#lng_dir').val(lngDms.dir);
            } else {
                $('#lng_deg, #lng_min, #lng_sec').val(''); $('#lng_dir').val('E');
            }
        }
        function syncFromDMS() {
            const latDD = dmsToDd($('#lat_deg').val(), $('#lat_min').val(), $('#lat_sec').val(), $('#lat_dir').val());
            const lngDD = dmsToDd($('#lng_deg').val(), $('#lng_min').val(), $('#lng_sec').val(), $('#lng_dir').val());
            if (latDD !== '') $('#latitude_dd').val(latDD);
            if (lngDD !== '') $('#longitude_dd').val(lngDD);
            $('#latitude').val(latDD === '' ? '' : latDD);
            $('#longitude').val(lngDD === '' ? '' : lngDD);
        }
        function setCoordinates(lat, lng, source) {
            $('#latitude_dd').val(lat); $('#longitude_dd').val(lng);
            $('#coord_source').val(source || 'gps'); syncFromDD();
        }

        let currentFormat = 'DMS';
        $('#formatSwitch button').on('click', function() {
            const fmt = $(this).data('format');
            if (fmt === currentFormat) return;
            currentFormat = fmt;
            $('#coord_format').val(fmt);
            $('#formatSwitch button').removeClass('active');
            $(this).addClass('active');
            $('.coord-format-section').removeClass('active');
            $(`.coord-format-section[data-format="${fmt}"]`).addClass('active');
            if (fmt === 'DD') syncFromDMS(); else syncFromDD();
        });

        $('#latitude_dd, #longitude_dd').on('input', function () { $('#coord_source').val('manual'); syncFromDD(); });
        $('#lat_deg, #lat_min, #lat_sec, #lat_dir, #lng_deg, #lng_min, #lng_sec, #lng_dir').on('input change', function () {
            $('#coord_source').val('manual'); syncFromDMS();
        });

        $('#btnGetLocation').on('click', function() {
            const $btn = $(this), $status = $('#coordStatus');
            if (!navigator.geolocation) {
                $status.removeClass('success').addClass('error').html('<i class="fas fa-times-circle mr-1"></i>Browser tidak mendukung Geolocation.');
                return;
            }
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $status.removeClass('success error').html('<i class="fas fa-spinner fa-spin mr-1"></i>Mengambil koordinat...');
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    const lat = pos.coords.latitude.toFixed(6);
                    const lng = pos.coords.longitude.toFixed(6);
                    const acc = pos.coords.accuracy ? Math.round(pos.coords.accuracy) : '-';
                    setCoordinates(lat, lng, 'gps');
                    $status.removeClass('error').addClass('success').html(`<i class="fas fa-check-circle mr-1"></i>Koordinat diambil (akurasi ±${acc} m)`);
                    $btn.prop('disabled', false).html('<i class="fas fa-crosshairs mr-1"></i>GPS');
                },
                function(err) {
                    let msg = 'Gagal mengambil lokasi.';
                    if (err.code === 1) msg = 'Akses lokasi ditolak.';
                    if (err.code === 2) msg = 'Posisi tidak tersedia.';
                    if (err.code === 3) msg = 'Timeout. Coba lagi.';
                    $status.removeClass('success').addClass('error').html(`<i class="fas fa-times-circle mr-1"></i>${msg}`);
                    $btn.prop('disabled', false).html('<i class="fas fa-crosshairs mr-1"></i>GPS');
                },
                { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
            );
        });

        // ==================== RESET FORM ====================
        function resetForm() {
            $('#formTimesheet')[0].reset();
            $('#timesheetId').val('');
            $('#formTitle').text('Form Input Timesheet');
            $('#activitySelect').val(null).trigger('change');
            $('#latitude_dd, #longitude_dd').val('');
            $('#lat_deg, #lat_min, #lat_sec').val('');
            $('#lng_deg, #lng_min, #lng_sec').val('');
            $('#lat_dir').val('N'); $('#lng_dir').val('E');
            $('#latitude, #longitude').val('');
            currentFormat = 'DMS';
            $('#coord_format').val('DMS');
            $('#formatSwitch button').removeClass('active');
            $('#formatSwitch button[data-format="DMS"]').addClass('active');
            $('.coord-format-section').removeClass('active');
            $('.coord-format-section[data-format="DMS"]').addClass('active');
            $('#coord_source').val('manual');
            $('#coordStatus').removeClass('success error')
                .html('<i class="fas fa-info-circle mr-1"></i>Klik "GPS" untuk mengambil titik otomatis, atau ketik manual.');
            const now = new Date();
            $('input[name="activity_date"]').val(now.toISOString().slice(0, 10));
            const hh = String(now.getHours()).padStart(2, '0');
            const mm = String(Math.floor(now.getMinutes() / 5) * 5).padStart(2, '0');
            $('#activityHour').val(hh);
            $('#activityMinute').val(mm);
            syncActivityTime();
            $('#etaDate').val(''); $('#etaHour').val(''); $('#etaMinute').val(''); $('#etaTime').val('');
            $('#weatherCondition').val(''); $('#weatherOther').hide().val('');
            // Sinkron IJO
            if (currentIjo) renderIjoInfo(currentIjo);
        }
        $('#btnReset').on('click', resetForm);

        // ==================== SUBMIT ====================
        function submitTimesheet(saveAs) {
            if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }

            const id = $('#timesheetId').val();
            const url = id ? `${BASE_URL}/update/${id}` : `${BASE_URL}/store`;
            const $form = $('#formTimesheet');
            const activityId = $('#activitySelect').val();

            if (!activityId) {
                alert('Activity wajib dipilih.');
                $('#activitySelect').select2('open');
                return;
            }
            syncActivityTime();
            if (!$('#activityTime').val()) { alert('Jam wajib diisi.'); return; }
            syncEtaTime();

            if ($('#weatherCondition').val() === 'Lainnya' && !$('#weatherOther').val().trim()) {
                alert('Mohon sebutkan kondisi cuaca lainnya.');
                $('#weatherOther').focus();
                return;
            }

            const $opt = $('#activitySelect option:selected');
            const activityName = $opt.data('name') || $opt.text();
            const activityKode = $opt.data('kode') || '';

            const lat = $('#latitude').val(), lng = $('#longitude').val();
            if ((lat && !lng) || (!lat && lng)) {
                alert('Isi Latitude dan Longitude sekaligus, atau kosongkan keduanya.');
                return;
            }

            const formData = $form.serializeArray();
            formData.push({ name: 'activity_name', value: activityName });
            formData.push({ name: 'activity_kode', value: activityKode });
            formData.push({ name: 'save_as', value: saveAs });

            if ($('#weatherCondition').val() === 'Lainnya') {
                const otherVal = $('#weatherOther').val().trim();
                const idx = formData.findIndex(f => f.name === 'weather_condition');
                if (idx !== -1) formData[idx].value = otherVal;
                else formData.push({ name: 'weather_condition', value: otherVal });
            }

            formData.push({ name: CSRF_NAME, value: CSRF_HASH });

            const $btn = $('#btnSubmitForm');
            const origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...');

            $.ajax({
                url: url, type: 'POST', data: $.param(formData), dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        alert(res.message || 'Berhasil disimpan.');
                        $('#timesheetModal').modal('hide');
                        loadTimesheets();
                    } else {
                        let msg = res.message || 'Gagal menyimpan.';
                        if (res.errors) msg += '\n' + Object.values(res.errors).join('\n');
                        alert(msg);
                        $btn.prop('disabled', false).html(origHtml);
                    }
                },
                error: function(xhr) {
                    let msg = 'Terjadi kesalahan server.';
                    try { const r = JSON.parse(xhr.responseText); msg = r.message || msg; } catch (e) {}
                    alert(msg);
                    $btn.prop('disabled', false).html(origHtml);
                }
            });
        }
        $('#btnSubmitForm').on('click', function() { submitTimesheet('submit'); });

        // ==================== TAMBAH BARU ====================
        $('#btnTambahData').on('click', function() {
            if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }
            resetForm();
            $('#timesheetModal').modal('show');
        });

        // ==================== EDIT ====================
        $(document).on('click', '.btn-edit', function() {
            if (!currentIjo) return;
            const id = $(this).data('id');
            $.get(`${BASE_URL}/show/${id}`, function(res) {
                if (!res.status) { alert('Data tidak ditemukan.'); return; }
                const d = res.data;
                resetForm();

                $('#timesheetId').val(d.id);
                $('#formTitle').text('Edit Timesheet #' + d.id);
                $('input[name="activity_date"]').val(d.activity_date);

                if (d.activity_time) {
                    const parts = d.activity_time.split(':');
                    if ($('#activityHour option[value="'+parts[0]+'"]').length) $('#activityHour').val(parts[0]);
                    const mmNum = parseInt(parts[1], 10);
                    const mmRounded = Math.round(mmNum / 5) * 5 % 60;
                    const mmStr = String(mmRounded).padStart(2, '0');
                    if ($('#activityMinute option[value="'+mmStr+'"]').length) $('#activityMinute').val(mmStr);
                    else $('#activityMinute').val('00');
                }
                syncActivityTime();
                $('input[name="location"]').val(d.location || '');
                $('input[name="distance_nm"]').val(d.distance_nm || '');
                $('input[name="speed_knot"]').val(d.speed_knot || '');
                $('textarea[name="remarks"]').val(d.remarks || '');

                if (d.eta_date) $('#etaDate').val(d.eta_date);
                if (d.eta_time) {
                    const etaParts = d.eta_time.split(':');
                    if ($('#etaHour option[value="'+etaParts[0]+'"]').length) $('#etaHour').val(etaParts[0]);
                    const etaMNum = parseInt(etaParts[1], 10);
                    const etaMRounded = Math.round(etaMNum / 5) * 5 % 60;
                    const etaMStr = String(etaMRounded).padStart(2, '0');
                    if ($('#etaMinute option[value="'+etaMStr+'"]').length) $('#etaMinute').val(etaMStr);
                }
                syncEtaTime();

                const weatherVal = d.weather_condition || '';
                const $weatherSelect = $('#weatherCondition');
                if ($weatherSelect.find('option[value="'+weatherVal+'"]').length && weatherVal !== 'Lainnya') {
                    $weatherSelect.val(weatherVal);
                } else if (weatherVal) {
                    $weatherSelect.val('Lainnya');
                    $('#weatherOther').show().val(weatherVal);
                } else {
                    $weatherSelect.val('');
                }

                $('#activitySelect').val(d.activity_id).trigger('change');

                if (d.latitude !== null && d.longitude !== null) {
                    setCoordinates(parseFloat(d.latitude).toFixed(6), parseFloat(d.longitude).toFixed(6), d.coord_source || 'manual');
                }
                const fmt = d.coord_format || 'DMS';
                currentFormat = fmt;
                $('#coord_format').val(fmt);
                $('#formatSwitch button').removeClass('active');
                $('#formatSwitch button[data-format="'+fmt+'"]').addClass('active');
                $('.coord-format-section').removeClass('active');
                $('.coord-format-section[data-format="'+fmt+'"]').addClass('active');

                $('#timesheetModal').modal('show');
            });
        });

        // ==================== DETAIL ====================
        $(document).on('click', '.btn-detail', function() {
            const id = $(this).data('id');
            $.get(`${BASE_URL}/show/${id}`, function(res) {
                if (!res.status) { alert('Data tidak ditemukan.'); return; }
                const d = res.data;
                const etaText = (d.eta_date || d.eta_time) ? `${d.eta_date || '-'} ${d.eta_time || ''}`.trim() : '-';
                const coordText = formatCoordForWA(d.latitude, d.longitude, d.coord_format || 'DMS');
                const msg = `
                    ID           : ${d.id}
                    Tanggal      : ${d.activity_date}
                    Jam          : ${d.activity_time || '-'}
                    Crew         : ${d.crew_name || '-'} (${d.nika || '-'})
                    Activity     : ${d.activity_name}
                    Lokasi       : ${d.location || '-'}
                    Koordinat    : ${coordText}
                    Jarak (NM)   : ${d.distance_nm || '-'}
                    Speed (knot) : ${d.speed_knot || '-'}
                    ETA          : ${etaText}
                    Cuaca        : ${d.weather_condition || '-'}
                    Keterangan   : ${d.remarks || '-'}
                    Status       : ${d.status}
                `;
                alert(msg.trim());
            });
        });

        // ==================== DELETE ====================
        $(document).on('click', '.btn-delete', function() {
            if (!confirm('Yakin hapus data timesheet ini? Tindakan tidak bisa dibatalkan.')) return;
            const id = $(this).data('id');
            $.post(`${BASE_URL}/delete/${id}`, { [CSRF_NAME]: CSRF_HASH }, function(res) {
                if (res.status) {
                    alert(res.message || 'Berhasil dihapus.');
                    loadTimesheets();
                } else {
                    alert(res.message || 'Gagal menghapus.');
                }
            }, 'json').fail(function() { alert('Terjadi kesalahan server.'); });
        });

        // ==================== WHATSAPP ====================
        function getLatestCoordinate(callback) {
            if (!currentIjo) { callback(null); return; }
            $.ajax({
                url: `${BASE_URL}/latest-coordinate?ijo_id=${currentIjo.id}`,
                type: 'GET',
                dataType: 'json',
                success: function(res) { callback(res.status && res.data ? res.data : null); },
                error: function() { callback(null); }
            });
        }

        function injectCoordinateToReport(reportText, coordText) {
            if (!coordText || coordText === '-') return reportText;
            const lines = reportText.split('\n');
            const result = [];
            let inserted = false;
            for (let i = 0; i < lines.length; i++) {
                result.push(lines[i]);
                if (!inserted && /^\s*(Posisi|Lokasi)\s*[:\-]/i.test(lines[i])) {
                    result.push(`Koordinat : ${coordText}`);
                    inserted = true;
                }
            }
            if (!inserted) {
                const out = [];
                let done = false;
                for (let i = 0; i < result.length; i++) {
                    out.push(result[i]);
                    if (!done && /Tanggal\s*[:\-]/i.test(result[i])) {
                        out.push(`Koordinat : ${coordText}`);
                        done = true;
                    }
                }
                if (!done) return `Koordinat : ${coordText}\n${reportText}`;
                return out.join('\n');
            }
            return result.join('\n');
        }

        function loadWaReport(callback) {
            if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }

            let dateFrom = $('#waDateFrom').val();
            let dateTo   = $('#waDateTo').val();

            if (!dateFrom && !dateTo) {
                const today = new Date();
                const threeDaysAgo = new Date();
                threeDaysAgo.setDate(today.getDate() - 2);
                dateFrom = threeDaysAgo.toISOString().slice(0, 10);
                dateTo   = today.toISOString().slice(0, 10);
                $('#waDateFrom').val(dateFrom);
                $('#waDateTo').val(dateTo);
            } else if (dateFrom && !dateTo) { dateTo = dateFrom; $('#waDateTo').val(dateTo); }
            else if (!dateFrom && dateTo) { dateFrom = dateTo; $('#waDateFrom').val(dateFrom); }

            if (dateFrom > dateTo) {
                alert('Tanggal "Dari" tidak boleh lebih besar dari tanggal "Sampai".');
                return;
            }

            $.ajax({
                url: `${BASE_URL}/report-wa?ijo_id=${currentIjo.id}&date_from=${dateFrom}&date_to=${dateTo}`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status && res.text) {
                        waReportText = res.text;
                        getLatestCoordinate(function(coord) {
                            let finalText = waReportText;
                            if (coord && coord.latitude && coord.longitude) {
                                const coordText = formatCoordForWA(coord.latitude, coord.longitude, coord.coord_format || 'DMS');
                                finalText = injectCoordinateToReport(waReportText, coordText);
                            }
                            if (callback) callback(finalText);
                        });
                    } else {
                        alert(res.message || 'Gagal membuat laporan.');
                    }
                },
                error: function() { alert('Gagal menghubungi server.'); }
            });
        }

        $('#btnCopyWA').on('click', function() {
            const $btn = $(this);
            const orig = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memuat...');

            loadWaReport(function(text) {
                $('#waPreview').val(text);
                $('#waModal').modal('show');
                $btn.prop('disabled', false).html(orig);
            });
        });

        $('#btnCopyClipboard').on('click', function() {
            const text = $('#waPreview').val();
            if (!text) { alert('Tidak ada text.'); return; }
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Laporan berhasil dicopy. Silakan paste di WhatsApp.');
                    $('#waModal').modal('hide');
                }).catch(function() { fallbackCopy(text); });
            } else { fallbackCopy(text); }
        });

        function fallbackCopy(text) {
            const $temp = $('<textarea>').val(text).css({ position: 'fixed', left: '-9999px' }).appendTo('body');
            $temp[0].select();
            try {
                document.execCommand('copy');
                alert('Laporan berhasil dicopy. Silakan paste di WhatsApp.');
                $('#waModal').modal('hide');
            } catch (err) {
                alert('Gagal copy otomatis. Silakan block text di preview lalu Ctrl+C.');
            }
            $temp.remove();
        }

        $('#btnOpenWA').on('click', function() {
            const text = $('#waPreview').val();
            if (!text) { alert('Tidak ada text.'); return; }
            const encoded = encodeURIComponent(text);
            const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
            if (isMobile) window.open('whatsapp://send?text=' + encoded, '_blank');
            else window.open('https://web.whatsapp.com/send?text=' + encoded, '_blank');
        });

        // ==================== INIT ====================
        $(function() {
            $('#ijoSelect').select2({
                placeholder: '-- Cari / Pilih Shipping / IJO --',
                allowClear: true,
                width: '100%'
            });

            $('#activitySelect').select2({
                placeholder: '-- Cari / Pilih Activity --',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#timesheetModal')
            });

            loadIjoList();
            loadActivities();


            // === BINDING BERLAPIS (paling aman) ===
            // 1. Native change (untuk browser normal)
            $(document).on('change', '#ijoSelect', handleIjoChange);

            // 2. Select2 event (untuk Select2 UI)
            $(document).on('select2:select', '#ijoSelect', handleIjoChange);
            $(document).on('select2:unselect', '#ijoSelect', handleIjoChange);

            // 3. Fallback: pantau perubahan value secara berkala (hanya jika 1 & 2 gagal)
            //    — TIDAK direkomendasikan kecuali darurat
            // let lastVal = null;
            // setInterval(function() {
            //     const v = $('#ijoSelect').val();
            //     if (v !== lastVal) { lastVal = v; handleIjoChange(); }
            // }, 300);

            // 4. Debug: pastikan binding terpasang
            console.log('[IJO] bindings attached. Element count:', $('#ijoSelect').length);
        });
    </script>
</body>
</html>