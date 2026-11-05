<?php
    $pic_name  = $crew->pic_name ?? '';
    $pic_phone = $crew->pic_phone ?? '';
    $pic_email = $crew->pic_email ?? '';
    $client_name = $crew->client_name ?? '';
?>
<?php echo $this->include(config('Ummu')->Views($dir_views . 'style')); ?>

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
            <label for="ijoSelect"><i class="fas fa-file-contract mr-1"></i>Pilih IJO</label>
            <select id="ijoSelect" class="form-control"></select>
            <small class="text-muted" id="ijoHint">Pilih IJO untuk menampilkan Tugboat, Barge, dan daftar timesheet.</small>
            <div class="ijo-meta-badges" id="ijoMetaBadges"></div>
        </div>
        <div class="col-md-3 text-right">
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnReloadIjo">
                <i class="fas fa-sync-alt mr-1"></i>Get IJO per PIC
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnGetAllIjo">
                <i class="fas fa-sync-alt mr-1"></i>Get All IJO
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
                        <!-- <th>Crew / NIK</th> -->
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

<!-- MODAL FORM TIMESHEET -->
<div class="modal right fade" id="timesheetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title"><i class="fas fa-edit text-primary mr-2"></i><span id="formTitle">Form Input Timesheet</span></h5>
                <button type="button" class="close" data-dismiss="modal" id="close_modal_form_timesheet"><span>&times;</span></button>
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

<!-- Modal Loading IJO -->
<div class="modal fade" id="ijoLoadingModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius:.75rem;">
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-file-contract fa-2x text-primary mb-2 d-block"></i>
                    <div class="spinner-border text-primary" role="status" style="width:2.5rem;height:2.5rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <h6 class="font-weight-bold mb-1" id="ijoLoadingTitle">Memuat Data IJO</h6>
                <small class="text-muted" id="ijoLoadingText">Mengambil daftar Shipping / IJO...</small>
                <div class="progress mt-3" style="height:5px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar" style="width:100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // ==================== CONFIG ====================
    const BASE_URL         = '<?= base_url('admin/time_sheet') ?>';
    const API_IJO_URL      = '<?= base_url('admin/time_sheet/ijo') ?>';
    const API_ACTIVITY_URL = '<?= base_url('v1-alya/api/master-data/activity') ?>';
    const CSRF_NAME        = '<?= csrf_token() ?>';
    const CSRF_HASH        = '<?= csrf_hash() ?>';
</script>
