<!-- Full Screen Modal -->
<div class="modal fade" id="modal_dismod" tabindex="-1" zdata-bs-backdrop="false" data-bs-backdrop="static" data-bs-keyboard="false" data-tableid="tbDismodModule">
    <div class="modal-dialog ummu-modal-rightschreen">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h5 class="modal-title text-light">Modules</h5>
                <button type="button" class="btn-close ummu-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table
                    id="tbDismodModule"
                    data-ajax="app.controllers.show_dismod"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-search-highlight="true"

                    data-show-refresh="true"
                    data-show-toggle="true"
                    data-show-fullscreen="true"
                    data-show-columns="true"
                    data-show-columns-toggle-all="true"
                    data-show-export="true"
                    data-show-search-clear-button="true"
                    zdata-show-pagination-switch="true"
                    data-multiple-select-row="true"

                    data-cookie="true"
                    data-cookie-id-table="tbDismodModule"

                    data-detail-view="true"
                    data-detail-formatter="$ummu.bt.detailFormatter"

                    data-id-field="id"
                    zdata-click-to-select="true"
                    data-checkbox-header="true"
                    data-minimum-count-columns="2"

                    data-buttons="app.views.table3_butoon"
                    zdata-buttons-class="primary"

                    data-filter-control="true"
                    data-pagination="true"
                    data-page-list="[10, 25, 50, 100, all]"
                    zdata-side-pagination="server"

                    data-response-handler="$ummu.bt.responseHandler" class="text-nowrap table-sm">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true" ></th>
                            <th data-sortable="true" data-field="module_id" class="text-center">Module ID</th>
                            <th data-sortable="true" data-field="kode" zdata-filter-control="input">Kode</th>
                            <th data-sortable="true" data-field="name" zdata-filter-control="input">Name</th>
                            <th data-field="path" >Path</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Full Screen Modal-->

<div class="modal fade" id="ummu_modal_message" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" id="modal_dialog">
        <div class="modal-content ummu-modal">
            <div class="modal-header ummu-modal-header">
                <div class="d-flex align-items-center gap-2">
                    <span class="ummu-modal-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </span>
                    <h6 class="modal-title mb-0">Messages</h6>
                </div>
                <button type="button" class="ummu-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-light fa-rectangle-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="ummu-alert" id="alert"></div>
            </div>
            <div class="modal-footer ummu-modal-footer">
                <button type="button" class="btn ummu-btn-close" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-right" id="modal_listData" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-purple py-2 text-light rounded-0">
                <h6 class="modal-title"><i class="fas fa-database"></i> <span>List Data</span></h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered text-sm text-nowrap" id="modalLeft_table_ListData" width="100%"
                        cellspacing="0">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan di layout/master -->
<div class="modal fade" id="loadingModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-3 mb-0" id="loadingModalText">Memproses...</p>
            </div>
        </div>
    </div>
</div>
<!-- contoh penggunaan -->
<!-- $(document).on('click', '.btn-delete', function() {
    if (!confirm('Yakin hapus data timesheet ini? Tindakan tidak bisa dibatalkan.')) return;
    const id = $(this).data('id');

    $('#loadingModalText').text('Menghapus data...');
    $('#loadingModal').modal('show');

    $.post(`${BASE_URL}/delete/${id}`, { [CSRF_NAME]: CSRF_HASH }, function(res) {
        $('#loadingModal').modal('hide');
        if (res.status) {
            alert(res.message || 'Berhasil dihapus.');
            loadTimesheets();
        } else {
            alert(res.message || 'Gagal menghapus.');
        }
    }, 'json').fail(function() {
        $('#loadingModal').modal('hide');
        alert('Terjadi kesalahan server.');
    });
}); -->


<div class="modal right fade" id="modal_form_right" tabindex="-1" role="dialog">
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